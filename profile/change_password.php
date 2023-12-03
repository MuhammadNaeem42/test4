<?php
session_start();
require_once('../include/dbConn.php'); // Adjust path as needed

// Check if data was posted and session is valid
if (isset($_POST['currentPassword'], $_POST['newPassword']) && isset($_SESSION['id'])) {
    $userId = $_SESSION['id']; // Retrieve user ID from session
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];

    // Fetch the user's current password from DB to compare
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify current password
    if (password_verify($currentPassword, $user['password'])) {
        // Current password is correct, proceed to change to new password
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password in the database
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $newPasswordHash, $userId);

        if ($stmt->execute()) {
            // Password updated successfully
            echo 'success';
        } else {
            // Couldn't update the password
            echo 'Database error';
        }
    } else {
        // Current password is not correct
        echo 'Incorrect current password';
    }
} else {
    // Invalid request
    echo 'Invalid request';
}
?>
