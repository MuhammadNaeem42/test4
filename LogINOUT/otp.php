<?php
$currentPage = "OTP";
session_start();
ob_start();
require_once('includes/header.php');
require_once('includes/db.php');

if(!isset($_SESSION['otp'])){
    header('location: login.php');
}
if(isset($_POST['submit'])){

    $otp = $_POST['otp'];
    
    $query = "SELECT * FROM users WHERE otp='$otp';";

    $result = mysqli_query($connection, $query);

    $result1 = mysqli_num_rows($result);

    if($result1 > 0){
        header("location: new_password.php?token='$otp'");
    }else{
        $err = "Wrong OTP!";
    }
}

?>



<div class="container padding-bottom-3x mb-2 mt-5">
	<div class="row justify-content-center">
		<div class="col-lg-8 col-md-10">
			<div class="forgot">

				<h2>Enter your OTP</h2>
				

			</div>
			<?php echo isset($err) ? "<span class='form-control alert alert-danger'>{$err}</span>" : ""  ?>
			<?php echo isset($success) ? "<span class='form-control alert alert-success'>{$success}</span>" : ""  ?>

			<form class="card mt-4" action="" method="POST">
				<div class="card-body">
					<div class="form-group">
						<label for="email-for-pass">Enter your OTP</label>
						<input class="form-control" type="number" id="email-for-pass" name="otp"><small class="form-text text-muted">Enter the OTP you get at your email address.</small>
					</div>
				</div>
				<div class="card-footer">
				<input class="btn btn-success" type="submit" value="Submit" name="submit">
				<a href="login.php" class="btn btn-danger" type="submit">Back to Login</a>
				</div>
			</form>
		</div>
	</div>
</div>