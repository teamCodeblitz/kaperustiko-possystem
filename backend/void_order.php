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

$orderName = $_GET['order_name'] ?? null;

if ($orderName) {
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_name = ?");
    $stmt->bind_param("s", $orderName);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
}

$conn->close();