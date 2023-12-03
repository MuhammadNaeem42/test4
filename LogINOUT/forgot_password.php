<?php $currentPage = "Forget Password"; ?>
<?php
session_start();
ob_start();
require_once("includes/db.php");
require_once('includes/header.php');


if(isset($_POST['submit'])){

	$email = escape($_POST['email']);



	$query = "SELECT * FROM users WHERE email = '$email'";

	$query_run = mysqli_query($conn, $query);

	$resor = mysqli_fetch_assoc($query_run);

	$token = $resor['validation_key'];

	$count = mysqli_num_rows($query_run);

	if($count > 0){
		//generate otp
		$otp = rand(100000, 999999);

		$_SESSION['otp'] = $otp;
		
		//send otp
		$mail->addAddress($email);
		
		$result = mysqli_fetch_assoc($query_run);

		$token = $result['validation_key'];
		$expire_date = date("Y-m-d H-i-s", time() + 120);
		$expire_date = base64_encode(urlencode($expire_date));

		$mail->isHTML();
		$mail->Subject = "Reset your password";
		$mail->Body = "<h2>Use the code to reset password</h2>
		<h2>The OTP is $otp</h2>";

		if($mail->send()){

			$result = mysqli_query($connection, "UPDATE users SET otp = '$otp' WHERE email = '$email'");

			header('location: otp.php');
			$current_id = mysqli_insert_id($connection);

			if(!empty($current_id)){
				header("location: otp.php?email='$email'&eid='$token'");
			}else{
				echo "otp not found";
			}
		}else{
			echo "not";
		}
		
	}else{
		$err = "Sorry Email not found!";
	}
}
?>

<div class="container padding-bottom-3x mb-2 mt-5">
	<div class="row justify-content-center">
		<div class="col-lg-8 col-md-10">
			<div class="forgot">

				<h2>Forgot your password?</h2>
				<p>Change your password in three easy steps. This will help you to secure your password!</p>
				<ol class="list-unstyled">
					<li><span class="text-primary text-medium">1. </span>Enter your email address below.</li>
					<li><span class="text-primary text-medium">2. </span>Our system will send you an OTP</li>
					<li><span class="text-primary text-medium">3. </span>Use the link to reset your password</li>
				</ol>

			</div>
			<?php echo isset($err) ? "<span class='form-control alert alert-danger'>{$err}</span>" : ""  ?>
			<?php echo isset($success) ? "<span class='form-control alert alert-success'>{$success}</span>" : ""  ?>

			<form class="card mt-4" action="" method="POST">
				<div class="card-body">
					<div class="form-group">
						<label for="email-for-pass">Enter your email address</label>
						<input class="form-control" type="text" id="email-for-pass" name="email"><small class="form-text text-muted">Enter the email address you used during the registration. Then we'll email a link to this address.</small>
					</div>
				</div>
				<div class="card-footer">
				<input class="btn btn-success" type="submit" value="Get OTP" name="submit">
				<a href="login.php" class="btn btn-danger" type="submit">Back to Login</a>
				</div>
			</form>
		</div>
	</div>
</div>
