<?php
header("Access-Control-Allow-Origin: http://localhost:5173"); // Allow your frontend origin
header("Access-Control-Allow-Methods: GET, OPTIONS"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type"); // Allow specific headers
header('Content-Type: application/json');

// Database connection parameters
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "kaperustiko-pos";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO orders (order_name, order_quantity, order_size, order_price, order_addons, order_addons_price, order_addons2, order_addons_price2, order_addons3, order_addons_price3, order_image, basePrice) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sisssssssssd", 
    $data['order_name'], 
    $data['order_quantity'], 
    $data['order_size'], 
    $data['order_price'], 
    $data['order_addons'], 
    $data['order_addons_price'], 
    $data['order_addons2'], 
    $data['order_addons_price2'], 
    $data['order_addons3'], 
    $data['order_addons_price3'], 
    $data['order_image'],
    $data['basePrice']
);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Order saved successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
