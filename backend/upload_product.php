<?php
date_default_timezone_set('Asia/Manila'); // Set the default timezone to Asia/Manila
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

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Get current date and time
$currentDate = date('Y-m-d'); // Current date
$currentTime = date('H:i:s'); // Current time

// Check if an image file was uploaded
if (isset($_FILES['image'])) {
    $imageFile = $_FILES['image'];
    $targetDir = "../static/foods/";
    $targetFile = $targetDir . basename($imageFile["name"]);
    
    // Check for upload errors
    if ($imageFile['error'] !== UPLOAD_ERR_OK) {
        error_log("Upload error: " . $imageFile['error']);
        echo json_encode(array("message" => "Failed to upload image"));
        exit;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($imageFile["tmp_name"], $targetFile)) {
        $data['image'] = $targetFile; // Update the image path to the saved location
    } else {
        error_log("Failed to move uploaded file.");
        echo json_encode(array("message" => "Failed to upload image"));
        exit;
    }
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO `pos-menu` (code, title1, title2, label, label2, price1, price2, price3, qty, stock_date, stock_time, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssdisssss", 
    $data['code'], 
    $data['title1'], 
    $data['title2'], 
    $data['label'], 
    $data['label2'], 
    $data['price1'], 
    $data['price2'], 
    $data['price3'], 
    $data['qty'], 
    $currentDate, 
    $currentTime, 
    $data['image']
);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(array("message" => "Product uploaded successfully"));
} else {
    echo json_encode(array("message" => "Failed to upload product"));
}