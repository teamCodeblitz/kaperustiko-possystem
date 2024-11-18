<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins, or specify a domain
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type"); // Allow specific headers

$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "kaperustiko-pos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query
$sql = "SELECT * FROM `pos-menu`"; // Fetch all menu items
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $menuItems = [];
    while($row = $result->fetch_assoc()) {
        $menuItems[] = $row;
    }
    echo json_encode($menuItems);
} else {
    echo "No menu items found.";
}

$conn->close();
?>
