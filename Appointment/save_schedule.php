<?php
session_start();
require_once('./../include/DBconn.php');
require '../Notification/vendor/autoload.php';

date_default_timezone_set("Asia/Kuching");

extract($_POST);
$allday = isset($allday);

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

$aptDate = date('Y-m-d',strtotime($aptDate));
$sql = "SELECT id, aptDate, aptTime FROM booking_list WHERE aptDate = '{$aptDate}' AND aptTime = '{$aptTime}'";
$result = $conn->query($sql);

if($aptTime == "9:00 AM - 10:00 AM"){
    $alerttime = date("$aptDate 8:30:00");
    $endtime = date("$aptDate 10:00:00");
}elseif($aptTime == "10:00 AM - 11:00 AM"){
    $alerttime = date("$aptDate 9:30:00");
    $endtime = date("$aptDate 11:00:00");
}elseif($aptTime == "1:00 PM - 2:00 PM"){
    $alerttime = date("$aptDate 12:30:00");
    $endtime = date("$aptDate 14:00:00");
}elseif($aptTime == "2:00 PM - 3:00 PM"){
    $alerttime = date("$aptDate 13:30:00");
    $endtime = date("$aptDate 15:00:00");
}


if (mysqli_num_rows($result)<2){
    if(empty($id)){

        $type = "Accepted";
        $msg = "Your Appointment Has Been Accepted";

        $sql = "INSERT INTO `booking_list` (`member_id`,`title`,`description`,`aptDate`,`aptTime`) VALUES ('{$custid}','$title','$description','$aptDate','$aptTime')";
        $save = $conn->query($sql);

        $last_id = $conn->insert_id;

        $noti_sql = "INSERT INTO notification_tb (appointment_id, appointment_type, cust_id, cust_name, details, apt_status, alert_time, end_time, apt_date, apt_time, noti_date, noti_day, noti_time)
        VALUES ('$last_id', '$type', '$custid', '$current_name', '$msg', 'Active', '$alerttime', '$endtime', '$aptDate', '$aptTime', '$date', '$day', '$time')";

        $noti_save = $conn->query($noti_sql);

    }else{

        $type="Changed";
        $msg = "Your Appointment Has Been Changed";
        $getlast_id = mysqli_query($conn, "SELECT id FROM booking_list WHERE id = '{$id}'");
        while ($row = mysqli_fetch_object($getlast_id)){
            $last_id = $row->id;
        }

        $sql = "UPDATE `booking_list` set `title` = '{$title}', `description` = '{$description}', `aptDate` = '{$aptDate}', `aptTime` = '{$aptTime}' where `id` = '{$id}'";
        $save = $conn->query($sql);

        $noti_sql = "INSERT INTO notification_tb (appointment_id, appointment_type, cust_id, cust_name, details, apt_status, alert_time, end_time, apt_date, apt_time, noti_date, noti_day, noti_time)
        VALUES ('$last_id', '$type', '$custid', '$current_name', '$msg', 'Active', '$alerttime', '$endtime', '$aptDate', '$aptTime', '$date', '$day', '$time')";

        $noti_save = $conn->query($noti_sql);
        $status_update = "UPDATE notification_tb SET apt_status = 'Inactive' WHERE appointment_id = '{$last_id}' AND appointment_type = 'Accepted'";
        $noti_save = $conn->query($status_update);
    }
    
}
else{
    echo "<script> alert('Sorry. Time chosen are full'); location.replace('./appointment.php') </script>";
}

if($save){
    echo "<script> alert('Booking Successfully Saved.'); location.replace('./appointment.php') </script>";
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

<script>
// function formatTime(date) {
//   var hours = date.getHours();
//   var minutes = date.getMinutes();
//   hours = hours % 12;
//   hours = hours ? hours : 12; // the hour '0' should be '12'
//   minutes = minutes < 10 ? '0'+minutes : minutes;
//   var strTime = hours + ':' + minutes;
//   return strTime;
// }

// function diff(start, end) {
//     start = start.split(":");
//     end = end.split(":");
//     var startDate = new Date(0, 0, 0, start[0], start[1], 0);
//     var endDate = new Date(0, 0, 0, end[0], end[1], 0);
//     var diff = endDate.getTime() - startDate.getTime();
//     var hours = Math.floor(diff / 1000 / 60/ 60);
//     diff -= hours * 1000 * 60 * 60;
//     var minutes = Math.floor(diff/1000/ 60);
//     var total_minute = hours*60 + minutes
    
//     return total_minute;
// }
//    // Set the date we're counting down to
// var countDownDate = new Date($apt_date).getTime();

//     // Update the count down every 1 second
// var i = setInterval(function() {

//     // Get today's date and time
//     var now = new Date().getTime();
        
//     // Find the distance between now and the count down date
//     var date = countDownDate - now;
        
//     // Time calculations for days, hours, minutes and seconds
//     var days = Math.floor(date / (1000 * 60 * 60 * 24));
//     var hours = Math.floor((date % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//     var minutes = Math.floor((date % (1000 * 60 * 60)) / (1000 * 60));
//     var seconds = Math.floor((date % (1000 * 60)) / 1000);

//     // If the count down is over, write some text 
//         if (date < 0) {
//             x = diff(formatTime(new Date), time);
            
//         }
//     }, 1000);
//     return $noti_save;

</script>
