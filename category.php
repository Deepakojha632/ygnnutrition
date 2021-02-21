<?php
session_start();
include('connection.php');
$page = basename(__FILE__);
$userid;
$limitPerPage = 24;
$pageno = 1;

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
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/themify-icons.css" />
  <link rel="stylesheet" href="css/nice-select.css" />
  <link rel="stylesheet" href="css/nouislider.min.css" />
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>" />
  <script src="js/jquery3_5_1.min.js"></script>

  <script src="js/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
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

<body id="category">
  <!-- Start Header Area -->
  <?php include('header.php'); ?>
  <!-- End Header Area -->

  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
        <div class="col-first">
          <h1>Products</h1>
          <nav class="d-flex align-items-center">
            <a href="index.php">Home > &nbsp;</a>
            <a href="category.php">Products</a>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->
  <div class="container">
    <div class="row">
      <div class="col-xl-3 col-lg-4 col-md-5">
        <div class="sidebar-categories">
          <div class="head">Browse Categories</div>
          <ul id="categoryList" class="main-categories">
            <?php
            $sql1 = mysqli_query($conn, "SELECT * FROM product_category order by catid") or die(mysqli_error($conn));

            while ($row = mysqli_fetch_array($sql1)) { ?>
              <li id="<?php echo $row['catid']; ?>" class="main-nav-list">
                <a aria-expanded="false" aria-controls="fruitsVegetable">
                  <span class="lnr lnr-arrow-right"></span><?php echo $row['catname']; ?>
                  <span class="number"></span></a>
              </li>
            <?php
            } ?>
          </ul>
        </div>
        <!-- <div class="sidebar-filter mt-50">
          <div class="top-filter-head">Product Filters</div>
          <div class="common-filter">
            <div class="head">Brands</div>
            <form action="#">
              <ul>
                <li class="filter-list">
                  <input class="pixel-radio" type="radio" id="apple" name="brand" /><label for="apple">Apple<span>(29)</span></label>
                </li>
                <li class="filter-list">
                  <input class="pixel-radio" type="radio" id="asus" name="brand" /><label for="asus">Asus<span>(29)</span></label>
                </li>
                <li class="filter-list">
                  <input class="pixel-radio" type="radio" id="gionee" name="brand" /><label for="gionee">Gionee<span>(19)</span></label>
                </li>
                <li class="filter-list">
                  <input class="pixel-radio" type="radio" id="micromax" name="brand" /><label for="micromax">Micromax<span>(19)</span></label>
                </li>
                <li class="filter-list">
                  <input class="pixel-radio" type="radio" id="samsung" name="brand" /><label for="samsung">Samsung<span>(19)</span></label>
                </li>
              </ul>
            </form>
          </div>
          <div class="common-filter">
            <div class="head">Color</div>
            <form action="#">
              <ul>
                <li class="filter-list">
                  <input class="pixel-radio" type="radio" id="black" name="color" /><label for="black">Black<span>(29)</span></label>
                </li>
                <li class="filter-list">
                  <input class="pixel-radio" type="radio" id="balckleather" name="color" /><label for="balckleather">Black Leather<span>(29)</span></label>
                </li>
                <li class="filter-list">
                  <input class="pixel-radio" type="radio" id="blackred" name="color" /><label for="blackred">Black with red<span>(19)</span></label>
                </li>
                <li class="filter-list">
                  <input class="pixel-radio" type="radio" id="gold" name="color" /><label for="gold">Gold<span>(19)</span></label>
                </li>
                <li class="filter-list">
                  <input class="pixel-radio" type="radio" id="spacegrey" name="color" /><label for="spacegrey">Spacegrey<span>(19)</span></label>
                </li>
              </ul>
            </form>
          </div>
          <div class="common-filter">
            <div class="head">Price</div>
            <div class="price-range-area">
              <div id="price-range"></div>
              <div class="value-wrapper d-flex">
                <div class="price">Price:</div>
                <span>$</span>
                <div id="lower-value"></div>
                <div class="to">to</div>
                <span>$</span>
                <div id="upper-value"></div>
              </div>
            </div>
          </div>
        </div> -->
      </div>
      <div class="col-xl-9 col-lg-8 col-md-7">
        <!-- Start Filter Bar -->
        <div class="filter-bar d-flex flex-wrap align-items-center">
          <div class="sorting">
            <select id="sortValue">
              <option value="popularity">Popularity</option>
              <option value="priceAsc">Price - Low to High</option>
              <option value="priceDsc">Price - High to Low</option>
              <option value="ratingDsc">Rating - High to Low</option>
            </select>
          </div>
          <div class="mr-auto">
            <!-- add sorting class if added feature-->
            <!-- <select>
                <option value="1">Show 12</option>
                <option value="1">Show 12</option>
                <option value="1">Show 12</option>
              </select> -->
          </div>
          <div name="pageNoDiv" class="pagination">
            <a id="prev" class="prev-arrow">
              <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
            </a>
            <?php
            if (isset($_REQUEST['catid']) && !empty($_REQUEST['catid'])) {
              $catid = $_REQUEST["catid"];
              $sql = mysqli_query($conn, "SELECT * from products where catid='$catid' group by pname ") or die(mysqli_error($conn));
              $records = mysqli_num_rows($sql);
              //echo $records;
              if ($records > 0) {
                $noOfPages = ceil($records / $limitPerPage);
                //echo $noOfPages;
                for ($i = 1; $i <= $noOfPages; $i++) {
                  if ($i == $pageno) { ?>
                    <a id="<?php echo $i; ?>" class="active"><?php echo $i; ?></a>
                  <?php } else { ?>
                    <a id="<?php echo $i; ?>"><?php echo $i; ?></a>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
              <?php } else {
              $catid = 101;
              $sql = mysqli_query($conn, "SELECT * from products where catid='$catid' group by pname ") or die(mysqli_error($conn));
              $records = mysqli_num_rows($sql);
              //echo $records;
              if ($records > 0) {
                $noOfPages = ceil($records / $limitPerPage);
                //echo $noOfPages;
                for ($i = 1; $i <= $noOfPages; $i++) {
                  if ($i == $pageno) { ?>
                    <a id="<?php echo $i; ?>" class="active"><?php echo $i; ?></a>
                  <?php } else { ?>
                    <a id="<?php echo $i; ?>"><?php echo $i; ?></a>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            <?php } ?>
            <a id="next" class="next-arrow">
              <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <!-- End Filter Bar -->
        <!-- Start Best Seller -->
        <section class="lattest-product-area pb-40 category-list">
          <div id="products" class="row">
            <!-- single product -->

            <?php
            if (isset($_REQUEST['catid'])) { ?>
              <script type="text/javascript">
                $(document).ready(function() {
                  catid = <?php echo $_REQUEST['catid']; ?>;
                  //alert(catid);

                  $.ajax({
                    url: 'categoryFilter.php',
                    method: 'POST',
                    data: {
                      catid: catid
                    },
                    success: function(response) {
                      $("#products").empty();
                      $("#products").append(response);
                      console.log(response);
                    }
                  });
                });
              </script>
              <?php
            } else {
              $offest = ($pageno - 1) * $limitPerPage;
              $sql1 = mysqli_query($conn, "SELECT * FROM products where catid=101 GROUP BY pname order by pname limit {$offest},{$limitPerPage} ") or die(mysqli_error($conn));
              while ($row = mysqli_fetch_array($sql1)) {
                $prodid = $row['pid']; ?>
                <div class="col-lg-4 col-md-6">
                  <div class="single-product">
                    <a href="single-product.php?pid=<?php echo $prodid; ?>" class="s_product_link">
                      <img class="img-fluid" src="img/Products/OMEGA-3 WB.jpg" alt="<?php echo $row['pname'] ?>" />
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
                        </div>
                        <h6><?php echo $row['pname']; ?></h6>
                        <span class="vegnonveg">
                          <div class="vegnonveg--icon veg">
                            <div class="dot"></div>
                          </div>
                          <p><?php
                              if ($row['flavour'] != 'NA') {
                                echo ucfirst($row['flavour']) . ' ' . $row['weight'] . ' ' . $row['unit'];
                              } else {
                                echo $row['weight'] . ' ' . $row['unit'];
                              } ?>
                          </p>
                        </span>
                        <span class="off-per"><i class="fa fa-tags"></i>
                          <p><?php $discount = (($row['MRP'] - $row['SRP']) / $row['MRP']) * 100;
                              echo intval($discount); ?>% Off</p>
                        </span>
                        <div class="price">
                          <h6><span><i class="fa fa-rupee"></i></span><?php echo ' ' . $row['SRP']; ?></h6>
                          <h6 class="l-through"><span><i class="fa fa-rupee"></i></span><?php echo ' ' . $row['MRP']; ?></h6>
                        </div>
                        <div class="prd-bottom">
                          <a name="prod" class="social-info">
                            <span class="fa fa-shopping-bag"></span>
                            <p name="addtocart" id="<?php echo $row['pid']; ?>" class="hover-text">add to bag</p>
                          </a>
                          <a name='wishlist' class="social-info">
                            <span class="fa fa-heart"></span>
                            <p id="<?php echo $prodid; ?>" class="hover-text">Wishlist</p>
                          </a>
                          <!-- <a href="" class="social-info">
                                <span class="lnr lnr-move"></span>
                                <p class="hover-text">view more</p>
                              </a> -->
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
            <?php
              }
            } ?>
          </div>
        </section>


        <!-- End Best Seller -->
        <!-- Start Filter Bar -->
        <div class="filter-bar d-flex flex-wrap align-items-center">
          <div class="mr-auto">
            <!-- add sorting class if added feature-->
            <!-- <select>
                <option value="1">Show 12</option>
                <option value="1">Show 12</option>
                <option value="1">Show 12</option>
              </select> -->
          </div>
          <div name="pageNoDiv" class="pagination">
            <a id="prev" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
            <?php
            if (isset($noOfPages) && !empty($noOfPages)) {
              for ($i = 1; $i <= $noOfPages; $i++) {
                if ($i == $pageno) { ?>
                  <a id="<?php echo $i; ?>" class="active"><?php echo $i; ?></a>
                <?php } else { ?>
                  <a id="<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php } ?>
            <?php }
            } ?>
            <a id="next" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
          </div>
        </div>
        <!-- End Filter Bar -->
      </div>
    </div>
  </div>

  <!-- Start bestselling-product Area -->
  <div class="section_gap_top">
    <?php include('best_selling.php'); ?>
  </div>
  <!-- End bestselling-product Area -->

  <!-- start footer Area -->
  <?php include('footer.php'); ?>
  <!-- End footer Area -->

  <!-- Modal Quick Product View -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="container relative">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="product-quick-view">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="quick-view-carousel">
                <div class="item" style="background: url(img/organic-food/q1.jpg)"></div>
                <div class="item" style="background: url(img/organic-food/q1.jpg)"></div>
                <div class="item" style="background: url(img/organic-food/q1.jpg)"></div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="quick-view-content">
                <div class="top">
                  <h3 class="head">Mill Oil 1000W Heater, White</h3>
                  <div class="price d-flex align-items-center">
                    <span class="lnr lnr-tag"></span>
                    <span class="ml-10">$149.99</span>
                  </div>
                  <div class="category">Category: <span>Household</span></div>
                  <div class="available">
                    Availibility: <span>In Stock</span>
                  </div>
                </div>
                <div class="middle">
                  <p class="content">
                    Mill Oil is an innovative oil filled radiator with the
                    most modern technology. If you are looking for something
                    that can make your interior look awesome, and at the same
                    time give you the pleasant warm feeling during the winter.
                  </p>
                  <a href="#" class="view-full">View full Details
                    <span class="lnr lnr-arrow-right"></span></a>
                </div>
                <div class="bottom">
                  <div class="color-picker d-flex align-items-center">
                    Color:
                    <span class="single-pick"></span>
                    <span class="single-pick"></span>
                    <span class="single-pick"></span>
                    <span class="single-pick"></span>
                    <span class="single-pick"></span>
                  </div>
                  <div class="quantity-container d-flex align-items-center mt-15">
                    Quantity:
                    <input type="text" class="quantity-amount ml-15" value="1" />
                    <div class="arrow-btn d-inline-flex flex-column">
                      <button class="increase arrow" type="button" title="Increase Quantity">
                        <span class="lnr lnr-chevron-up"></span>
                      </button>
                      <button class="decrease arrow" type="button" title="Decrease Quantity">
                        <span class="lnr lnr-chevron-down"></span>
                      </button>
                    </div>
                  </div>
                  <div class="d-flex mt-20">
                    <a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
                    <a href="#" class="like-btn"><span class="lnr lnr-layers"></span></a>
                    <a href="#" class="like-btn"><span class="fa fa-heart"></span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      var catid;
      var pageNo = 1;
      var lastPageNo = <?php echo $noOfPages; ?>

      <?php
      if (isset($catid) && !empty($catid)) { ?>
        catid = '<?php echo $catid; ?>';
      <?php } else { ?>
        catid = 101;
      <?php } ?>

      $("#categoryList li").click(function() {
        catid = $(this).attr("id");
        sortValue = $("#sortValue").children("option:selected").val().toLowerCase();
        //alert(sortValue);

        $.ajax({
          url: 'categoryFilter.php',
          method: 'POST',
          data: {
            catid: catid,
            sort: sortValue
          },
          success: function(response) {
            $("#products").html(response);
            console.log(response);
          }
        });
      });

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


      $("body").on("click", "div[name='pageNoDiv'] a", function() {
        if ($(this).attr('id') === 'prev') {
          if (pageNo == 1)
            pageNo = 1;
          else
            pageNo--;
        } else if ($(this).attr('id') === 'next') {
          if (pageNo == lastPageNo)
            pageNo = lastPageNo;
          else
            pageNo++;
        } else
          pageNo = $(this).attr('id');

        // $("div[name='pageNoDiv'] a").removeClass("active");
        // $(this).addClass('active');
        selectPageNo(pageNo);

        sortValue = $("#sortValue").children("option:selected").val().toLowerCase();

        alert(pageNo + ' catid: ' + catid + ' sortValue: ' + sortValue);
        $.ajax({
          url: 'categoryFilter.php',
          method: 'POST',
          data: {
            catid: catid,
            sort: sortValue,
            pageno: pageNo
          },
          success: function(response) {
            $("#products").html(response);
            console.log(response);
          }
        });
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
              console.log(response);
            }
          });
        <?php } else {
          $_SESSION['pagename'] = basename(__FILE__); ?>
          window.location.href = "login.php";
        <?php } ?>
      });


      $("body").on("change", "#sortValue", function() {
        sortValue = $(this).children("option:selected").val().toLowerCase();
        //alert(sortValue+' catid: '+catid);
        $.ajax({
          url: 'categoryFilter.php',
          method: 'POST',
          data: {
            catid: catid,
            sort: sortValue,
            pageno: pageNo
          },
          success: function(response) {
            $("#products").html(response);
            console.log(response);
          },
          error: function(error) {
            console.log(error);
          }
        });
      });

      //selecting active page no
      function selectPageNo(pageNo) {
        $("div[name='pageNoDiv'] a").removeClass("active");
        currentPage = $("div[name='pageNoDiv'] a");
        currentPage.each(function() {
          if ($(this).attr('id') == pageNo) {
            //alert($(this).attr('id'));
            $(this).addClass('active');
          }
        });
      }

      //updating cart counter
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

    });
  </script>
</body>

</html>