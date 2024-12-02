<?php
include 'config/connection.php';

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
