<?php
session_start();
include('connection.php');
$page = basename(__FILE__);

if (isset($_SESSION['uid'])) {
  $userid = $_SESSION['uid'];
  $username = $_SESSION['name'];
  //echo "<script> alert(new Date()); </script>";
}

?>


<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/fav.png" />
  <!-- Author Meta -->
  <meta name="author" content="CodePixar" />
  <!-- Meta Description -->
  <meta name="description" content="" />
  <!-- Meta Keyword -->
  <meta name="keywords" content="" />
  <!-- meta character set -->
  <meta charset="UTF-8" />
  <!-- Site Title -->
  <title>YGN</title>
  <!--
		CSS
		============================================= -->
  <link rel="stylesheet" href="css/linearicons.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/themify-icons.css" />
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/owl.carousel.css" />
  <link rel="stylesheet" href="css/nice-select.css" />
  <link rel="stylesheet" href="css/nouislider.min.css" />
  <link rel="stylesheet" href="css/ion.rangeSlider.css" />
  <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
  <link rel="stylesheet" href="css/magnific-popup.css" />
  <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>

<body>
  <?php include 'header.php'; ?>
  <!-- End Header Area -->

  <!-- start banner Area -->
  <section class="banner-area">
    <!-- <div class="bg-sheet"></div> -->
    <div class="container">
      <div class="row fullscreen align-items-center justify-content-start">
        <div class="col-lg-12">
          <div class="active-banner-slider owl-carousel">
            <!-- single-slide -->
            <div class="single-slide slide_one align-items-center d-flex">
            
              <div class="col-lg-5 col-md-6">
                <div class="banner-content">
                  <!-- <h1>Your favourite products, <br />now at unbeatable <br /> price</h1>
                  <p>
                    before you sweat, grab a bite of our protein bar with
                    highest grade protein, to fuel your passion.
                  </p> -->
                  <div class="add-bag d-flex align-items-center">
                    <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                    <span class="add-text text-uppercase">Add to Bag</span>
                  </div>
                </div>
              </div>
              <!-- <div class="banner-img">
                <img class="img-fluid" src="./img/banner/ssasa 3.jpg" alt="MG C 5LBS.jpg" />
              </div> -->
            </div>
            <!-- single-slide -->
            <div class="single-slide slide_two align-items-center d-flex">
              <div class="col-lg-5">
                
                <div class="banner-content">
                  <!-- <h1>AFTER YOU <br />BUILD</h1>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt.
                  </p> -->
                  <div class="add-bag d-flex align-items-center">
                    <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                    <span class="add-text text-uppercase">Add to Bag</span>
                  </div>
                </div>
              </div>
              <!-- <div class="col-lg-7">
                <div class="banner-img">
                  <img class="img-fluid" src="img/Products/MG C 5LBS.jpg" alt="MG C 5LBS.jpg" />
                </div>
              </div> -->
            </div>
            <div class="single-slide slide_three align-items-center d-flex">
              <div class="col-lg-5">
                <div class="banner-content">
                  <!-- <h1>AFTER YOU <br />BUILD</h1>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt.
                  </p> -->
                  <div class="add-bag d-flex align-items-center">
                    <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                    <span class="add-text text-uppercase">Add to Bag</span>
                  </div>
                </div>
              </div>
              <!-- <div class="col-lg-7">
                <div class="banner-img">
                  <img class="img-fluid" src="img/Products/MG C 5LBS.jpg" alt="MG C 5LBS.jpg" />
                </div>
              </div> -->
            </div>
            <div class="single-slide slide_four align-items-center d-flex">
              <div class="col-lg-5">
                <div class="banner-content">
                  <!-- <h1>AFTER YOU <br />BUILD</h1>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt.
                  </p> -->
                  <div class="add-bag d-flex align-items-center">
                    <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                    <span class="add-text text-uppercase">Add to Bag</span>
                  </div>
                </div>
              </div>
              <!-- <div class="col-lg-7">
                <div class="banner-img">
                  <img class="img-fluid" src="img/Products/MG C 5LBS.jpg" alt="MG C 5LBS.jpg" />
                </div>
              </div> -->
            </div>
            <div class="single-slide slide_five align-items-center d-flex">
              <div class="col-lg-5">
                <div class="banner-content">
                  <!-- <h1>AFTER YOU <br />BUILD</h1>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt.
                  </p> -->
                  <div class="add-bag d-flex align-items-center">
                    <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                    <span class="add-text text-uppercase">Add to Bag</span>
                  </div>
                </div>
              </div>
              <!-- <div class="col-lg-7">
                <div class="banner-img">
                  <img class="img-fluid" src="img/Products/MG C 5LBS.jpg" alt="MG C 5LBS.jpg" />
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End banner Area -->

  <!-- start product Area -->
  <section class="owl-carousel active-product-area section_gap">
    <!-- single product slide -->
    <div class="single-product-slider">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <div class="section-title">
              <h1>Latest Products</h1>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <?php
          $latestProdQuery = mysqli_query($conn, "SELECT * FROM products GROUP BY pname order by date desc limit 8") or die(mysqli_error($conn));
          while ($product = mysqli_fetch_array($latestProdQuery)) {
            $prodid = $product['pid']; ?>
            <!-- single product -->
            <div class="col-lg-3 col-md-6">
              <div class="front-single-product">
                <a href="single-product.php?pid=<?php echo $product['pid']; ?>" class="s_product_link">
                  <?php if (!empty($product['image1'])) { ?>
                    <img class="img-fluid" src="img/Products/<?php echo $product['image1']; ?>" alt="<?php echo $product['image1']; ?>" />
                  <?php } else { ?>
                    <img class="img-fluid" src="img/Products/OMEGA-3.jpg" alt="<?php echo 'No Image'; ?>" />
                  <?php } ?>
                  <div class="product-details">
                    <div class="review_box">
                      <ul class="list">
                        <?php
                        $overallReview = mysqli_query($conn, "select AVG(star) from product_review where pid='$prodid'") or die(mysqli_error($conn));
                        if (mysqli_num_rows($overallReview)) {
                          $overall = mysqli_fetch_array($overallReview);
                          if (!empty($overall[0])) {
                            $rating = ceil($overall[0]);
                            for ($i = 1; $i <= $rating; $i++) { ?>
                              <li><i class="fa fa-star"></i></li>
                            <?php } ?>
                            <li>
                              <p><?php echo $rating; ?></p>
                            </li>
                          <?php } else { ?>
                            <li><?php echo 'Not Rated Yet'; ?></li>
                          <?php } ?>
                        <?php } ?>
                      </ul>
                      <h6><?php echo $product['pname']; ?></h6>
                    </div>
                    <span class="vegnonveg">
                      <div class="vegnonveg--icon veg">
                        <div class="dot"></div>
                      </div>
                      <p><?php
                          if ($product['flavour'] != 'NA') {
                            echo ucfirst($product['flavour']) . ' ' . $product['weight'] . ' ' . $product['unit'];
                          } else {
                            echo $product['weight'] . ' ' . $product['unit'];
                          } ?></p>
                    </span>
                    <span class="off-per"><i class="fa fa-tags"></i>
                      <p><?php $discount = (($product['MRP'] - $product['SRP']) / $product['MRP']) * 100;
                          echo intval($discount); ?>% Off</p>
                    </span>
                    <div class="price">
                      <h6><span><i class="fa fa-rupee"></i></span><?php echo ' ' . $product['SRP']; ?></h6>
                      <h6 class="l-through"><span><i class="fa fa-rupee"></i></span><?php echo ' ' . $product['MRP']; ?></h6>
                    </div>
                    <div class="prd-bottom">
                      <a name="prod" class="social-info">
                        <span class="fa fa-shopping-bag"></span>
                        <p name="addtocart" id="<?php echo $product['pid']; ?>" class="hover-text">add to bag</p>
                      </a>
                      <a name='wishlist' class="social-info">
                        <span class="fa fa-heart"></span>
                        <p id="<?php echo $prodid; ?>" class="hover-text">Wishlist</p>
                      </a>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <!-- single product slide -->
    <div class="single-product-slider">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <div class="section-title">
              <h1>Coming Products</h1>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <?php
          $latestProdQuery = mysqli_query($conn, "SELECT * FROM products GROUP BY pname order by date desc limit 8") or die(mysqli_error($conn));
          while ($product = mysqli_fetch_array($latestProdQuery)) {
            $prodid = $product['pid']; ?>
            <!-- single product -->
            <div class="col-lg-3 col-md-6">
              <div class="single-product">
                <a href="single-product.php?pid=<?php echo $product['pid']; ?>" class="s_product_link">
                  <?php if (!empty($product['image1'])) { ?>
                    <img class="img-fluid" src="img/Products/<?php echo $product['image1']; ?>" alt="<?php echo $product['image1']; ?>" />
                  <?php } else { ?>
                    <img class="img-fluid" src="img/Products/OMEGA-3.jpg" alt="<?php echo 'No Image'; ?>" />
                  <?php } ?>
                  <div class="product-details">
                    <div class="review_box">
                      <ul class="list">
                        <?php
                        $overallReview = mysqli_query($conn, "select AVG(star) from product_review where pid='$prodid'") or die(mysqli_error($conn));
                        if (mysqli_num_rows($overallReview)) {
                          $overall = mysqli_fetch_array($overallReview);
                          if (!empty($overall[0])) {
                            $rating = ceil($overall[0]);
                            for ($i = 1; $i <= $rating; $i++) { ?>
                              <li><i class="fa fa-star"></i></li>
                            <?php } ?>
                            <li>
                              <p><?php echo $rating; ?></p>
                            </li>
                          <?php } else { ?>
                            <li><?php echo 'Not Rated Yet'; ?></li>
                          <?php } ?>
                        <?php } ?>
                      </ul>
                      <h6><?php echo $product['pname']; ?></h6>
                    </div>
                    <span class="vegnonveg">
                      <div class="vegnonveg--icon veg">
                        <div class="dot"></div>
                      </div>
                      <p><?php
                          if ($product['flavour'] != 'NA') {
                            echo ucfirst($product['flavour']) . ' ' . $product['weight'] . ' ' . $product['unit'];
                          } else {
                            echo $product['weight'] . ' ' . $product['unit'];
                          } ?></p>
                    </span>
                    <span class="off-per"><i class="fa fa-tags"></i>
                      <p><?php $discount = (($product['MRP'] - $product['SRP']) / $product['MRP']) * 100;
                          echo intval($discount); ?>% Off</p>
                    </span>
                    <div class="price">
                      <h6><span><i class="fa fa-rupee"></i></span><?php echo ' ' . $product['SRP']; ?></h6>
                      <h6 class="l-through"><span><i class="fa fa-rupee"></i></span><?php echo ' ' . $product['MRP']; ?></h6>
                    </div>
                    <div class="prd-bottom">
                      <a name="prod" class="social-info">
                        <span class="fa fa-shopping-bag"></span>
                        <p name="addtocart" id="<?php echo $product['pid']; ?>" class="hover-text">add to bag</p>
                      </a>
                      <a name='wishlist' class="social-info">
                        <span class="fa fa-heart"></span>
                        <p id="<?php echo $prodid; ?>" class="hover-text">Wishlist</p>
                      </a>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </section>
  <!-- end product Area -->


  <!-- Start category Area -->
  <section class="category-area section_gap_bottom">
    <div class="container-fluid">
      <h1 class="heading row">Shop by Category</h1>
      <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
          <div class="row">
            <?php
            $catQuery = mysqli_query($conn, "SELECT * FROM product_category order by catid") or die(mysqli_error($conn));
            while ($row = mysqli_fetch_array($catQuery)) {
              $catid = $row['catid'];
              $catname = $row['catname']; ?>
              <div class="col-lg-2 col-md-5">
                <div class="single-deal">
                  <div class="overlay"></div>
                  <img class="img-fluid w-50" src="img/category/<?php echo $row['catimage']; ?>" alt="" />
                  <a href='category.php?catid=<?php echo $catid; ?>' target="_blank">
                    <div class="deal-details">
                      <h6 class="deal-title"><?php echo $catname; ?></h6>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
        <!-- <div class="col-lg-4 col-md-6">
          <div class="single-deal">
            <div class="overlay"></div>
            <img class="img-fluid w-100" src="img/category/c5.jpg" alt="" />
            <a href="img/category/c5.jpg" class="img-pop-up" target="_blank">
              <div class="deal-details">
                <h6 class="deal-title">Sneaker for Sports</h6>
              </div>
            </a>
          </div>
        </div> -->
      </div>
    </div>
  </section>
  <!-- End category Area -->

  <!-- Start exclusive deal Area -->
  <section class="exclusive-deal-area">
    <div class="container-fluid">
      <div class="row justify-content-center align-items-center">
        <div class="col-lg-6 no-padding exclusive-left">
          <div class="row clock_sec clockdiv" id="clockdiv">
            <div class="col-lg-12">
              <h1>Exclusive Hot Deal Ends Soon!</h1>
              <p>Who are in extremely love with eco friendly system.</p>
            </div>
            <div class="col-lg-12">
              <div id="js-countdown" class="row clock-wrap">
                <div class="col clockinner1 clockinner">
                  <h1 class="days">29</h1>
                  <span class="smalltext">Days</span>
                </div>
                <div class="col clockinner clockinner1">
                  <h1 class="hours">24</h1>
                  <span class="smalltext">Hours</span>
                </div>
                <div class="col clockinner clockinner1">
                  <h1 class="minutes">59</h1>
                  <span class="smalltext">Mins</span>
                </div>
                <div class="col clockinner clockinner1">
                  <h1 class="seconds">59</h1>
                  <span class="smalltext">Secs</span>
                </div>
              </div>
            </div>
          </div>
          <a class="primary-btn">Shop Now</a>
        </div>
        <div class="col-lg-6 no-padding exclusive-right">
          <div class="active-exclusive-product-slider">
          <?php
              $pids = array(1,8,15);
              if(!empty($pids)){     
                $sql = mysqli_query($conn,"SELECT * FROM products WHERE pid IN ('" . implode("','", $pids) . "') ") or die(mysqli_error($conn));
                if(mysqli_num_rows($sql)){
                  while($row=mysqli_fetch_array($sql)){?>
                    <div class="single-exclusive-slider">
                    <?php if (!empty($row['image2'])) { ?>
                      <img class="img-fluid" src="img/Products/<?php echo $row['image2']; ?>" alt="<?php echo $row['image2']; ?>" />
                    <?php } else { ?>
                      <img class="img-fluid" src="img/Products/OMEGA 3.png" alt="<?php echo 'No Image'; ?>" />
                    <?php } ?>
                    <!-- <img class="img-fluid" src="img/Products/OMEGA 3.png" alt="" /> -->
                    <div class="product-details">
                      <div class="price">
                        <h6><span><i class="fa fa-rupee"></i></span><?php echo ' '.$row['SRP'] ?></h6>
                        <h6 class="l-through"><span><i class="fa fa-rupee"></i></span><?php echo ' '.$row['MRP'] ?></h6>
                      </div>
                      <h4><?php echo $row['pname'].' '.$row['weight'].' '.$row['unit']; ?></h4>
                      <div class="add-bag d-flex align-items-center justify-content-center">
                        <a name="xdeal" id="<?php echo $row['pid'] ?>"class="add-btn"><span class="fa fa-shopping-bag"></span></a>
                        <span class="add-text text-uppercase">Add to Bag</span>
                      </div>
                    </div>
                  </div>
          <?php  }
                }
              }
          ?>

            <!-- single exclusive carousel -->
            <!-- <div class="single-exclusive-slider">
              <img class="img-fluid" src="img/Products/OMEGA 3.png" alt="" />
              <div class="product-details">
                <div class="price">
                  <h6>$150.00</h6>
                  <h6 class="l-through">$210.00</h6>
                </div>
                <h4>Weight Gainer 2 KG</h4>
                <div class="add-bag d-flex align-items-center justify-content-center">
                  <a class="add-btn" href=""><span class="fa fa-shopping-bag"></span></a>
                  <span class="add-text text-uppercase">Add to Bag</span>
                </div>
              </div>
            </div> -->
            <!-- single exclusive carousel -->
            <!-- <div class="single-exclusive-slider">
              <img class="img-fluid" src="img/Products/OMEGA 3.png" alt="" />
              <div class="product-details">
                <div class="price">
                  <h6>$150.00</h6>
                  <h6 class="l-through">$210.00</h6>
                </div>
                <h4>Whey Protien 2 KG</h4>
                <div class="add-bag d-flex align-items-center justify-content-center">
                  <a class="add-btn" href=""><span class="fa fa-shopping-bag"></span></a>
                  <span class="add-text text-uppercase">Add to Bag</span>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End exclusive deal Area -->

  <!-- Start brand Area -->
  <section class="brand-area section_gap">
    <div class="container">
      <div class="row">
        <a class="col single-img" href="#">
          <img class="img-fluid d-block mx-auto" src="img/brand/1.png" alt="" />
        </a>
        <a class="col single-img" href="#">
          <img class="img-fluid d-block mx-auto" src="img/brand/2.png" alt="" />
        </a>
      </div>
    </div>
  </section>
  <!-- End brand Area -->

  <!-- Start bestselling-product Area -->
  <?php include('best_selling.php'); ?>
  <!-- End bestselling-product Area -->

  <!-- start footer Area -->
  <?php include('footer.php'); ?>
  <!-- End footer Area -->


  <script src="js/vendor/jquery-2.2.4.min.js"></script>

  <script src="js/jquery.sticky.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="js/vendor/bootstrap.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/nouislider.min.js"></script>
  <!-- <script src="js/countdown.js"></script> -->
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <!--gmaps Js-->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
  <script src="js/gmaps.min.js"></script>
  <script src="js/main.js"></script>


  <script type="text/javascript">
    //$.noConflict();
    $(document).ready(function() {

      $("body").on("click", "a[name='prod']", function() {
        pid = $(this).find("p").attr("id");
        //alert(pid);
        <?php if (isset($userid)) { ?>
          $.ajax({
            url: 'updateCart.php',
            method: 'POST',
            data: {
              pid: pid
            },
            success: function(response) {
              // $("#products").html(response); 
              //alert(response);
              updateCartCounter();
            }
          });
        <?php } else {
          $_SESSION['pagename'] = basename(__FILE__); ?>
          window.location.href = "login.php";
        <?php } ?>
      });


      $("body").on("click", "a[name='wishlist']", function() {
        prodid = $(this).find("p").attr("id");
        //alert(prodid);
        <?php if (isset($userid)) { ?>
          uid = <?php echo $userid; ?>;
          $.ajax({
            url: 'updateWishlist.php',
            method: 'POST',
            data: {
              pid: prodid,
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


      $("a[name='xdeal']").on('click',function(){
        var pid = $(this).attr('id'); 
        //alert(pid);
        <?php if (isset($userid)) { ?>
          $.ajax({
            url: 'updateCart.php',
            method: 'POST',
            data: {
              pid: pid
            },
            success: function(response) {
              updateCartCounter();
            }
          });
        <?php } else {
          $_SESSION['pagename'] = basename(__FILE__); ?>
          window.location.href = "login.php";
        <?php } ?>
      });


      function updateCartCounter() {
        $.ajax({
          url: 'updateCartCounter.php',
          method: 'POST',
          success: function(response) {
            // $("#products").html(response); 
            $("#itemCounter").html(response);
            //console.log(response);
            //itemCounter
          }
        });
      }
    });
  </script>

</body>

</html>