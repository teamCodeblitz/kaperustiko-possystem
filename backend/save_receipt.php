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

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Check if the data is valid and contains the required keys
if (is_null($data) || !isset($data['receiptNumber'], $data['date'], $data['time'], $data['cashierName'], $data['itemsOrdered'], $data['totalAmount'], $data['amountPaid'], $data['change'], $data['order_take'])) {
    echo json_encode(["error" => "Invalid input data"]);
    exit; // Stop execution if input is invalid
}

// Prepare and bind
$receiptNumber = $data['receiptNumber'];
$date = $data['date'];
$time = $data['time'];
$cashierName = $data['cashierName'];

// Modify itemsOrdered to exclude addons if they are null
$itemsOrdered = array_map(function($item) {
    if (is_null($item['addons'])) {
        unset($item['addons']); // Remove addons if null
    }
    return $item;
}, $data['itemsOrdered']);

$itemsOrderedJson = json_encode($itemsOrdered); // Encode modified itemsOrdered
$totalAmount = $data['totalAmount'];
$amountPaid = $data['amountPaid'];
$change = $data['change'];
$orderTake = $data['order_take'];

$stmt = $conn->prepare("INSERT INTO total_sales (receipt_number, date, time, cashier_name, items_ordered, total_amount, amount_paid, amount_change, order_take) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssiiis", $receiptNumber, $date, $time, $cashierName, $itemsOrderedJson, $totalAmount, $amountPaid, $change, $orderTake);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["message" => "Receipt saved successfully"]);
} else {
    echo json_encode(["error" => "Error saving receipt: " . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>
