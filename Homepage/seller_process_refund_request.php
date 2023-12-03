<?php
include "../include/DBconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];
    $seller_id = $_SESSION['seller_id']; // Get the seller's ID from the session

    mysqli_begin_transaction($conn);

    try {
        if ($action === 'accept') {
            // Seller accepts the refund request
            $status = 'accepted by seller';
            $message = "Your refund request #$request_id has been accepted by the seller.";
        } elseif ($action === 'deny') {
            // Seller denies the refund request
            $status = 'denied by seller';
            $message = "Your refund request #$request_id has been denied by the seller.";
        } else {
            // Invalid action
            throw new Exception('Invalid action');
        }

        // Update the refund request status
        $update_query = "UPDATE refundrequests SET status = ? WHERE request_id = ? AND EXISTS (SELECT 1 FROM products WHERE product_id = (SELECT product_id FROM orderdetails WHERE order_id = (SELECT order_id FROM refundrequests WHERE request_id = ?)) AND seller_id = ?)";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, "siii", $status, $request_id, $request_id, $seller_id);
        mysqli_stmt_execute($stmt);

        // Get the user_id to send a notification
        $user_query = "SELECT user_id FROM refundrequests WHERE request_id = ?";
        $stmt = mysqli_prepare($conn, $user_query);
        mysqli_stmt_bind_param($stmt, "i", $request_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['user_id'];

        // Insert a notification for the user
        $insert_notification_query = "INSERT INTO notifications (user_id, message) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insert_notification_query);
        mysqli_stmt_bind_param($stmt, "is", $user_id, $message);
        mysqli_stmt_execute($stmt);

        mysqli_commit($conn);
        header('Location: seller_notifications.php?success=ActionProcessed');
    } catch (Exception $e) {
        mysqli_rollback($conn);
        header('Location: seller_notifications.php?error=ActionFailed');
    }
} else {
    header('Location: seller_notifications.php');
}
exit;
?>
