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

// Get return_date from query parameters
$return_date = isset($_GET['return_date']) ? $_GET['return_date'] : '';

// Prepare SQL query
if (!empty($return_date)) {
    $sql = "SELECT * FROM `return-orders` WHERE return_date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $return_date);
} else {
    $sql = "SELECT * FROM `total_returns`"; // Query to get all data
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

// Fetch data
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Return JSON response
echo json_encode($data);


