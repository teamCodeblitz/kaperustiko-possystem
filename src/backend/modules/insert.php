<?php
include '../config/connection.php';

// Ensure that the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
    exit; // Stop execution if the method is not POST
}

// Handle different POST actions
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'POST') {
    // Check if the request is form-data
    if (isset($_FILES['image'])) {
        // Handle product upload
        $data = $_POST; // Use $_POST to get form data

        // Check if the required fields are set
        if (!isset($data['code'], $data['title1'], $data['label'], $data['qty'])) {
            echo json_encode(["error" => "Missing required fields"]);
            exit;
        }

        // Handle image upload
        $imageFile = $_FILES['image'];
        $targetDir = "../../static/foods/";
        $targetFile = $targetDir . basename($imageFile["name"]);
        
        // Create directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Check for upload errors
        if ($imageFile['error'] !== UPLOAD_ERR_OK) {
            error_log("Upload error: " . $imageFile['error']);
            echo json_encode(["status" => "error", "message" => "Failed to upload image"]);
            exit;
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($imageFile["tmp_name"], $targetFile)) {
            $data['image'] = basename($imageFile["name"]); // Store only filename in database
        } else {
            error_log("Failed to move uploaded file to: " . $targetFile);
            echo json_encode(["status" => "error", "message" => "Failed to save image"]);
            exit;
        }

        // Prepare and bind for product upload
        $stmt = $conn->prepare("INSERT INTO `pos-menu` (code, title1, title2, label, label2, price1, price2, price3, qty, stock_date, stock_time, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $currentDate = date('Y-m-d'); // Store date in a variable
        $currentTime = date('H:i:s');   // Store time in a variable

        $stmt->bind_param("sssssiiiisss", 
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

    // Handle remit sales
    if (isset($data['cashier_name']) && isset($data['total_sales'])) {
        $stmt = $conn->prepare("INSERT INTO remit_sales (cashier_name, total_sales, remit_date, remit_time, remit_shortage, remit_validation) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $data['cashier_name'], $data['total_sales'], $data['remit_date'], $data['remit_time'], $data['remit_shortage'], $data['remit_validation']);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Record added successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
        }
        $stmt->close();
    }

    // Handle remit returns
    if (isset($data['return_validation'])) {
        $stmt = $conn->prepare("INSERT INTO remit_returns (cashier_name, total_sales, return_date, return_time, return_validation) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['cashier_name'], $data['total_sales'], $data['return_date'], $data['return_time'], $data['return_validation']);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Record added successfully."]);
        } else {
            error_log("Error executing statement: " . $stmt->error); // Log the error
            echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
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
