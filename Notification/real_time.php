<?php
include("../include/DBconn.php");

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