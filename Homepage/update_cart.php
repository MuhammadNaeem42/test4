<?php
// Ensure session is started
session_start();
include "../include/DBconn.php";

$response = ['success' => false, 'error' => ''];

if(isset($_POST['productId'], $_POST['newQty'])) {
    $productId = $_POST['productId'];
    $newQty = $_POST['newQty'];
    $userId = $_SESSION['id'];

    // If the new quantity is zero, delete the item from the cart
    if ($newQty == 0) {
        if($stmt = $conn->prepare("DELETE FROM Cart_Items WHERE product_id = ? AND cart_id = (SELECT cart_id FROM Cart WHERE customer_id = ?)")) {
            $stmt->bind_param("ii", $productId, $userId);
            if($stmt->execute()) {
                $response['success'] = true;
            } else {
                // Log error if the query fails
                $response['error'] = "Error executing delete statement: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $response['error'] = "Error preparing delete statement: " . $conn->error;
        }
    } else {
        // Update the quantity in the cart
        if($stmt = $conn->prepare("UPDATE Cart_Items SET quantity = ? WHERE product_id = ? AND cart_id = (SELECT cart_id FROM Cart WHERE customer_id = ?)")) {
            $stmt->bind_param("iii", $newQty, $productId, $userId);
            if($stmt->execute()) {
                $response['success'] = true;

                // Fetch the new total price from the database
                $stmt = $conn->prepare("SELECT (product_price * ?) AS total_price FROM Products WHERE product_ID = ?");
                $stmt->bind_param("ii", $newQty, $productId);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $response['newTotal'] = $row['total_price'];
            } else {
                // Log error if the query fails
                $response['error'] = "Error executing update statement: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $response['error'] = "Error preparing update statement: " . $conn->error;
        }
    }
} else {
    $response['error'] = "productId or newQty not set in POST request.";
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
