<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins, or specify a domain
header("Access-Control-Allow-Methods: GET, OPTIONS"); // Allow specific methods
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

$selectedCategory = $_GET['label']; // Use GET method for label1
$selectedCategory2 = $_GET['label2']; // Use GET method for label2
$query = "SELECT * FROM `pos-menu` WHERE label = '$selectedCategory' OR label2 = '$selectedCategory2'"; // Check both label and label2
$result = $conn->query($query);

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
