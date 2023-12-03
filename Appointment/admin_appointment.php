<?php
session_start();
include "../include/DBconn.php";
?>
<!DOCTYPE html>
<html lang="en">
    

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Appointment Module" />
    <meta name="author" content="Kelvin Ho Juin Ket" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Appointment - admin</title>
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
    <link rel="stylesheet" href="./../style/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <link rel="stylesheet" type="text/css" href="./../style/Appointment.css"/>  
    <link rel="stylesheet" href="https://unpkg.com/js-datepicker/dist/datepicker.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
    <script src="./../js/jquery-3.6.1.min.js"></script>
    <script src="./../js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
</head>

<body>
    
    <!-- Nav bar -->
    <?php include "./../include/admin_navigation.php";?>

    
    <div class="container py-4" id="page-container">
        <div class="row mt-5">
            <div class="col-md-9 mx-auto mt-5">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3 mt-5">
                <div class="booking-container cardt rounded-0 shadow mt-3">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title">Add dates to make available</h5>
                    </div>
                    <div class="card-body mt-2">
                        <div class="container-fluid">
                            <form action="save_slots.php" method="post" id="schedule-form">
                                
                                <div class="form-group mb-2">
                                    <label for="aptDate" class="control-label">Date</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="aptDate" id="aptDate" autocomplete="off" required>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                    <div class="card-footer mt-4">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Booking Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Member ID</dt>
                            <dd id="member_id" class=""></dd>

                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Date</dt>
                            <dd id="fdate" class=""></dd>
                            <dt class="text-muted">Time</dt>
                            <dd id="ftime" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->

<?php 
$schedules = $conn->query("SELECT * FROM `booking_list`");
$sched_res = [];
foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
    $row['ffdate'] = date("F d, Y", strtotime($row['aptDate']));
    $sched_res[$row['id']] = $row;
}
?>

<script>

$(function() {
  $('#aptDate').daterangepicker({
    opens: 'center',
    minDate: new Date()
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>


<?php 
if(isset($conn)) $conn->close();
?>
<!-- <?php //include "./../include/footer.php";?> -->

</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="./../js/Appointment.js"></script>

</html>
