<?php
header("Access-Control-Allow-Origin: http://localhost:5173"); // Allow your frontend origin
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow specific headers
header("Access-Control-Allow-Credentials: true"); // Allow credentials
header('Content-Type: application/json');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // No content
    exit; // Exit to prevent further processing
}

// Database connection
$servername = getenv('DB_SERVERNAME') ?: "localhost"; 
$username = getenv('DB_USERNAME') ?: "root"; 
$password = getenv('DB_PASSWORD') ?: ""; 
$dbname = getenv('DB_DATABASE') ?: "kaperustiko-pos"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
