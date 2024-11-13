<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins, or specify a domain
header("Access-Control-Allow-Methods: POST, OPTIONS"); // Allow specific methods
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

// Get data from POST request
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT password FROM `user-staff` WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($hashedPassword);
$stmt->fetch();

if ($stmt->num_rows > 0 && password_verify($password, $hashedPassword)) {
    echo json_encode(["status" => "success", "message" => "Login successful!"]); // Successful login
    // Here you can set session variables or redirect the user
} else {
    echo json_encode(["status" => "error", "message" => "Invalid email or password."]); // Invalid credentials
}

$stmt->close();
$conn->close();
