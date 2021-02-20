<?php
session_start();
include('connection.php');
$page = basename(__FILE__);

if (isset($_REQUEST['submit']) && isset($_POST['email']) && isset($_POST['password'])) {
	$email = strtolower($_POST['email']);
	$password = $_POST['password'];
	echo $email . " " . $password;
	$checkmail = mysqli_query($conn, "SELECT * FROM `user` where  `email`='$email' ") or die(mysqli_error($conn));

	if (mysqli_num_rows($checkmail) > 0) {

		$statusquery = mysqli_query($conn, "SELECT status FROM `user` where  `email`='$email' and `status`='1'") or die(mysqli_error($conn));

		if (mysqli_num_rows($statusquery) > 0) {

			$hashqry = mysqli_query($conn, "SELECT password FROM `user` where  `email`='$email' ") or die(mysqli_error($conn));
			$arr = mysqli_fetch_array($hashqry);
			$hash = $arr[0];
			// echo $hash;

			if (password_verify($_REQUEST['password'], $hash)) {
				//echo 'Password is valid!';

				//$password = password_hash($_REQUEST['password'], PASSWORD_BCRYPT);
				$prodta = mysqli_query($conn, "SELECT * FROM `user` where `email`='$email' ") or die(mysqli_error($conn));

				if (mysqli_num_rows($prodta) != 0) {
					$datauser = mysqli_fetch_array($prodta);
					$_SESSION['uid'] = $datauser['uid'];
					$_SESSION['email'] = $datauser['email'];
					$_SESSION['name'] = $datauser['uname'];
					//$usrid = $_SESSION['uid'];
					// // $chkcartdata =mysqli_query($conn, "SELECT * FROM tbl_cart  WHERE user_id='".$usrid."'");
					// // $crtdtl =mysqli_num_rows($chkcartdata); 
					// // $_SESSION["shopping_cart"] = $crtdtl;
					if (isset($_SESSION['pagename'])) {
						$pagename = $_SESSION['pagename'];
						header("location:$pagename");
					} else
						header('location:index.php');
					//echo '<script> alert("'.$_SESSION['uid'].'") </script>';
				}
			} else {
				echo '<script> alert("Incorrect password, Please try again.") </script>';
			}
		} else {
			echo '<script> alert("Please, activate your account by clicking on activation link that has been sent to your mail then try again") </script>';
		}
	} else {
		header('location:registration.php');
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

	<!-- Start Header Area -->
	<?php include('header.php'); ?>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center">
				<div class="col-first">
					<h1>Login</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home &nbsp;> &nbsp;</a>
						<a href="login.php">Login</a>
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
						<img class="img-fluid" src="img/login.jpg" alt="">
						<div class="hover">
							<h4>New to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="primary-btn" href="registration.php">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" action="login.php" method="post" id="loginForm">
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" oninvalid="" title="Email cannot be left blank" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" required>
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" title="Password cannot be left blank" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
							</div>
							<!-- <div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div> -->
							<div class="col-md-12 form-group">
								<button type="submit" name="submit" value="submit" class="primary-btn">Log In</button>
								<a href="#" data-target="#pwdModal" data-toggle="modal">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--modal-->
	<div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content forgot-content">
				<div class="modal-header">
					<h1 class="text-center forgot-head-text">What's My Password?</h1>
					<button id="dismissmodal" type="button" class="close forgot-xBtn" data-dismiss="modal" aria-hidden="true">
						×
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="text-center">
									<p>
										If you have forgotten your password you can reset it here.
									</p>
									<div class="panel-body">
										<fieldset>
											<div class="form-group">
												<input id="resetEmail" class="form-control input-lg" placeholder="E-mail Address" name="email" type="email" />
											</div>
											<button id="resetBtn" class="btn btn-lg btn-primary btn-block forgot-btn">Reset Password</button>
										</fieldset>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-md-12">
						<button class="btn" data-dismiss="modal" aria-hidden="true">
							Cancel
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--modal end-->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#resetBtn').click(function() {
				resetmail = $('#resetEmail').val().toLowerCase();
				if (resetmail) {
					//alert(resetmail);
					if (!isValidEmailAddress(resetmail)) {
						$('#resetEmail').css("border", "1px solid red")
						$('#resetEmail').val('');
						$('#resetEmail').attr("placeholder", "Please enter valid email");
					} else {
						$('#resetEmail').css("border", "1px solid green").focus().blur();
						$.ajax({
							url: 'reset.php',
							method: 'POST',
							data: {
								email: resetmail
							},
							beforeSend: function() {
								$('#resetBtn').html("Processing reset request...");
							},
							success: function(response) {
								$('body').focus();
								$('#resetBtn').html(response);
							}
						});
					}
				} else {
					$('#resetEmail').css("border", "1px solid red").focus().blur();
				}
			});

			$('#dismissmodal').click(function() {
				$("#resetEmail").attr("placeholder", "Email Address").val('').focus().blur().css("border", "1px solid grey");
			});
		});

		function isValidEmailAddress(emailAddress) {
			var pattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
			// var pattern = new RegExp(pattern);
			return emailAddress.match(pattern);
			//return pattern.test(emailAddress);
		}
	</script>

	<!--================End Login Box Area =================-->

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


	<!-- The core Firebase JS SDK is always required and must be listed first -->
	<script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-app.js"></script>

	<!-- TODO: Add SDKs for Firebase products that you want to use
		https://firebase.google.com/docs/web/setup#available-libraries -->
	<script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-analytics.js"></script>

	<script>
	// Your web app's Firebase configuration
	// For Firebase JS SDK v7.20.0 and later, measurementId is optional
	var firebaseConfig = {
		apiKey: "AIzaSyCQPRPDngru-PX28d5bK5f2z9owKbOaUzY",
		authDomain: "ygnnutrition-e055f.firebaseapp.com",
		projectId: "ygnnutrition-e055f",
		storageBucket: "ygnnutrition-e055f.appspot.com",
		messagingSenderId: "232429323214",
		appId: "1:232429323214:web:bab7f8fe75df069c11219f",
		measurementId: "G-NE8WVBXVK8"
	};
	// Initialize Firebase
	firebase.initializeApp(firebaseConfig);
	firebase.analytics();
	</script>
</body>
</html>