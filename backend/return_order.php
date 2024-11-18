<?php
header("Access-Control-Allow-Origin: http://localhost:5173"); // Allow your frontend origin
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type"); // Allow specific headers
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kaperustiko-pos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true); // Get the JSON data

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO `return-orders` (receipt_number, return_date, return_time, cashier_name, items_ordered, total_amount, amount_paid, amount_change, order_take) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssddds", 
        $data['receipt_number'], 
        $data['return_date'], 
        $data['return_time'], 
        $data['cashier_name'], 
        $data['items_ordered'], 
        $data['total_amount'], 
        $data['amount_paid'], 
        $data['amount_change'], 
        $data['order_take']
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    $stmt->close();
}

$conn->close();