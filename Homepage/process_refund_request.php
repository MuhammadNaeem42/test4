<?php
include "../include/DBconn.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the request ID and action from the POST request
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];
    $admin_response = $_POST['admin_response'] ?? ''; // Optional admin response

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Prepare the SQL based on the action
        if ($action === 'approve') {
            $status = 'approved';
            $order_status = 'cancelled'; // Set the order status to cancelled
            $message = "Your refund request #$request_id has been approved.";
        } elseif ($action === 'reject') {
            $status = 'rejected';
            $message = "Your refund request #$request_id has been rejected.";
        } elseif ($action === 'forward') {
            $status = 'forwarded';
            $message = "Your refund request #$request_id has been forwarded to the seller.";

            // Update the refund request status to 'forwarded'
            $update_query = "UPDATE refundrequests SET status = ?, admin_response = ? WHERE request_id = ?";
            $stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($stmt, "ssi", $status, $admin_response, $request_id);
            mysqli_stmt_execute($stmt);

            // Get the seller_id associated with the order
            // Assuming you have a way to get the seller_id from the order_id or product_id
            $seller_query = "SELECT seller_id FROM products WHERE product_id = (SELECT product_id FROM orderdetails WHERE order_id = (SELECT order_id FROM refundrequests WHERE request_id = ?))";
            $stmt = mysqli_prepare($conn, $seller_query);
            mysqli_stmt_bind_param($stmt, "i", $request_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $seller = mysqli_fetch_assoc($result);
            $seller_id = $seller['seller_id'];

            // Insert a notification for the seller
            $insert_seller_notification_query = "INSERT INTO notifications (user_id, message) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $insert_seller_notification_query);
            mysqli_stmt_bind_param($stmt, "is", $seller_id, $message);
            mysqli_stmt_execute($stmt);
        } else {
            // Redirect back or handle error
            header('Location: refund_requests_page.php?error=InvalidAction');
            exit;
        }

        // Update the refund request status
        $update_query = "UPDATE refundrequests SET status = ?, admin_response = ? WHERE request_id = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, "ssi", $status, $admin_response, $request_id);
        mysqli_stmt_execute($stmt);

        // If the action is approve, also update the order status
        if ($action === 'approve') {
            // Get the order_id for the refund request
            $order_query = "SELECT order_id FROM refundrequests WHERE request_id = ?";
            $stmt = mysqli_prepare($conn, $order_query);
            mysqli_stmt_bind_param($stmt, "i", $request_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $order = mysqli_fetch_assoc($result);
            $order_id = $order['order_id'];

            // Update the order status to cancelled
            $update_order_query = "UPDATE orders SET order_status = ? WHERE order_id = ?";
            $stmt = mysqli_prepare($conn, $update_order_query);
            mysqli_stmt_bind_param($stmt, "si", $order_status, $order_id);
            mysqli_stmt_execute($stmt);
        }

        // Get user_id for the notification
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

        // Commit transaction
        mysqli_commit($conn);

        // Redirect back to the refund requests page with a success message
        header('Location: refund_requests_page.php?success=ActionProcessed');
        exit;
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($conn);
        // Handle exception, perhaps log it and redirect with an error message
        header('Location: refund_requests_page.php?error=ActionFailed');
        exit;
    }
}

// Redirect back if the form wasn't submitted
header('Location: refund_requests_page.php');
exit;
?>


