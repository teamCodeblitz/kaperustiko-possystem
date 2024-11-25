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

// Get the code from the request
$data = json_decode(file_get_contents("php://input"), true);
$code = $data['code'] ?? null;

if ($code) {
    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM `pos-menu` WHERE `code` = ?");
    $stmt->bind_param("s", $code);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(["message" => "Product deleted successfully."]);
    } else {
        echo json_encode(["message" => "Error deleting product: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["message" => "No code provided."]);
}

// Close the connection
$conn->close();

