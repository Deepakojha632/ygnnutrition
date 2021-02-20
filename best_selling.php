	<!-- Start related-product Area -->
	<section class="related-product-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>Best Selling Products</h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							magna aliqua.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<?php
				$pids = array(12, 15, 17, 25, 31, 40);
				if (!empty($pids)) {
					$sql = mysqli_query($conn, "SELECT * FROM products WHERE pid IN ('" . implode("','", $pids) . "') ") or die(mysqli_error($conn));
					if (mysqli_num_rows($sql)) {
						while ($row = mysqli_fetch_array($sql)) { ?>
							<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
								<div class="single-related-product d-flex">
									<?php if (isset($row['image2']) && !empty($row['image2'])) { ?>
										<a href="single-product.php?pid=<?php echo $row['pid']; ?>"><img width="100px" height="70px" src="img/Products/<?php echo $row['image2']; ?>" alt=""></a>
									<?php } else { ?>
										<a href="single-product.php?pid=<?php echo $row['pid']; ?>"><img width="100px" height="70px" src="img/Products/OMEGA 3.png" alt="no image"></a>
									<?php } ?>
									<div class="desc">
										<a href="single-product.php?pid=<?php echo $row['pid']; ?>" class="title"><?php echo $row['pname']; ?></a>
										<div class="price">
											<h6><span><i class="fa fa-rupee"></i></span><?php echo ' ' . $row['SRP'] ?></h6>
											<h6 class="l-through"><span><i class="fa fa-rupee"></i></span><?php echo ' ' . $row['MRP'] ?></h6>
										</div>
									</div>
								</div>
							</div>
				<?php }
					}
				} ?>
				<!-- <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
					<div class="single-related-product d-flex">
						<a href="#"><img src="img/r2.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">BCAA</a>
							<div class="price">
								<h6>$189.00</h6>
								<h6 class="l-through">$210.00</h6>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
					<div class="single-related-product d-flex">
						<a href="#"><img src="img/r3.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">BCAA</a>
							<div class="price">
								<h6>$189.00</h6>
								<h6 class="l-through">$210.00</h6>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
					<div class="single-related-product d-flex">
						<a href="#"><img src="img/r5.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">BCAA</a>
							<div class="price">
								<h6>$189.00</h6>
								<h6 class="l-through">$210.00</h6>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
					<div class="single-related-product d-flex">
						<a href="#"><img src="img/r6.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">BCAA</a>
							<div class="price">
								<h6>$189.00</h6>
								<h6 class="l-through">$210.00</h6>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
					<div class="single-related-product d-flex">
						<a href="#"><img src="img/r7.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">BCAA</a>
							<div class="price">
								<h6>$189.00</h6>
								<h6 class="l-through">$210.00</h6>
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</section>
	<!-- End related-product Area -->