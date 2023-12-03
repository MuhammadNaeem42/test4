<?php
// submit_refund_request.php
session_start();
include "../include/DBconn.php";
// Start the session and ensure the user is logged in

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $user_id = $_SESSION['id']; // Get the user ID from the session
    $reason = $_POST['reason'];
    $details = $_POST['details'];
    $images = ''; // This will be a JSON array of uploaded image paths

    // Handle file uploads and save paths to $images...

    // Insert the refund request into the database
    $stmt = $conn->prepare("
        INSERT INTO RefundRequests (order_id, user_id, reason, details, images)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("iisss", $order_id, $user_id, $reason, $details, $images);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header('Location: Homepage.php');
    exit();
    } else {
        echo 'erroor';
    }

    $stmt->close();
}
?>
