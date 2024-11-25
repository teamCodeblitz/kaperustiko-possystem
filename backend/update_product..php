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

$code = $data['code'];

// Prepare the SQL statement
$sql = "UPDATE `pos-menu` SET title1 = ?, title2 = ?, label = ?, label2 = ?, price1 = ?, price2 = ?, price3 = ? WHERE code = ?";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdiss", $title1, $title2, $label, $label2, $price1, $price2, $price3, $code);

// Set parameters and execute
$title1 = $data['title1']; // Get value from request
$title2 = $data['title2']; // Get value from request
$label = $data['label'];    // Get value from request
$label2 = $data['label2'];  // Get value from request
$price1 = $data['price1'];  // Get value from request
$price2 = $data['price2'];  // Get value from request
$price3 = $data['price3'];  // Get value from request
$code = $data['code'];      // Get value from request

$stmt->execute();

// Check for errors
if ($stmt->error) {
    echo "Error: " . $stmt->error;
} else {
    echo "Record updated successfully";
}

// Close statement and connection
$stmt->close();
$conn->close();