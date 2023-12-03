<?php $currentPage = "New Password"; ?>
<?php require_once('includes/header.php');
require_once('includes/db.php');


if (isset($_GET['token'])) {
	$otp = $_GET['token'];

	if (isset($_POST['submit'])) {
		$pass = $_POST['pass'];
		$c_pass = $_POST['c_pass'];

		if ($pass == $c_pass) {

			//password validation
			$pattern_up = "/^.*(?=.{4,56})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/";
			if (!preg_match($pattern_up, $pass)) {
				$errPassword = "Must be at lest 4 character long, 1 upper case, 1 lower case letter and 1 number exist";
			}else{
				$password = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 10]);

				$query = "UPDATE `users` SET `password` = '$password' WHERE `otp` = $otp";

				$query_run = mysqli_query($connection, $query);

				if(!$query_run){
					echo "Connection error";
				}else{
					$success = "Password has been changed successfully!";
				}
			}
		} else {
			$errPass = "Password doesn't match!";
		}
	}
}

?>
<div class="container padding-bottom-3x mb-2 mt-5">
	<div class="row justify-content-center">
		<div class="col-lg-8 col-md-10">
			<div class="forgot">

				<h2>Reset your password?</h2>


			</div>
			<?php echo isset($errPass) ? "<span class='form-control alert alert-danger'>{$errPass}</span>" : ""  ?>
			<?php echo isset($errPassword) ? "<span class='form-control alert alert-danger'>{$errPassword}</span>" : ""  ?>
			<?php echo isset($success) ? "<span class='form-control alert alert-success'>{$success}</span>" : ""  ?>

			<form class="card mt-4" action="" method="POST">
				<div class="card-body">
					<div class="form-group">
						<label for="email-for-pass">Enter Your New Password</label>
						<input class="form-control" type="password" id="email-for-pass" name="pass">
					</div>
					<div class="form-group">
						<label for="email-for-pass">Confirm Your Password</label>
						<input class="form-control" type="password" id="email-for-pass" name="c_pass">
					</div>
				</div>
				<div class="card-footer">
					<input class="btn btn-success" type="submit" value="Change Password" name="submit">
					<a href="login.php" class="btn btn-danger" type="submit">Back to Login</a>
				</div>
			</form>
		</div>
	</div>
</div>
<?php require_once('includes/footer.php') ?>