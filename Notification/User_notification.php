<?php 
session_start();
include "../include/DBconn.php";
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "Notification_Page" content = "Notification_Page">
        <title>Booking Appointment System</title>
        <link rel="stylesheet" href="../style/Notificationxx.css">
        <script src="../js/Notificationxx.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
    </head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
 
        <!-- Nav bar -->
        <?php 
            include("../include/navigation.php");
            include("../include/DBconn.php");
        ?>
        
        <div class="container" id="table1">
            <div class="row">
                <table class="table caption-top">
                    <caption>Notification</caption>
                    <thead class="table-dark">
                        <tr>
                            <th class="no" scope="col">#</th>
                            <th class="id" scope="col">Appointment ID</th>
                            <th class="details" scope="col">Details</th>
                            <th class="datetime" scope="col">Date/ Time</th>
                        </tr>
                    </thead>
                    <tbody id="result">
                        <?php                         
                        // $custid = $_SESSION['id'];
                        // WHERE cust_id = '{$custid}'
                        $sr_no = 1;
                        $sql_get=mysqli_query($conn, "SELECT * FROM notification_tb ORDER BY noti_date DESC");
                        
                        if($sql_get -> num_rows > 0):
                            while($main_result = mysqli_fetch_object($sql_get)):
                                ?>
                                <tr id="data_row">
                                    <th class="sr_no" scope="row">
                                        <?php echo $sr_no++; ?>.
                                    </th>
                                    <th class="id_no" scope="row">
                                        Appointment #<?php echo $main_result->appointment_id;?><br>
                                        <p class="a_type">" <?php echo $main_result->appointment_type;?> "</p>
                                    </th>
                                    <td class="custName">
                                        <?php echo $main_result->cust_name;?><br>
                                        <p class="notiDetails"><?php echo $main_result->details;?></p>
                                        <button class="readMore" class="btn btn-primary" data-toggle="modal" data-target="#myModal" 
                                        id="<?php echo $main_result->appointment_id;?>" onclick="loadData(this);">
                                        Read More
                                        </button>
                                    </td>
                                    <td class="dateNtime">
                                        <?php echo $main_result->noti_date;?><br>
                                        <?php echo $main_result->noti_day;?><br>
                                        <p class="notiTime"><?php echo $main_result->noti_time;?></p>
                                    </td>
                                </tr>
                            <?php endwhile ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Notification Type : "<span id="notitype"></span>"
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Appointment #<span id="appid"></span></p>
                    <p>Appointment Date : <span id="aptdate"></span></p>
                    <p>Appointment Time : <span id="apttime"></span></p></br>
                    <p>Customer Name : <span id="custname"></span></p>
                    <p>Details : "<span id="details"></span>"</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <?php include('../include/footer.php') ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script>

            //Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('e43d8cddaeae61172fde', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                //alert(JSON.stringify(data));
                $.ajax({url: "real_time_user.php", success: function(result){
                    $("#result").html(result);
                }});
            });
            
            function loadData(button) {
                var appointment_id = button.id
                $.ajax({
                    url: "appoint.php",
                    method: "GET",
                    data: {"appointment_id": appointment_id},
                    success: function (response) {
                        var main_result = JSON.parse(response);

                        $("#notitype").text(main_result.appointment_type);
                        $("#appid").text(main_result.appointment_id);
                        $("#custname").text(main_result.cust_name);
                        $("#details").text(main_result.details);
                        $("#aptdate").text(main_result.apt_date);
                        $("#apttime").text(main_result.apt_time);
                    }
                });
            }
        </script>

    </body>

</html>