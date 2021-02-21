<?php
session_start();
include('connection.php');
$page = basename(__FILE__);

if (!empty($_SESSION['uid'])) {
  $uid = $_SESSION['uid'];
  $uname = $_SESSION['name'];
} else {
  $_SESSION['pagename'] = basename(__FILE__);
  header('location:login.php');
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
  <link rel="stylesheet" href="css/owl.carousel.css" />
  <link rel="stylesheet" href="css/themify-icons.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/nice-select.css" />
  <link rel="stylesheet" href="css/nouislider.min.css" />
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <!-- Start Header Area -->
  <?php include('header.php') ?>
  <!-- End Header Area -->

  <!-- Start Banner Area -->
  <section class="banner-area plain-bg organic-breadcrumb">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center a-banner-text">
        <div class="col-first">
          <h1>My Account</h1>
          <div class="d-flex a-name align-items-center">
            <h3>Welcome,&nbsp;
              <?php
              if (isset($uname))
                echo ucfirst($uname);
              else
                echo 'name';
              ?></h3>
          </div>
        </div>
        <div class="a-btn-sout col-last">
          <button id="signout" class="primary-btn">Sign Out</button>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->

  <script type="text/javascript">
    $(document).ready(function() {
      $('#signout').click(function() {
        window.location.href = 'logout.php';
      });
    });
  </script>

  <!--================Order Box Area =================-->
  <section id="order_sec" class="orders-section section_gap">
    <div class="container">
      <h1>Orders</h1>
      <!-- Start ordered Items -->
      <!-- Start Single order -->
      <?php if(!empty($uid)){
        $orders = mysqli_query($conn,"select * from orders where uid='$uid'") or die(mysqli_error($conn));
        if(mysqli_num_rows($orders)){
          //var_dump(unserialize(mysqli_fetch_array($orders)['items']));
            while($order = mysqli_fetch_array($orders)){ ?>
              <div class="col-lg-12">
                <div class="order-header d-flex" onclick="toggle_visibility('order-detail1');">
                  <h4>
                    Order# <?php echo $order['orderid']; ?>
                  </h4>
                  <i class="fa fa-angle-down"></i>
                </div>
                <div class="row hiddenDetails" id="order-detail1">
                  <!-- single product -->
                  <div class="col-lg-4 col-md-6">
                    <div class="ordered-item">
                      <span class="d-status"><span class="ti-package"></span>
                        <h4 class="green_status">Succesfully Placed On</h4>
                        <h5><span class="dilivery-date">Tue, 15 Sept</span>
                        </h5>
                      </span>
                      <a href="" class="ordered_product_link">
                        <div class="product-bought">
                          <img class="o-small-img" src="img/fav.png" alt="" />
                          <div class="product-details">
                            <h6>Whey Protein</h6>
                            <div class="price">
                              <h6>$150.00</h6>
                            </div>
                            <div class="weight">
                              <h6>2kg</h6>
                            </div>
                          </div>
                        </div>
                      </a>
                      <div class="product_rate">
                        <h6>Rated 4 <i class="fa fa-star"></i></h6>
                        <a href="#"> &nbsp;Do you agree?</a>
                      </div>
                    </div>
                  </div>
                  <!-- single product -->
                  <div class="col-lg-4 col-md-6">
                    <div class="ordered-item">
                      <span class="d-status"><span class="ti-package"></span>
                        <h4 class="green_status">Succesfully Placed On</h4>
                        <h5>
                          On&nbsp;<span class="dilivery-date">Tue, 15 Sept</span>
                        </h5>
                      </span>
                      <a href="" class="ordered_product_link">
                        <div class="product-bought">
                          <img class="o-small-img" src="img/fav.png" alt="" />
                          <div class="product-details">
                            <h6>Whey Protein</h6>
                            <div class="price">
                              <h6>$150.00</h6>
                            </div>
                            <div class="weight">
                              <h6>2kg</h6>
                            </div>
                          </div>
                        </div>
                      </a>
                      <div class="product_rate">
                        <h6>Rated 5 <i class="fa fa-star"></i></h6>
                        <a href="#"> &nbsp;Do you agree?</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php }}} ?>
       <!-- <div class="col-lg-12"> -->
      <!-- <div class="order-header d-flex" onclick="toggle_visibility('order-detail1');"> -->
          <!-- <h4>
            Order# 12345678
          </h4> -->
          <!-- <i class="fa fa-angle-down"></i>
        </div> -->
        <!-- <div class="row hiddenDetails" id="order-detail1"> -->
          <!-- single product -->
          <!-- <div class="col-lg-4 col-md-6">
            <div class="ordered-item">
              <span class="d-status"><span class="ti-package"></span>
                <h4 class="green_status">Succesfully Placed On</h4>
                <h5><span class="dilivery-date">Tue, 15 Sept</span>
                </h5>
              </span>
              <a href="" class="ordered_product_link">
                <div class="product-bought">
                  <img class="o-small-img" src="img/fav.png" alt="" />
                  <div class="product-details">
                    <h6>Whey Protein</h6>
                    <div class="price">
                      <h6>$150.00</h6>
                    </div>
                    <div class="weight">
                      <h6>2kg</h6>
                    </div>
                  </div>
                </div>
              </a>
              <div class="product_rate">
                <h6>Rated 4 <i class="fa fa-star"></i></h6>
                <a href="#"> &nbsp;Do you agree?</a>
              </div>
            </div>
          </div> -->
          <!-- single product -->
          <!-- <div class="col-lg-4 col-md-6">
            <div class="ordered-item">
              <span class="d-status"><span class="ti-package"></span>
                <h4 class="green_status">Succesfully Placed On</h4>
                <h5>
                  On&nbsp;<span class="dilivery-date">Tue, 15 Sept</span>
                </h5>
              </span>
              <a href="" class="ordered_product_link">
                <div class="product-bought">
                  <img class="o-small-img" src="img/fav.png" alt="" />
                  <div class="product-details">
                    <h6>Whey Protein</h6>
                    <div class="price">
                      <h6>$150.00</h6>
                    </div>
                    <div class="weight">
                      <h6>2kg</h6>
                    </div>
                  </div>
                </div>
              </a>
              <div class="product_rate">
                <h6>Rated 5 <i class="fa fa-star"></i></h6>
                <a href="#"> &nbsp;Do you agree?</a>
              </div>
            </div>
          </div> -->
        <!-- </div> -->
      <!-- </div> --> 
      <!-- End Single Order -->
      <!-- Start Single order -->
    </div>
  </section>
  <!--================Wishlist Box Area=================-->
  <section id="wishlist_sec" class="wishlist-section">
    <div class="container">
      <h1>Wishlist</h1>
      <div class="col-xl-12 col-lg-8 col-md-7">
        <!-- Start Wishlist Items -->
        <div id="wishlistData" class="row">
          <?php
          $wishlist = mysqli_query($conn, "SELECT * FROM wishlist where uid='$uid'") or die(mysqli_error($conn));
          while ($item = mysqli_fetch_array($wishlist)) {
            $prodid = $item['pid'];
            $productQuery = mysqli_query($conn, "SELECT * FROM products where pid='$prodid'") or die(mysqli_error($conn));
            $product = mysqli_fetch_array($productQuery);
          ?>
            <!-- single product -->
            <div class="col-lg-2 col-md-6">
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
                            echo $product['flavour'] . ' ' . $product['weight'] . ' ' . $product['unit'];
                          } else {
                            echo $product['weight'] . ' ' . $product['unit'];
                          } ?></p>
                    </span>
                    <div class="price">
                      <h6><span><i class="fa fa-rupee"></i></span><?php echo ' ' . $product['SRP']; ?></h6>
                      <h6 class="l-through"><span><i class="fa fa-rupee"></i></span><?php echo ' ' . $product['MRP']; ?></h6>
                    </div>
                    <div class="prd-bottom">
                      <a name="prod" class="social-info">
                        <span class="ti-bag"></span>
                        <p name="addtocart" id="<?php echo $product['pid']; ?>" class="hover-text">add to bag</p>
                      </a>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          <?php } ?>
          <!-- End Wishlisted items -->
        </div>
      </div>
    </div>
  </section>
  <!-- Address Section -->
  <section class="address_details section_gap">
    <div class="container">
      <div class="address_head d-flex flex-wrap align-items-center">
        <h1>Address</h1>
        <div class="a-btn-address">
          <button id="editAddress" class="primary-btn">Edit</button>
        </div>
      </div>
      <div id="addressField" class="row address_d_inner">
        <!-- <div class="col-lg-6">
          <div class="details_item">
            <h4>Billing Address</h4>
            <ul class="list">
              <li>
                <div class="a_alt"><span>Street</span> : 56/8</div>
              </li>
              <li>
                <div class="a_alt"><span>City</span> : Los Angeles</div>
              </li>
              <li>
                <div class="a_alt"><span>Country</span> : United States</div>
              </li>
              <li>
                <div class="a_alt"><span>Postcode </span> : 36952</div>
              </li>
            </ul>
          </div>
        </div> -->
        <div class="col-lg-6">
          <div class="details_item">
            <!-- <h4>Shipping Address</h4> -->
            <ul class="list">
              <li>
                <div class="a_alt"><span>Street</span> : </div>
              </li>
              <li>
                <div class="a_alt"><span>City</span> : </div>
              </li>
              <li>
                <div class="a_alt"><span>State</span> : </div>
              </li>
              <li>
                <div class="a_alt"><span>Country</span> : </div>
              </li>
              <li>
                <div class="a_alt"><span>Postcode </span> : </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- else edit section -->
      <form target="_blank" id="addressForm" action="updateAddress.php" method="post" class="">
        <div class="row address_d_inner">
          <!-- <div class="col-lg-6">
            <div class="details_item">
              <h4>Billing Address</h4>
              <ul class="list">
                <li>
                  <div class="a_alt"><span>Street</span>
                    <input type="text" name="bill-street" placeholder="Street" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Street'" class="single-input" required>
                  </div>
                </li>
                <li>
                  <div class="a_alt"><span>City</span> <input type="text" name="bill-city" placeholder="City" onfocus="this.placeholder = ''" onblur="this.placeholder = 'City'" class="single-input" required></div>
                </li>
                <li>
                  <div class="a_alt"><span>Country</span> <input type="text" name="bill-country" placeholder="Country" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Country'" class="single-input" required></div>
                </li>
                <li>
                  <div class="a_alt"><span>Postcode </span> <input type="text" name="bill-pincode" minlength="6" maxlength="6" title="Postcode must be of 6 digits in length" placeholder="Postcode" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Postcode'" class="single-input" required></div>
                </li>
              </ul>
            </div>
          </div> -->
          <div class="col-lg-6">
            <div class="details_item">
              <ul class="list">
                <li>
                  <div class="a_alt"><span>Street</span> <input type="text" name="ship-street" placeholder="Street with house name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Street with house name'" required class="single-input"></div>
                </li>
                <li>
                  <div class="a_alt"><span>City</span> <input type="text" name="ship-city" placeholder="City" onfocus="this.placeholder = ''" onblur="this.placeholder = 'City'" required class="single-input" required></div>
                </li>
                <li>
                  <div class="a_alt"><span>State</span> <input type="text" name="ship-state" placeholder="State" onfocus="this.placeholder = ''" onblur="this.placeholder = 'State'" required class="single-input" required></div>
                </li>
                <li>
                  <div class="a_alt"><span>Country</span> <input type="text" name="ship-country" placeholder="Country" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Country'" required class="single-input" required class="single-input"></div>
                </li>
                <li>
                  <div class="a_alt"><span>Postcode </span> <input type="text" name="ship-pincode" minlength="6" maxlength="6" title="Postcode must be of 6 digits in length" placeholder="Postcode" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Postcode'" required class="single-input"></div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="edit-btn-address">
          <button id="address_save" class="primary-btn">Save Changes</button>
        </div>
      </form>
    </div>
  </section>
  <!--================End Login Box Area =================-->

  <script type="text/javascript">
    $(document).ready(() => {

      fetchAddress();
      form = $("#addressForm");
      submit = $("#address_save");
      editAddress = $("#editAddress");
      form.hide();

      editAddress.on("click", () => {
        formToggle();
      });


      formToggle = () => {
        form.toggle("slow");
      }

      form.on("submit", (e) => {
        e.preventDefault(); //prevent default submit
        $.ajax({
          url: 'updateAddress.php',
          type: 'post',
          dataType: 'html',
          data: form.serialize(),
          beforeSend: function() {
            submit.html("Saving...");
          },
          success: (response) => {
            //alert(response);  
            formToggle();
            form.trigger("reset");
            editAddress.html(response);
            setTimeout(function() {
              editAddress.html("Edit");
              submit.html("Save Changes");
            }, 2000);
            fetchAddress();
          },
          error: (error) => {
            console.log(error);
          },
        });
      });

      function updateCartCounter() {
        $.ajax({
          url: 'updateCartCounter.php',
          method: 'POST',
          success: function(response) {
            $("#itemCounter").html(response);
          }
        });
      }

      function fetchAddress() {
        $.ajax({
          url: 'refreshAddress.php',
          method: 'POST',
          success: (response) => {
            $('#addressField').html(response);
            //console.log(response);
          },
          error: (error) => {
            console.log(error);
          }
        });
      }

      function updateCartCounter() {
        $.ajax({
          url: 'updateCartCounter.php',
          method: 'POST',
          data: {},
          success: function(response) {
            $("#itemCounter").html(response);
          }
        });
      }


      $("a[name='prod']").on('click', function() {
        pid = $(this).find("p").attr("id");
        //alert(pid);
        <?php if (isset($uid)) { ?>
          uid = <?php echo $uid; ?>;
          //alert(uid);
          $.ajax({
            url: 'updateCart.php',
            method: 'POST',
            data: {
              pid: pid
            },
            success: function(response) {
              updateCartCounter();
              removeWishlist(uid, pid);
            }
          });
        <?php } else {
          $_SESSION['pagename'] = basename(__FILE__); ?>
          window.location.href = "login.php";
        <?php } ?>
      });

      function removeWishlist(uid, pid) {
        $.ajax({
          url: 'removeWishlist.php',
          method: 'POST',
          data: {
            pid: pid,
            uid: uid
          },
          success: function(response) {
            console.log(response);
            $("#wishlistData").html(response);
          }
        });
      }
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
  <script type="text/javascript">
    function toggle_visibility(id) {
      var e = document.getElementById(id);
      if (e.style.display == 'flex')
        e.style.display = 'none';
      else
        e.style.display = 'flex';
    }
  </script>
</body>

</html>