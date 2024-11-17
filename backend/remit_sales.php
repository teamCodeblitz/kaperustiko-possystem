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
// Get the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO remit_sales (cashier_name, total_sales, remit_date, remit_time, remit_shortage, validation) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $data['cashier_name'], $data['total_sales'], $data['remit_date'], $data['remit_time'], $data['remit_shortage'], $data['validation']);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Record added successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
