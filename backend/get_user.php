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
// ... existing code ...
$staff_token = $_GET['staff_token']; // Assuming you're getting the token from a GET request
$query = "SELECT firstName FROM `user-staff` WHERE staff_token = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $staff_token);
$stmt->execute();
$result = $stmt->get_result();
$firstName = $result->fetch_assoc()['firstName'];
// ... existing code ...

echo json_encode($firstName);
