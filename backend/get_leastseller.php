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

// Fetch least ordered items
$sql = "SELECT JSON_UNQUOTE(JSON_EXTRACT(items_ordered, '$[*].order_name')) AS order_names FROM total_sales";
$result = $conn->query($sql);

$order_counts = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $order_names = json_decode($row['order_names']);
        foreach ($order_names as $name) {
            if (isset($order_counts[$name])) {
                $order_counts[$name]++;
            } else {
                $order_counts[$name] = 1;
            }
        }
    }
}

// Find the least ordered item
$least_ordered = array_keys($order_counts, min($order_counts));

// Return the least ordered item(s) as JSON
echo json_encode($least_ordered);

// Close the connection
$conn->close();
