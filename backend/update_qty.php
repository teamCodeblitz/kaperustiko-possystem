<?php
header("Access-Control-Allow-Origin: http://localhost:5173"); // Allow your frontend origin
header("Access-Control-Allow-Methods: POST, OPTIONS"); // Allow specific methods
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

// Update quantity based on code
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $code = $data['code'];
    $qty = $data['qty'];

    // Set timezone to Philippine time
    date_default_timezone_set('Asia/Manila');

    // Get current date and time in the desired format
    $currentDate = date('Y-m-d'); // Changed format to YYYY-MM-DD for SQL compatibility
    $currentTime = date('H:i:s'); // Changed format to 24-hour format for SQL compatibility

    $sql = "UPDATE `pos-menu` SET `qty` = ?, `stock_date` = ?, `stock_time` = ? WHERE `code` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $qty, $currentDate, $currentTime, $code); // "isss" means integer, string, string, string
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo json_encode(["message" => "Quantity, date, and time updated successfully."]);
    } else {
        echo json_encode(["message" => "No rows updated."]);
    }

    $stmt->close();
}