<?php
include '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['code']) && isset($data['qty'])) {
        $code = $data['code'];
        $orderQty = $data['qty'];

        // First get the current quantity
        $sql = "SELECT qty FROM `pos-menu` WHERE code = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $currentQty = $row['qty'];
            // Calculate new quantity by subtracting order quantity
            $newQty = $currentQty - $orderQty;
            
            // Update with new quantity
            $updateSql = "UPDATE `pos-menu` SET qty = ?, stock_date = ?, stock_time = ? WHERE code = ?";
            $updateStmt = $conn->prepare($updateSql);
            
            date_default_timezone_set('Asia/Manila');
            $currentDate = date('Y-m-d');
            $currentTime = date('H:i:s');
            
            $updateStmt->bind_param("isss", $newQty, $currentDate, $currentTime, $code);
            $updateStmt->execute();
            
            if ($updateStmt->affected_rows > 0) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Quantity updated successfully",
                    "new_qty" => $newQty
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Failed to update quantity"
                ]);
            }
            $updateStmt->close();
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Product not found"
            ]);
        }
        $stmt->close();
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid request data"
        ]);
    }
}

$conn->close();
?>
