<?php
// Add CORS headers
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
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$middleName = $_POST['middleName'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
$contactNumber = $_POST['contactNumber'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO `user-staff` (firstName, lastName, middleName, email, password, contactNumber, avatar) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Set avatar
$avatar = 'default.jpg'; // Default avatar

// Bind parameters (without staff_token for now)
$stmt->bind_param("sssssss", $firstName, $lastName, $middleName, $email, $password, $contactNumber, $avatar);

// Execute the statement
if ($stmt->execute()) {
    // Get the last inserted ID
    $staff_no = $conn->insert_id; // Get the last inserted ID
    $staff_token = $staff_no; // Set staff_token to the same value as staff_no

    // Update the staff_token in the database
    $update_stmt = $conn->prepare("UPDATE `user-staff` SET staff_token = ? WHERE staff_no = ?");
    $update_stmt->bind_param("ii", $staff_token, $staff_no);
    $update_stmt->execute();
    $update_stmt->close();

    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
