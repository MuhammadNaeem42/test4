<?php
    include("../include/DBconn.php");
    $appointment_id = $_GET["appointment_id"];
    $result = mysqli_query($conn, "SELECT * FROM notification_tb WHERE appointment_id=$appointment_id");

    $appoint = mysqli_fetch_assoc($result);
    echo json_encode($appoint); // Returning the JSON string
?>