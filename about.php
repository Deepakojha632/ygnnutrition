<?php
session_start();
include('connection.php');
$userid;

if (isset($_SESSION['uid'])) {
	$userid = $_SESSION['uid'];
	$username = $_SESSION['name'];
	// echo $userid;
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
	<link rel="stylesheet" href="css/linearicons.css" />
	<link rel="stylesheet" href="css/owl.carousel.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/themify-icons.css" />
	<link rel="stylesheet" href="css/nice-select.css" />
	<link rel="stylesheet" href="css/nouislider.min.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
</head>

<body>

	<!-- Start Header Area -->
	<?php
	include('header.php');
	?>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb our-story-banner">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center">
				<div class="col-first">
					<h1>Our Story</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home > &nbsp;</a>
						<a href="category.html">Our Story</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================About Area =================-->
	<section class="about_area">
		<div class="container section_gap">
			<!-- <div class="main-text">
				Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut commodi dolorum harum pariatur earum deserunt mollitia asperiores ea dignissimos, quis sed molestiae reiciendis ipsam suscipit ducimus praesentium quisquam sint aut. Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis ad sequi distinctio harum nam nisi mollitia ab aliquid quo doloribus quos dolore quaerat eligendi et non omnis, tempora autem voluptate! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis ea fuga, veniam earum ducimus excepturi ipsam suscipit laudantium asperiores nostrum officia est voluptas velit dignissimos nihil perferendis hic? Voluptas, quo!
			</div> -->
			<div class="row">
				<div class="col-lg-12 text-content">
					<h1>YGN is one of the most fast growing sports nutrition and active lifestyle brand.</h1>
					<blockquote>
						<p>At YGN, we continue to set the bar high with industry-leading quality and manufacturing standards.  Since its inception in 2005, we were amongst one of the first companies to develop affordable sports nutrition products for not just athletes, builders but just about everyone. <br />
							Today, YGN is making its way into thousands of youth’s hearts every year. We appreciate your constant support and feedback which helped a lot to grow and set a benchmark. We are changing the concept of active lifestyle by bringing the most affordable yet the most premium quality nutrition products. <br />
							YGN is still family-owned and operated business.  Our commitment and vision remains the same as always to create high quality, highly-researched products that are available at most affordable price to everyone.
						</p>
					</blockquote>
				</div>
				<!-- <div class="col-lg-4 image-content">
					<img class="img-fluid w-50" src="img/category/gainers.png" alt="">
				</div> -->
			</div>
			<div class="row">
				<!-- <div class="col-lg-4 image-content">
					<img class="img-fluid w-50" src="img/category/gainers.png" alt="">
				</div> -->
				<div class="col-lg-12 text-content">
					<h1>Manufacturing & Relentless Quality. </h1>
					<blockquote>
						<p>We are amongst one of the few sports nutrition companies to manufacture its own products.  Our production facilities are located in Delhi, India and is constantly expanding every year.  Every ingredient and raw material is inspected and tested prior to production with our experts.  Each selected ingredient undergoes our thorough review and testing process before delivering it to you. Ensuring you get the best quality at most affordable price. <br />
							All of our products are manufactured and tested by experts in our most trusted facilities across India.
						</p>
					</blockquote>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-content">
					<h1>Our Commitment to nation’s Youth</h1>
					<blockquote>
						<p>Every YGN bottle is packed with only the highest concentrated protein products. Our team of experts come together to develop advanced and effective formulas to help increase muscle gain, stimulate weight loss, boost performance and help you live a better active life style.
							India being country of youth requires a brand for youth not just we feel proud to be called made in India but also
							<strong>Our priority is to stand on your trust, which we have received in past 3 years. That’s why our commitment coincides with our passion to provide you with only the best. And it has been always company’s top objective. We constantly receive your valuable feedbacks and we try to act to improve every day. As a token of appreciation we are giving away 10% additional discounts on your First orders. Have a great time shopping with us.</strong>
						</p>
					</blockquote>
				</div>
				<!-- <div class="col-lg-4 image-content">
					<img class="img-fluid w-50" src="img/category/gainers.png" alt="">
				</div> -->
			</div>
		</div>
		<div class="about-foot-image container-fluid">
			<div class="foot-text-container">
				<div class="text-center">
					<div class="foot-content">
						<h1>SIGN UP FOR EXCLUSIVE OFFERS</h1>
						<p>
							Sign up for our newsletter to receive all the latest news, special offers and other discount information.
						</p>
						<div class="news-footer d-flex justify-content-center" id="mc_embed_signup">
							<form target="_blank" novalidate="true" action="" method="get" class="form-inline">
								<div class="d-flex flex-row">
									<input class="form-control" id="newsletter-email" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email" />
									<button class="click-btn btn btn-default" id="subsBtn" type="button">Subscribe</button>
								</div>
								<strong>
									<p id="msgBox"></p>
								</strong>
								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================About Area =================-->

	<!-- start footer Area -->
	<?php
	include('footer.php');
	?>
	<!-- End footer Area -->
	<script type="text/javascript">
		$(document).ready(() => {
			$('#subsBtn').on("click", () => {
				subscribe();
			});
		});


		function isValidEmailAddress(emailAddress) {
			var pattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
			// var pattern = new RegExp(pattern);
			return emailAddress.match(pattern);
			//return pattern.test(emailAddress);
		}

		function subscribe() {
			var subsEmailBox = $('#newsletter-email');
			var subsEmail = subsEmailBox.val().toLowerCase();
			var subsBtn = $('#subsBtn');

			if (subsEmail) {
				//alert(resetmail);
				if (!isValidEmailAddress(subsEmail)) {
					subsEmailBox.css("border", "2px solid red")
					subsEmailBox.val('');
					subsEmailBox.attr("placeholder", "Please enter valid email");
				} else {
					subsEmailBox.css("border", "2px solid green").focus().blur();
					$.ajax({
						url: 'subscribe.php',
						method: 'POST',
						data: {
							email: subsEmail
						},
						beforeSend: function() {
							subsBtn.html("Subscribing..");
						},
						success: function(response) {
							$('#msgBox').html('</br>' + response);
							setTimeout(function() {
								$('#msgBox').html('');
								subsBtn.html("Subscribe");
								subsEmailBox.val('');
								subsEmailBox.focus().blur();
								subsEmailBox.css("border", "1px solid white");
							}, 3000);
						}
					});
				}
			} else {
				subsEmailBox.css("border", "2px solid red").focus().blur();
			}
		}
	</script>
</body>

</html>