<?php 
session_start();
include "../include/DBconn.php";
require '../Notification/vendor/autoload.php';

if(!isset($_GET['id'])){
    echo "<script> alert('Undefined Schedule ID.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

date_default_timezone_set("Asia/Kuching");

$options = array(
    'cluster' => 'ap1',
    'useTLS' => true
);

$pusher = new Pusher\Pusher(
    'e43d8cddaeae61172fde',
    'b1855b80caf087fc83e6',
    '1498123',
    $options
);

$custid = $_SESSION['id'];

$getname = mysqli_query($conn, "SELECT username FROM users WHERE id = '{$custid}'");
while ($row = mysqli_fetch_object($getname)){
    $current_name = $row->username;
}

$date = date('Y-m-d');
$day = date('l');
$time = date('h:i A');

$apt_id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT apt_Date, apt_Time FROM notification_tb WHERE appointment_id = '{$apt_id}'");
while ($row = mysqli_fetch_object($sql)){
    $aptDate = $row->apt_Date;
    $aptTime = $row->apt_Time;
}

$delete = $conn->query("DELETE FROM `booking_list` where id = '{$_GET['id']}'");
if($delete){
    echo "<script> alert('Event has deleted successfully.'); location.replace('./appointment.php') </script>";
    $type = "Cancelled";
    $msg = "Your Appointment Has Been Cancelled";
    
    
    $noti_sql = "INSERT INTO notification_tb (appointment_id, appointment_type, cust_id, cust_name, details, apt_status, apt_date, apt_time, noti_date, noti_day, noti_time)
    VALUES ('$apt_id', '$type', '$custid', '$current_name', '$msg', 'Inactive', '$aptDate', '$aptTime', '$date', '$day', '$time')";
    $noti_save = $conn->query($noti_sql);
    
    $status_update = "UPDATE notification_tb SET apt_status = 'Inactive' WHERE appointment_id = '{$apt_id}'";
    $noti_save = $conn->query($status_update);

}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}

if($noti_save){
    $data['message'] = 'hello world';
    $pusher->trigger('my-channel', 'my-event', $data);
    echo "<script>alert(Notification Created Successfully !);</script>";
}else{
    echo mysqli_error($conn);
    exit;
}
$conn->close();
?>