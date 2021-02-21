<?php
	session_start();
	use PHPMailer\PHPMailer\PHPMailer;
	require 'vendor/autoload.php';
    include('connection.php');
	$page = basename(__FILE__);
	//$_SESSION['pagename'] = $page;

	$failed;
	//print_r($_POST);
	if(isset($_POST["status"]) && isset($_POST["firstname"]) && isset($_POST["amount"]) && isset($_POST["txnid"]) && isset($_POST["hash"]) && isset($_POST["key"]) && isset($_POST["productinfo"]) && isset($_POST["email"]) && !empty($_POST["status"]) && !empty($_POST["firstname"]) && !empty($_POST["amount"]) && !empty($_POST["txnid"]) && !empty($_POST["hash"]) && !empty($_POST["key"]) && !empty($_POST["productinfo"]) && !empty($_POST["email"])){
		$status=$_POST["status"];
		$firstname=$_POST["firstname"];
		$amount=$_POST["amount"];
		$txnid=$_POST["txnid"];
		$posted_hash=$_POST["hash"];
		$key=$_POST["key"];
		$productinfo=$_POST["productinfo"];
		$email=$_POST["email"];
		$salt="7shOTuAMmc";

		$user = mysqli_query($conn,"select * from transactions where transaction_id='$txnid'") or die($conn);
		if(mysqli_num_rows($user)){
			//$removeTxns = mysqli_query($conn,"delete from transactions where transaction_id='$txnid'") or die($conn);
			$user = unserialize(mysqli_fetch_array($user)['checkout_info']);
			$_SESSION['uid'] = $user['uid'];
			$uid = $user['uid'];
			$loggedUserInfo = mysqli_query($conn,"select * from user where uid='$uid'") or die(mysqli_error($conn));
			if(mysqli_num_rows($loggedUserInfo)){
				$loggedUser = mysqli_fetch_array($loggedUserInfo);
				$_SESSION['name'] = $loggedUser['uname'];
			}


			if (isset($_POST["additionalCharges"])) {
				$additionalCharges=$_POST["additionalCharges"];
				$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
			} else {
				$retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
			}
				
			$hash = hash("sha512", $retHashSeq);
			
			if($hash != $posted_hash) {
				echo "Invalid Transaction. Please try again";
			}else {
				//print_r($_POST);

				$paymentInfo = array(
					'status' => $status,
					'firstname' => $firstname,
					'email' => $email, 
					'txnid' => $txnid,
					'mode' => !empty($_POST['mode']) ? $_POST['mode'] : '',
					'phone' => $_POST['phone'],
					'message' => !empty($_POST['unmappedstatus']) ? $_POST['unmappedstatus'] : '',
					'bank_ref_num' => !empty($_POST['bank_ref_num']) ? $_POST['bank_ref_num'] : '',
					'payumoneyid' => !empty($_POST['payuMoneyId']) ? $_POST['payuMoneyId'] : '',
					'productinfo' => $productinfo,
					'amount' => !empty($_POST['amount']) ? $_POST['amount'] : '',
					'datetime' => !empty($_POST['addedon']) ? $_POST['addedon'] : '',
				);

				//print_r($paymentInfo);

				if($status=='success'){
					$orderid = $user['orderid'];

					$userInfo = array(
						'first' => ucfirst($user['first']),
						'last' => ucfirst($user['last']),
						'phone' => $user['phone'],
						'email' => $user['email'],
						'street' => $user['street'],
						'country' => $user['country'],
						'city' => $user['city'],
						'state' => $user['state'],
						'pincode' => $user['pincode'],
					);

					$couponInfo = $user['coupon'];
					$productInfo = $user['cartitems'];

					// echo '</br></br></br></br></br></br></br></br></br>';
					// print_r($userInfo);
					// echo '</br>';
					// print_r($couponInfo);
					// echo '</br>';
					// print_r($productInfo);


					$isPresent = mysqli_query($conn,"select * from orders where orderid='$orderid'") or die(mysqli_error($conn));
					if(mysqli_num_rows($isPresent)){
						$data = array(
							'error' => 'no',
							'msg' => "Your order has been received and payment detail has been sent to your mail. 
							<br>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped."
						);
					
					}else{
						$pi = serialize($productInfo);
						$ti = serialize($paymentInfo);
						$ui = serialize($userInfo);
						$ci = serialize($couponInfo);
						$placeOrder = mysqli_query($conn,"insert into orders(orderid,uid,items,transactioninfo,userinfo,couponinfo) values('$orderid','$uid','$pi','$ti','$ui','$ci')") or die(mysqli_error($conn));
						if(mysqli_affected_rows($conn)){
							
							$clearCart = mysqli_query($conn,"delete from cart where user_id='$uid'") or die(mysqli_error($conn));
							
							$mail = new PHPMailer(true);

							//$mail->SMTPDebug = 4;  
							$subject = ucfirst($firstname)." Your order has been placed.";
							$message = "
								Hi,<br>
								".ucfirst($firstname).",<br>
								Your order has been placed successfully. Below is your payment information.
								<table>
								<thead><td><h4>Payment detail</h4></td></thead>
								<tr><td><h5>Status</h5></td>:<td>".$paymentInfo['status']."</td></tr>
								<tr><td><h5>Amount</h5></td>:<td>".$paymentInfo['amount']."</td></tr>
								<tr><td><h5>Transaction Id</h5></td>:<td>".$paymentInfo['txnid']."</td></tr>
								<tr><td><h5>Reference number</h5></td>:<td>".$paymentInfo['bank_ref_num']."</td></tr>
								<tr><td><h5>Payment mode</h5></td>:<td>".$paymentInfo['mode']."</td></tr>
								<tr><td><h5>Date</h5></td>:<td>".$paymentInfo['datetime']."</td></tr>
								</table>
								<br>
								Kind Regards,<br>
								YQN ";

							try {
								//Server settings
								$mail->isSMTP();                                      	// Set mailer to use SMTP
								$mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
								$mail->SMTPAuth = true;                               	// Enable SMTP authentication
								$mail->Username = 'pratitsingh1996@gmail.com';              // SMTP username
								$mail->Password = 'Min00EEPAK';                 // SMTP password
								$mail->SMTPSecure = 'ssl';                            	// Enable TLS encryption, `ssl` also accepted
								$mail->Port = 465;                                    	// TCP port to connect to

								//Recipients
								$mail->setFrom('pratitsingh1996@gmail.com', 'YGN');
								$mail->addAddress($email);     							// Add a recipient ,Name is optional
									
								// Content
								$mail->isHTML(true);                                  	// Set email format to HTML
								$mail->Subject = $subject;
								$mail->Body    = $message;

								$mail->send();
								$data = array(
									'error' => 'no',
									'msg' => "Your order has been received and payment detail has been sent to your mail. 
									<br>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped."
								);
							} catch (Exception $e) {
								echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
							}


							$productDetail='';
							foreach($productInfo as $product){
								$productDetail = $productDetail.=$product['name'].' '.$product['detail'].'  : '.$product['quantity'].'<br>';
							}
							$productDetail;

							// sending mail to admin
							$adminMail = new PHPMailer(true);

							//$mail->SMTPDebug = 4;  
							$subject = "New Order received.";
							$message = "
								Hi,<br>
								New order has been received. Below is the order information information.
								<table>
								<thead><td><h4>Payment detail</h4></td></thead>
								<tr><td><h5>Status</h5></td>:<td>".$paymentInfo['status']."</td></tr>
								<tr><td><h5>Amount</h5></td>:<td>".$paymentInfo['amount']."</td></tr>
								<tr><td><h5>Transaction Id</h5></td>:<td>".$paymentInfo['txnid']."</td></tr>
								<tr><td><h5>Order Id</h5></td>:<td>".$orderid."</td></tr>
								<tr><td><h5>Reference number</h5></td>:<td>".$paymentInfo['bank_ref_num']."</td></tr>
								<tr><td><h5>Payment mode</h5></td>:<td>".$paymentInfo['mode']."</td></tr>
								<tr><td><h5>Date</h5></td>:<td>".$paymentInfo['datetime']."</td></tr>
								</table>
								<br>
								<b>Ordered Prodects</b>
								<p>".$productDetail."</p>
								<br>
								<b>Customer shipping address</b>
								 First name :".$userInfo['first']."<br>
								 Last name :".$userInfo['last']."<br>
								 Phone :".$userInfo['phone']."<br>
								 Email :".$userInfo['email']."<br>
								 Street :".$userInfo['street']."<br> 
								 City :".$userInfo['city']."<br>
								 State :".$userInfo['state']."<br> 
								 Country :".$userInfo['country']."<br>
								 Pincode :".$userInfo['pincode']."<br>
								 <br>
								<br>
								Kind Regards,<br>
								YQN ";

							try {
								//Server settings
								$adminMail->isSMTP();                                      	// Set mailer to use SMTP
								$adminMail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
								$adminMail->SMTPAuth = true;                               	// Enable SMTP authentication
								$adminMail->Username = 'pratitsingh1996@gmail.com';              // SMTP username
								$adminMail->Password = 'Min00EEPAK';                 // SMTP password
								$adminMail->SMTPSecure = 'ssl';                            	// Enable TLS encryption, `ssl` also accepted
								$adminMail->Port = 465;                                    	// TCP port to connect to

								//Recipients
								$adminMail->setFrom('pratitsingh1996@gmail.com', 'YGN');
								$adminMail->addAddress('pratitsingh1996@gmail.com');     							// Add a recipient ,Name is optional
									
								// Content
								$adminMail->isHTML(true);                                  	// Set email format to HTML
								$adminMail->Subject = $subject;
								$adminMail->Body    = $message;

								$adminMail->send();

							} catch (Exception $e) {
								echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
							}

						}else
							echo 'Order not placed';
					}
				}
			}
		}else{
			header('location:logout.php');
		}
	}else{
		header('location:checkout.php');
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
	<script src="js/jquery3_5_1.min.js"></script>

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
</head>

<body>

	<!-- Start Header Area -->
	<?php
		include('header.php');
	?>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center">
				<div class="col-first">
					<h1>Confirmation</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home > &nbsp;</a>
						<a href="confirmation.php">Confirmation</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Order Details Area =================-->
	<section class="order_details section_gap">
		<div class="container">
			<h3 class="title_confirmation">
			<?php 
				if($status=='success'){?>
					Thank you. <?php echo isset($data) ? $data['msg']:''?>
				<?php }else {?>
					Oops, your order has not been received due to payment failure.
			<?php }?>
			</h3>
			<?php if($status=='success'){?>
				<div class="row order_d_inner">
					<div class="col-lg-4">
						<div class="details_item">
							<h4>Payment Detail</h4>
							<ul class="list">
								<li><a><span>Payment status</span> : <?php echo $paymentInfo['status'];?></a></li>
								<li><a><span>Transaction Id</span> : <?php echo isset($paymentInfo) ? $paymentInfo['txnid']:''?></a></li>
								<li><a><span>Name</span> : <?php echo isset($paymentInfo) ? $paymentInfo['firstname']:''?></a></li>
								<li><a><span>Email</span> : <?php echo isset($paymentInfo) ? $paymentInfo['email']:''?></a></li>
								<li><a><span>Phone no</span> : <?php echo isset($paymentInfo) ? $paymentInfo['phone']:''?></a></li>
								<li><a><span>Order number</span> : <?php echo isset($orderid) ? $orderid:''?></a></li>
								<li><a><span>Payment Date</span> : <?php echo isset($paymentInfo) ? $paymentInfo['datetime']:''?></a></li>
								<li><a><span>Payment method</span> : <?php echo isset($paymentInfo) ? $paymentInfo['mode']:''?></a></li>
								<li><a><span>Amount Paid</span> : <?php echo isset($paymentInfo) ? 'Rs. '.$paymentInfo['amount']:''?></a></li>								
							</ul>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="details_item">
							<h4>Shipping Address</h4>
							<ul class="list">
								<li><a><span>Street</span> : <?php echo isset($userInfo) ? $userInfo['street']:''?></a></li>
								<li><a><span>City</span> : <?php echo isset($userInfo) ? $userInfo['city']:''?></a></li>
								<li><a><span>Country</span> : <?php echo isset($userInfo) ? $userInfo['country']:''?></a></li>
								<li><a><span>Postcode </span> : <?php echo isset($userInfo) ? $userInfo['pincode']:''?></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="order_details_table">
					<h2>Order Detail</h2>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">Product</th>
									<th scope="col">Quantity</th>
									<th scope="col">Total</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								if(isset($productInfo)){
									$subtotal = 0;
									$total = $amount;
									//print_r(gettype($couponInfo));
									$coupon = !empty($couponInfo) ? $couponInfo['value'] : '';
									//echo gettype($coupon);

									foreach($productInfo as $product){
										// print_r($products);
										$subtotal = $subtotal + $product['total_price'];
										?>
										<tr>
											<td>
												<p><?php echo $product['name'].' '.$product['detail']; ?></p>
											</td>
											<td>
												<h5>x <?php echo $product['quantity'];?></h5>
											</td>
											<td>
												<p><?php echo number_format($product['total_price'],2);?></p>
											</td>
										</tr>
									<?php } ?>
									<tr>
									<td>
										<h4>Subtotal</h4>
									</td>
									<td>
										<h5></h5>
									</td>
									<td>
										<p><?php echo 'Rs. '.number_format($subtotal,2);?></p>
									</td>
								</tr>

								<?php if(!empty($coupon)){
									$couponValue = (($coupon/100)*$subtotal); ?>
									<tr>
										<td>
											<h4>Coupon</h4>
										</td>
										<td>
											<h5></h5>
										</td>
										<td>
											<p> - <?php echo number_format($couponValue,2); ?></p>
										</td>
									</tr>
								<?php } ?>

								<tr>
									<td>
										<h4>Shipping</h4>
									</td>
									<td>
										<h5></h5>
									</td>
									<td>
									<?php if(!empty($coupon)){
										//echo 'not empty';
										$couponValue = (($coupon/100)*$subtotal);
										$shippingCharge = $total - ($subtotal-$couponValue); ?>
										<p> + <?php echo number_format($shippingCharge,2);?></p>
									<?php }else{ 
										$shippingCharge = $total - $subtotal; ?>
										<p> + <?php echo number_format($shippingCharge,2);?></p>
									<?php } ?>
									</td>
								</tr>
								<tr>
									<td>
										<h4>Total</h4>
									</td>
									<td>
										<h5></h5>
									</td>
									<td>
										<p><?php echo 'Rs. '.number_format($total,2);?></p>
									</td>
								</tr>
							<?php } ?>							
							</tbody>
						</table>
					</div>
				</div>
			<?php }else if('failure'){
					echo 'Status  :'.$status.'</br>';
					echo 'Name  :'.$firstname.'</br>';
					echo 'Amount  :'.$amount.'</br>';
					echo 'Transaction id  :'.$txnid.'</br>';
					echo 'Email  :'.$email.'</br>';
					echo 'Phone  :'.$paymentInfo['phone'].'</br>';
					echo 'transaction date  :'.$paymentInfo['datetime'].'</br>';
				} ?>
		</div>
	</section>
	<!--================End Order Details Area =================-->

	<!-- start footer Area -->
	<?php
	include('footer.php');
	?>
	<!-- End footer Area -->

</body>

</html>