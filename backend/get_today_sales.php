<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// Get the input data
$date = $_GET['date'] ?? null; // Check for date_time in query params

if ($date === null) {
    $date = date('Y-m-d'); // Use current date if no date is provided
}

if ($date) {
    // Set up database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kaperustiko-pos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get total sales amount for the specified date
    $sql = "SELECT SUM(total_amount) AS total_amount FROM total_sales WHERE date = ?"; // Adjust table and column names as necessary
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    $salesData = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $salesData[] = $row;
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Return the sales data as JSON
    echo json_encode($salesData);
} else {
    echo json_encode(["error" => "Date parameter is required."]);
}
?>
