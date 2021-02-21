<?php
session_start();
include('connection.php');
require_once "functions.php";

if (isset($_GET['email']) && isset($_GET['token'])) {
	$email = mysqli_real_escape_string($conn, $_GET['email']);
	$token = mysqli_real_escape_string($conn, $_GET['token']);

	$sql = mysqli_query($conn, "SELECT uid FROM user WHERE email='$email' AND token='$token' AND token<>'' AND token_expire > NOW()") or die(mysqli_error($conn));

	if (mysqli_num_rows($sql) > 0) {
		//echo 'found';
		$_SESSION['email'] = $email;
		$_SESSION['token'] = $token;
	} else {
		header("Refresh:5; url=login.php");
		echo 'Link expired try resetting your password again';
	}
} else {
	//echo $_SESSION['email'].'  '.$_SESSION['token'];
	if (isset($_REQUEST['recover-submit']) && isset($_SESSION['email']) && isset($_SESSION['token'])) {
		$email = strtolower($_SESSION['email']);
		$password1 =  $_POST['password1'];
		$password2 =  $_POST['password2'];

		if ($password2 == $password1) {
			$newPassword = $password2;
			$newPasswordEncrypted = password_hash($newPassword, PASSWORD_BCRYPT);
			$reset = mysqli_query($conn, "UPDATE user SET token=NULL,token_expire=NULL, password = '$newPasswordEncrypted' WHERE email='$email'") or die(mysqli_error($conn));

			if (mysqli_affected_rows($conn) > 0) {
				// remove all session variables
				session_unset();
				// // destroy the session
				session_destroy();
				echo 'Password Changed successfully.</br> Page will be redirected to login page in 5 sec';
				header("Refresh:5; url=login.php");
			} else {
				echo 'Password did not changed';
			}
		} else {
			echo "Password not matched";
		}
	} else {
		echo 'Something went wrong </br> Redirecting to login page in 5 sec';
		header("Refresh:5; url=login.php");
	}
}
?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>YGN</title>

	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/jquery3_5_1.min.js"></script>
</head>

<body>

	<?php include('header.php'); ?>

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center">
				<div class="col-first">
					<h1>Login/Register</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home &nbsp;> &nbsp;</a>
						<a href="login.php">Login/</a><a href="registration.php">Register</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="img/login.jpg" alt="" />
						<div class="hover">
							<h4>Already Registered?</h4>
							<p>
								There are advances being made in science and technology
								everyday, and a good example of this is the
							</p>
							<a class="primary-btn" href="login.php">Login</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Change Password</h3>
						<form class="row login_form" action="reset-password.php" method="post" id="loginForm">
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="pswd" name="password1" title="Password should must contain (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars)" placeholder="New Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="confirm-pswd" name="password2" title="Password should must contain (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars)" placeholder="Re-enter Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Re-enter Password'" required>
							</div>
							<!-- <div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div> -->
							<div class="col-md-12 form-group">
								<button type="submit" name="recover-submit" value="submit" class="primary-btn">Change Password</button>
								</br>
								<p id="message"></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#confirm-pswd').on('keyup', function() {
				//alert($('#pswd').val()+' '+$('#confirm-pswd').val());
				if ($('#pswd').val() == $('#confirm-pswd').val()) {
					$('#confirm-pswd').css("border-bottom", "2px solid green").focus().blur();
					//$('#message').text('Matching').css('color', 'green');
				} else {
					//$('#message').text('Not Matching').css('color', 'red');
					$('#confirm-pswd').css("border-bottom", "2px solid red")
				}
			});
		});
	</script>

	<!-- start footer Area -->
	<?php include('footer.php'); ?>
	<!-- End footer Area -->


	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>