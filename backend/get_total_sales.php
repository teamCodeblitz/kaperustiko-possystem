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

// Query to get the total sales
$sql = "SELECT SUM(total_sales) AS total_sales_sum FROM remit_sales";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $totalSales = $row['total_sales_sum'];
    echo json_encode(['total_sales' => $totalSales]);
} else {
    echo json_encode(['error' => 'Query failed: ' . $conn->error]);
}