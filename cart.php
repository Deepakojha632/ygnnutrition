<?php
session_start();
include('connection.php');
$page = basename(__FILE__);

if (!empty($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    //$subtotal = 0;
} else {
    $_SESSION['pagename'] = $page;
    header('location:login.php');
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
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">

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
    <?php include('header.php'); ?>
    <!-- End Header Area -->

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.php">Home &nbsp;> &nbsp;</a>
                        <a href="cart.php">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div id="cartData" class="table-responsive">
                    <table id="cartItems" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getCartItems = mysqli_query($conn, "SELECT * FROM cart where user_id='$uid' order by itemdatetime desc") or die(mysqli_error($conn));
                            if (mysqli_num_rows($getCartItems) > 0) {
                                $subtotalQuery = mysqli_query($conn, "SELECT SUM(total_price) FROM cart where user_id='$uid' ") or die(mysqli_error($conn));
                                $subtotal = mysqli_fetch_array($subtotalQuery);
                                $i = 0;
                                while ($items = mysqli_fetch_array($getCartItems)) {
                                    $i++; ?>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <?php
                                                    $pid = $items['pid'];
                                                    //echo $pid;
                                                    $productImage = mysqli_query($conn, "SELECT image1 FROM products where pid='$pid'") or die(mysqli_error($conn));
                                                    if (mysqli_num_rows($productImage)) {
                                                        $image = mysqli_fetch_array($productImage);
                                                        if (!empty($image['image1'])) { ?>
                                                            <img src="img/Products/<?php echo $image['image1']; ?>" alt="<?php echo $items['pname'] . ' image'; ?>">
                                                        <?php } else { ?>
                                                            <img src="img/Products/logo.png" alt="image not available">
                                                    <?php }
                                                    } ?>
                                                </div>
                                                <div class="media-body">
                                                    <p><?php echo $items['pname'] . ' ' . $items['pdetail']; ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5><?php echo $items['pprice']; ?></h5>
                                            <input type="hidden" class="cid" value="<?php echo $items['cid']; ?>">
                                            <input type="hidden" class="pid" value="<?php echo $items['pid']; ?>">
                                        </td>
                                        <td>
                                            <div class="product_count">
                                                <input type="text" name="qty" id="sst<?php echo $i ?>" maxlength="12" value=<?php echo $items['quantity']; ?> title="Quantity:" class="input-text qty">
                                                <button onclick="var result = document.getElementById('sst<?php echo $i ?>'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count plus" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                                <button onclick="var result = document.getElementById('sst<?php echo $i ?>'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;" class="reduced items-count minus" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                            </div>
                                        </td>
                                        <td>
                                            <h5><?php echo $items['total_price']; ?></h5>
                                        </td>
                                        <td>
                                            <a class="crossbtn"><i class="fa fa-times-circle"></i></a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $("#cartItems").hide();
                                        $("#cartData").text("Cart is empty currently");
                                    });
                                </script>
                            <?php } ?>

                            <!-- <tr class="bottom_button"> -->
                                <!-- <td> -->
                                    <!-- <a class="gray_btn" href="#">Update Cart</a> -->
                                <!-- </td> -->
                               
                                <!-- <td>
                                    <div class="cupon_text d-flex align-items-center">
                                        <input type="text" placeholder="Coupon Code">
                                        <a class="primary-btn" href="#">Apply</a>
                                        <a class="gray_btn" href="#">Close Coupon</a>
                                    </div>
                                </td> -->
                                <!-- <td>

                                </td> -->
                            <!-- </tr> -->
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5 id="subtotal"><?php echo 'Rs.' . $subtotal[0]; ?></h5>
                                </td>
                                <td>

                                </td>
                            </tr>
                            <!-- <tr class="shipping_area">
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Shipping</h5>
                                </td>
                                <td>
                                    <div class="shipping_box">
                                        <ul class="list">
                                            <li><a href="#">Flat Rate: $5.00</a></li>
                                            <li><a href="#">Free Shipping</a></li>
                                            <li><a href="#">Flat Rate: $10.00</a></li>
                                            <li class="active"><a href="#">Local Delivery: $2.00</a></li>
                                        </ul>
                                        <h6>Calculate Shipping <i class="fa fa-caret-down" aria-hidden="true"></i></h6>
                                        <select class="shipping_select">
                                            <option value="1">Bangladesh</option>
                                            <option value="2">India</option>
                                            <option value="4">Pakistan</option>
                                        </select>
                                        <select class="shipping_select">
                                            <option value="1">Select a State</option>
                                            <option value="2">Select a State</option>
                                            <option value="4">Select a State</option>
                                        </select>
                                        <input type="text" placeholder="Postcode/Zipcode">
                                        <a class="gray_btn" href="#">Update Details</a>
                                    </div>
                                </td>
                                <td>

                                </td>
                            </tr> -->
                            <tr class="out_button_area">
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="index.php">Continue Shopping</a>
                                        <a id="checkout" class="primary-btn" href="checkout.php">Proceed to checkout</a>
                                    </div>
                                </td>
                                <td>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("input", ".qty", function() {
                el = $(this).closest('tr');
                quantity = el.find('.qty').val();
                pid = el.find('.pid').val();
                cid = el.find('.cid').val();
                //alert('cid: ' + cid + ' pid: ' + pid + ' quantity: ' + quantity);
                //if(quantity!=0)
                if (quantity.length > 0 && parseInt(quantity) != 0) {
                    alert("Quantity:" + quantity);
                    $.ajax({
                        url: 'updateCart.php',
                        method: 'POST',
                        data: {
                            pid: pid,
                            quantity: quantity,
                            cid: cid
                        },
                        success: function(response) {
                            // $("#products").html(response); 
                            $("#cartData").html(response);
                        }
                    });
                } else {
                    //alert("quantity cannot be blank or zero");
                    updateCart();
                }
            });

            $("body").on("click", ".crossbtn", function() {
                el = $(this).closest('tr');
                cid = el.find('.cid').val();
                op = 'd';
                //alert(cid);
                $.ajax({
                    url: 'updateCart.php',
                    method: 'POST',
                    data: {
                        op: op,
                        cid: cid
                    },
                    success: function(response) {
                        // $("#products").html(response); 
                        //alert(response);
                        $("#cartData").html(response);
                        updateCartCounter();
                    }
                });
            });

            $("body").on("click", ".plus", function() {
                el = $(this).closest('tr');
                quantity = el.find('.qty').val();
                pid = el.find('.pid').val();
                cid = el.find('.cid').val();
                //alert('cid: ' + cid + ' pid: ' + pid + ' quantity: ' + quantity);

                if (quantity.length > 0 && parseInt(quantity) != 0) {
                    //alert("Quantity:"+quantity);
                    $.ajax({
                        url: 'updateCart.php',
                        method: 'POST',
                        data: {
                            pid: pid,
                            quantity: quantity,
                            cid: cid
                        },
                        success: function(response) {
                            // $("#products").html(response); 
                            $("#cartData").html(response);
                        }
                    });
                }
            });


            $("body").on("click", ".minus", function() {
                el = $(this).closest('tr');
                quantity = el.find('.qty').val();
                pid = el.find('.pid').val();
                cid = el.find('.cid').val();
                //alert('cid: ' + cid + ' pid: ' + pid + ' quantity: ' + quantity);
                //if(quantity!=0)
                if (quantity.length > 0 && parseInt(quantity) != 0) {
                    $.ajax({
                        url: 'updateCart.php',
                        method: 'POST',
                        data: {
                            pid: pid,
                            quantity: quantity,
                            cid: cid
                        },
                        success: function(response) {
                            // $("#products").html(response); 
                            $("#cartData").html(response);
                        }
                    });
                }
            });

            function updateCartCounter() {
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

            function updateCart() {
                $.ajax({
                    url: 'refreshCart.php',
                    method: 'POST',
                    data: {},
                    success: function(response) {
                        alert(response)
                        $("#cartData").html(response);
                    }
                });
            }





            // $(".qty").on("change",function(){
            //     el = $(this).closest('tr');
            //     quantity = el.find('.qty').val();
            //     pid = el.find('.pid').val();
            //     cid = el.find('.cid').val();
            //     alert('cid: '+cid+' pid: '+pid+' quantity: '+quantity);
            // });
        });
    </script>

    <!-- start footer Area -->
    <?php include('footer.php'); ?>
    <!-- End footer Area -->

</body>

</html>