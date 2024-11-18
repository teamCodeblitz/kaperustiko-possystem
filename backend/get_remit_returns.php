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

// Check if a remit exists for a specific date
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['date'])) {
        $date = $_GET['date'];
        $stmt = $conn->prepare("SELECT * FROM remit_returns WHERE return_date = ?");
        $stmt->bind_param("s", $date);
    } else {
        // Fetch all records if no date is provided
        $stmt = $conn->prepare("SELECT * FROM remit_returns");
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    $remits = [];
    while ($row = $result->fetch_assoc()) {
        $remits[] = $row;
    }

    echo json_encode($remits);
    exit; // Stop further execution
}

// ... existing code for other functionalities ...

$conn->close();