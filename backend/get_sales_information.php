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

// Fetch all data from total_sales by date if a date is provided
$date = isset($_GET['date']) ? $_GET['date'] : null;
$query = "SELECT * FROM total_sales" . ($date ? " WHERE date = '$date'" : "");
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $salesData = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($salesData);
} else {
    echo json_encode(["message" => "No sales data found"]);
}

