<?php
include '../config/connection.php';

// Handle different POST actions
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    // Handle product upload
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

        // Prepare and bind for product upload
        $stmt = $conn->prepare("INSERT INTO `pos-menu` (code, title1, title2, label, label2, price1, price2, price3, qty, stock_date, stock_time, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $currentDate = date('Y-m-d'); // Store date in a variable
        $currentTime = date('H:i:s');   // Store time in a variable

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
            $currentDate,  // Use the variable
            $currentTime,  // Use the variable
            $data['image']
        );

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(array("message" => "Product uploaded successfully"));
        } else {
            echo json_encode(array("message" => "Failed to upload product"));
        }
        $stmt->close();
    }

    // Handle order saving
    if (isset($data['order_name'])) {
        $stmt = $conn->prepare("INSERT INTO orders (code, order_name, order_name2, order_quantity, order_size, order_price, order_addons, order_addons_price, order_addons2, order_addons_price2, order_addons3, order_addons_price3, order_image, basePrice) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisisisisisi", 
            $data['code'],
            $data['order_name'], 
            $data['order_name2'], 
            $data['order_quantity'], 
            $data['order_size'], 
            $data['order_price'], 
            $data['order_addons'], 
            $data['order_addons_price'], 
            $data['order_addons2'], 
            $data['order_addons_price2'], 
            $data['order_addons3'], 
            $data['order_addons_price3'], 
            $data['order_image'],
            $data['basePrice']
        );

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Order saved successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
        }
        $stmt->close();
    }

    // Handle return order
    if (isset($data['receipt_number'])) {
        $stmt = $conn->prepare("INSERT INTO `return-orders` (receipt_number, return_date, return_time, cashier_name, items_ordered, total_amount, amount_paid, amount_change, order_take) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssddds", 
            $data['receipt_number'], 
            $data['return_date'], 
            $data['return_time'], 
            $data['cashier_name'], 
            $data['items_ordered'], 
            $data['total_amount'], 
            $data['amount_paid'], 
            $data['amount_change'], 
            $data['order_take']
        );

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => $stmt->error]);
        }
        $stmt->close();
    }


    // Handle saving receipt
    if (isset($data['receiptNumber'])) {
        // Check if the data is valid and contains the required keys
        if (!isset($data['date'], $data['time'], $data['cashierName'], $data['itemsOrdered'], $data['totalAmount'], $data['amountPaid'], $data['change'], $data['order_take'])) {
            echo json_encode(["error" => "Invalid input data"]);
            exit; // Stop execution if input is invalid
        }

        $receiptNumber = $data['receiptNumber'];
        $date = $data['date'];
        $time = $data['time'];
        $cashierName = $data['cashierName'];
        $itemsOrderedJson = json_encode($data['itemsOrdered']); // Encode modified itemsOrdered
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
        $stmt->close();
    }
} else {
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
}

// Close the connection
$conn->close();
?>
