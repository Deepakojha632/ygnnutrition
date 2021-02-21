<?php
session_start();
include('connection.php');
$page = basename(__FILE__);

if (isset($_SESSION['uid'])) {
	$userid = $_SESSION['uid'];
}

// if(!empty($_REQUEST['pid'])){
// 	$pid = $_REQUEST['pid'];
// 	echo $pid;

// }
// if(!empty($_SESSION)){

// }


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
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
	<script src="js/jquery3_5_1.min.js"></script>
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
					<h1>Product Details</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home &nbsp;> &nbsp;</a>
						<a href="category.php">Products &nbsp;> &nbsp;</a>
						<a href="<?php if(isset($_REQUEST['pid'])&& !empty($_REQUEST['pid'])) echo 'single-product.php?pid='.$_REQUEST['pid']; else 'echo single-product.php'; ?>">Product Details</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<?php
	if (!empty($_REQUEST['pid']))
		$pid = $_REQUEST['pid'];
	else
		$pid = 1;

	$productDetail = mysqli_query($conn, "SELECT * FROM products where pid='$pid' ") or die(mysqli_error($conn));
	if (mysqli_num_rows($productDetail) > 0) {
		$item = mysqli_fetch_array($productDetail);
		$itemName = $item['pname'];
		$cid = $item['catid'];
		$categoryDetail = mysqli_query($conn, "SELECT catname FROM product_category where catid='$cid' ") or die(mysqli_error($conn));
		$category = mysqli_fetch_array($categoryDetail);
		$flavours = mysqli_query($conn, "SELECT flavour FROM products where pname='$itemName' group by flavour ") or die(mysqli_error($conn));
		$weights = mysqli_query($conn, "SELECT weight,unit FROM products where pname='$itemName' group by weight ") or die(mysqli_error($conn));
		$overallReview = mysqli_query($conn, "select AVG(star) from product_review where pid='$pid'") or die(mysqli_error($conn));

	?>
		<div id="productArea" class="product_image_area">
			<div class="container">
				<div class="row s_product_inner">
					<div class="col-lg-6">
						<div class="s_Product_carousel">
							<div class="single-prd-item">
								<?php if (!empty($item['image1'])) { ?>
									<img class="img-fluid" src="img/Products/<?php echo $item['image1']; ?>" alt="<?php echo $item['image1']; ?>">
								<?php } ?>
							</div>
							<div class="single-prd-item">
								<?php if (!empty($item['image2'])) { ?>
									<img class="img-fluid" src="img/Products/<?php echo $item['image2']; ?>" alt="<?php echo $item['image2']; ?>">
								<?php } ?>
							</div>
							<div class="single-prd-item">
								<?php if (!empty($item['image3'])) { ?>
									<img class="img-fluid" src="img/Products/<?php echo $item['image3']; ?>" alt="<?php echo $item['image3']; ?>">
								<?php } ?>
							</div>
							<div class="single-prd-item">
								<?php if (!empty($item['image4'])) { ?>
									<img class="img-fluid" src="img/Products/<?php echo $item['image4']; ?>" alt="<?php echo $item['image4']; ?>">
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="col-lg-5 offset-lg-1">
						<div class="s_product_text">
							<h3 id="pname"><?php echo $item['pname']; ?></h3>
							<div class="review_box">
								<ul class="list">
									<?php
									if (mysqli_num_rows($overallReview)) {
										$overall = mysqli_fetch_array($overallReview);
										if (!empty($overall[0])) {
											$rating = ceil($overall[0]);
											for ($i = 1; $i <= $rating; $i++) { ?>
												<li><i class="fa fa-star"></i></li>
											<?php } ?>
											<li>
												<h6><?php echo $rating; ?></h6>
											</li>
										<?php } else { ?>
											<li><?php echo 'Not Rated Yet'; ?></li>
									<?php }
									} ?>
								</ul>
							</div>
							<span class="vegnonveg">
								<div class="vegnonveg--icon veg">
									<div class="dot"></div>
								</div>
								<h6><?php
										if ($item['flavour'] != 'NA') {
											echo $item['weight'] . ' ' . $item['unit'] . ' ' . ucfirst($item['flavour']) . ' Flavour';
										} else {
											echo $item['weight'] . ' ' . $item['unit'];
										} ?>
								</h6>
							</span>
							<span class="off-per"><i class="fa fa-tags"></i>
								<h6><?php $discount = (($item['MRP'] - $item['SRP']) / $item['MRP']) * 100;
										echo intval($discount); ?>% Off</h6>
							</span>
							<h2><span><i class="fa fa-rupee"></i></span><?php echo ' ' . $item['SRP']; ?></h2>
							<h4 class="l-through"><span><i class="fa fa-rupee"></i></span><?php echo ' ' . $item['MRP']; ?></h4>
							<ul class="list">
								<li>
									<div class="product_stat"><span>Category</span> : <a class="category_product" href=""><?php echo ' ' . $category['catname']; ?></a></div>
								</li>
								<?php if ($item['quantity'] > 0) { ?>
									<li>
										<div class="active product_stat"><span>Availibility</span> : In Stock</div>
									</li>
								<?php } else { ?>
									<li>
										<div class="active product_stat"><span>Availibility</span> : Out of Stock</div>
									</li>
								<?php } ?>
							</ul>
							<p>Mill Oil is an innovative oil filled radiator with the most modern technology. If you are looking for
								something that can make your interior look awesome, and at the same time give you the pleasant warm feeling
								during the winter.</p>
							<div class="product_type">
								<div class="nice-select" tabindex="0">
									<span id="currentFlavour" class="current"><?php echo $item['flavour']; ?></span>
									<ul id="flavour" class="list">
										<?php
										if (mysqli_num_rows($flavours) > 0)
											while ($flavour = mysqli_fetch_array($flavours)) { ?>
											<li data-value=" 1" class="option"><?php echo $flavour['flavour']; ?></li>
										<?php 	} ?>
									</ul>
								</div>
								<div class="nice-select" tabindex="0">
									<span id="currentWeight" class="current"><?php echo $item['weight'] . ' ' . $item['unit'] ?></span>
									<ul id="weight" class="list">
										<?php
										if (mysqli_num_rows($weights) > 0)
											while ($weight = mysqli_fetch_array($weights)) { ?>
											<li data-value=" 1" class="option"><?php echo $weight['weight'] . ' ' . $weight['unit']; ?></li>
										<?php 	} ?>
									</ul>
								</div>
							</div>
							<div class="product_count">
								<label for="qty">Quantity:</label>
								<input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
								<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
								<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
							</div>
							<div class="card_area d-flex align-items-center">
								<a id="addtocart" class="primary-btn">Add to Cart</a>
								<a id="wishlist" id="<?php echo $item['pid'];?>" class="icon_btn"><i class="fa fa-heart"></i></a>
							</div></br>
							<div id="share" class="card_area d-flex align-items-center">
								<a id="whatsapp" class="icon_btn"><i class="fa fa-whatsapp"></i></a>
								<a id="facebook" class="icon_btn"><i class="fa fa-facebook"></i></a>
								<a id="twitter" class="icon_btn"><i class="fa fa-twitter"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<!--================End Single Product Area =================-->

	<script type="text/javascript">
		$(document).ready(function() {
			var rateGiven = 0;
			var pid = "<?php echo $pid; ?>";

			$("body").on("click", "#addtocart", function() {
				quantity = $("#sst").val().trim();
				//quantity = parseInt(quantity);
				// alert(pid);
				// alert(quantity);

				<?php if (isset($userid)) { ?>
					$.ajax({
						url: 'updateCart.php',
						method: 'POST',
						data: {
							pid: pid,
							quantity: quantity
						},
						success: function(response) {
							//alert(response);
							updateCartCounter();
						}
					});
				<?php } else {
					$_SESSION['pagename'] = basename(__FILE__); ?>
					window.location.href = "login.php";
				<?php } ?>
			});

			$("#wishlist").on('click',function(){
				//alert(pid);
				<?php if (isset($userid)) { ?>
					uid = <?php echo $userid; ?>;
					$.ajax({
						url: 'updateWishlist.php',
						method: 'POST',
						data: {
						pid: pid,
						uid: uid
						},
						success: function(response) {
						//console.log(response);
							$('#msg').show();
							$('#msg').html(response);
							setTimeout(() => {
								$('#msg').hide();
							}, 3000);
						}
					});
					<?php } else {
					$_SESSION['pagename'] = basename(__FILE__); ?>
					window.location.href = "login.php";
				<?php } ?>
			});

			$('a[name="prod"]').on("click", () => {
				//alert(pid);
				<?php if (isset($userid)) { ?>
					uid = <?php echo $userid; ?>;
					$.ajax({
						url: 'updateWishlist.php',
						method: 'POST',
						data: {
							pid: pid,
							uid: uid
						},
						success: function(response) {
							console.log(response);
						}
					});
				<?php } else {
					$_SESSION['pagename'] = basename(__FILE__); ?>
					window.location.href = "login.php";
				<?php } ?>
			});

			$("body").on("click", "#flavour li", function() {
				name = "<?php echo $item['pname']; ?>";
				flavour = $(this).text().trim();
				weight = $("#currentWeight").text().trim().split(' ');
				//alert(weight[0]);
				$.ajax({
					url: 'productDetail.php',
					method: 'POST',
					data: {
						name: name,
						weight: weight[0],
						flavour: flavour
					},
					success: function(response) {
						pid = response;
						url = "single-product.php?pid=" + pid;
						window.location.href = url;
						// alert(pid);
						// console.log(response);
					}
				});
			});

			$("body").on("click", "#weight li", function() {
				name = "<?php echo $item['pname']; ?>";
				weight = $(this).text().trim().split(' ');
				flavour = $("#currentFlavour").text().trim();
				$.ajax({
					url: 'productDetail.php',
					method: 'POST',
					data: {
						name: name,
						weight: weight[0],
						flavour: flavour
					},
					success: function(response) {
						pid = response;
						url = "single-product.php?pid=" + pid;
						window.location.href = url;
						//alert(pid);
						//console.log(response);
					}
				});
			});

			$("body").on("click", "#ratingStars input", function() {
				rateGiven = $(this).attr("data-index");
				//alert(rateGiven);
			});

			$("body").on("click", "#addReview", function() {
				<?php
				if (isset($userid)) { ?>
					uid = "<?php echo $userid; ?>"
					pid = "<?php echo $pid; ?>";
					comment = $("#ratingComment").val();
					if (rateGiven > 0) {
						//alert(uid+' '+pid+' '+rateGiven+' '+comment);
						$.ajax({
							url: 'addProductReview.php',
							method: 'POST',
							data: {
								uid: uid,
								pid: pid,
								star: rateGiven,
								message: comment
							},
							success: function(response) {
								//console.log(response);
								//pid = response;
								url = "single-product.php?pid=" + pid;
								window.location.href = url;
								//alert(pid);
								//console.log(response);
							}
						});

					} else {
						alert('Please select star');
					}

				<?php } else {
					$_SESSION['pagename'] = basename(__FILE__);
					$_SESSION['pagename'] = $_SESSION['pagename'] .= "?pid=" . $pid;  ?>
					window.location.href = "login.php";
				<?php } ?>
			});

			$('#share a').on('click',function(){
				var social = $(this).attr('id');
				socialsharingbuttons(social);
			});

			function updateCartCounter() {
				//alert('updating counter');
				$.ajax({
					url: 'updateCartCounter.php',
					method: 'POST',
					data: {},
					success: function(response) {
						// $("#products").html(response); 
						$("#itemCounter").html(response);
						console.log(response);
						//itemCounter
					}
				});
			}

			//share
			function socialsharingbuttons(social){
				var url="single-product.php?pid="+pid;
				console.log(url);
				// var params = JSON.parse(params);
				switch (social) {
				case 'facebook':
					window.location.href='https://www.facebook.com/share.php?u='+url;
					break;
				case 'twitter':
					window.location.href='https://twitter.com/share?url='+url;
					break;
				case 'whatsapp':
					if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
						window.location.href='whatsapp://send?text='+url;
					}else{
						window.location.href='https://web.whatsapp.com/send?text='+url;
					}
					break;
				default:
					break;
				}
			}
		});
	</script>

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specification</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<p>Beryl Cook is one of Britain’s most talented and amusing artists .Beryl’s pictures feature women of all shapes
						and sizes enjoying themselves .Born between the two world wars, Beryl Cook eventually left Kendrick School in
						Reading at the age of 15, where she went to secretarial school and then into an insurance office. After moving to
						London and then Hampton, she eventually married her next door neighbour from Reading, John Cook. He was an
						officer in the Merchant Navy and after he left the sea in 1956, they bought a pub for a year before John took a
						job in Southern Rhodesia with a motor company. Beryl bought their young son a box of watercolours, and when
						showing him how to use it, she decided that she herself quite enjoyed painting. John subsequently bought her a
						child’s painting set for her birthday and it was with this that she produced her first significant work, a
						half-length portrait of a dark-skinned lady with a vacant expression and large drooping breasts. It was aptly
						named ‘Hangover’ by Beryl’s husband and</p>
					<p>It is often frustrating to attempt to plan meals that are designed for one. Despite this fact, we are seeing
						more and more recipe books and Internet websites that are dedicated to the act of cooking for one. Divorce and
						the death of spouses or grown children leaving for college are all reasons that someone accustomed to cooking for
						more than one would suddenly need to learn how to adjust all the cooking practices utilized before into a
						streamlined plan of cooking that is more efficient for one person creating less</p>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td>
										<h5>Width</h5>
									</td>
									<td>
										<h5>128mm</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Height</h5>
									</td>
									<td>
										<h5>508mm</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Depth</h5>
									</td>
									<td>
										<h5>85mm</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Weight</h5>
									</td>
									<td>
										<h5>52gm</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Quality checking</h5>
									</td>
									<td>
										<h5>yes</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Freshness Duration</h5>
									</td>
									<td>
										<h5>03days</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>When packeting</h5>
									</td>
									<td>
										<h5>Without touch of hand</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Each Box contains</h5>
									</td>
									<td>
										<h5>60pcs</h5>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<?php

				$getReviews = mysqli_query($conn, "select * from product_review where pid='$pid'") or die(mysqli_error($conn));
				$overallReview = mysqli_query($conn, "select AVG(star) as overall from product_review where pid='$pid'") or die(mysqli_error($conn));
				$overall = mysqli_fetch_array($overallReview);

				$oneStar = mysqli_query($conn, "select * from product_review where pid='$pid' and star='1'") or die(mysqli_error($conn));
				$twoStar = mysqli_query($conn, "select * from product_review where pid='$pid' and star='2'") or die(mysqli_error($conn));
				$threeStar = mysqli_query($conn, "select * from product_review where pid='$pid' and star='3'") or die(mysqli_error($conn));
				$fourStar = mysqli_query($conn, "select * from product_review where pid='$pid' and star='4'") or die(mysqli_error($conn));
				$fiveStar = mysqli_query($conn, "select * from product_review where pid='$pid' and star='5'") or die(mysqli_error($conn));
				?>
				<div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
					<div class="row">
						<div class="col-lg-6">
							<div class="row total_rate">
								<div class="col-6">
									<div class="box_total">
										<h5>Overall</h5>
										<h4><?php echo number_format($overall['overall'], 1, '.', ''); ?></h4>
										<h6>(<?php echo mysqli_num_rows($getReviews) ?> Reviews)</h6>
									</div>
								</div>
								<div class="col-6">
									<div class="rating_list">
										<h3>Based on <?php echo mysqli_num_rows($getReviews) ?> Reviews</h3>
										<ul class="list">
											<li><a href="#">5 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><span><?php echo mysqli_num_rows($fiveStar) ?></span></a></li>
											<li><a href="#">4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star blank-star"></i><span><?php echo mysqli_num_rows($fourStar) ?></span></a></li>
											<li><a href="#">3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star blank-star"></i><i class="fa fa-star blank-star"></i><span><?php echo mysqli_num_rows($threeStar) ?></span></a></li>
											<li><a href="#">2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star blank-star"></i><i class="fa fa-star blank-star"></i><i class="fa fa-star blank-star"></i><span><?php echo mysqli_num_rows($twoStar) ?></span></a></li>
											<li><a href="#">1 Star <i class="fa fa-star"></i><i class="fa fa-star blank-star"></i><i class="fa fa-star blank-star"></i><i class="fa fa-star blank-star"></i><i class="fa fa-star blank-star"></i><span><?php echo mysqli_num_rows($oneStar) ?></span></a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="review_list">
								<?php
								while ($reviews = mysqli_fetch_array($getReviews)) {
									$uid = $reviews['userid'];
									$star = $reviews['star'];
									$userQuery = mysqli_query($conn, "select uname from user where uid='$uid'") or die(mysqli_error($conn));
									$username = mysqli_fetch_array($userQuery);
								?>
									<div class="review_item">
										<div class="media">
											<div class="d-flex">
												<img src="https://picsum.photos/id/<?php if ($uid < "1000") {
																							echo $uid;
																						} else {
																							echo $uid - 999;
																						} ?>/70/?blur" alt="">
											</div>
											<div class="media-body">
												<h4><?php echo $username['uname'] ?></h4>
												<?php for ($i = 1; $i <= $star; $i++) { ?>
													<i class="fa fa-star"></i>
												<?php } ?>
											</div>
										</div>
										<p><?php echo $reviews['comment'] ?></p>
									</div>
								<?php } ?>
								<!-- <div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/review-2.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
										commodo</p>
								</div> -->
								<!-- <div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/review-3.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
										commodo</p>
								</div> -->
							</div>
						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Add a Review</h4>
								<p>Your Rating:</p>
								<div class="star-rating">
									<div id="ratingStars" class="rating">
										<input id="star5" type="radio" data-index="5" name="star" value="5">
										<label for="star5" title="5 out of 5 stars"></label>
										<input id="star4" type="radio" data-index="4" name="star" value="4">
										<label for="star4" title="4 out of 5 stars"></label>
										<input id="star3" type="radio" data-index="3" name="star" value="3">
										<label for="star3" title="3 out of 5 stars"></label>
										<input id="star2" type="radio" data-index="2" name="star" value="2">
										<label for="star2" title="2 out of 5 stars"></label>
										<input id="star1" type="radio" data-index="1" name="star" value="1">
										<label for="star1" title="1 out of 5 stars"></label>
									</div>
								</div>

								<!-- <ul id="ratingStars" class="list">
									<li data-index="1"><a><i class="fa fa-star"></i></a></li>
									<li data-index="2"><a><i class="fa fa-star"></i></a></li>
									<li data-index="3"><a><i class="fa fa-star"></i></a></li>
									<li data-index="4"><a><i class="fa fa-star"></i></a></li>
									<li data-index="5"><a><i class="fa fa-star"></i></a></li>
								</ul> -->
								<div class="row contact_form" method="post" id="contactForm" novalidate="novalidate">
									<div class="col-md-12">
										<div class="form-group">
											<textarea id="ratingComment" class="form-control" name="message" id="message" rows="1" placeholder="Review" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Review'"></textarea>
										</div>
									</div>
									<div class="col-md-12 text-right">
										<button id="addReview" value="submit" class="primary-btn">Submit Now</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->


	<!-- Start bestselling-product Area -->
	<?php include('best_selling.php'); ?>
	<!-- End bestselling-product Area -->

	<!-- start footer Area -->
	<?php include('footer.php'); ?>
	<!-- End footer Area -->

	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="js/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
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