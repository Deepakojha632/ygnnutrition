<?php
session_start();
include('connection.php');
$page = basename(__FILE__);

if(isset($_SESSION['coupon']) && !empty($_SESSION['coupon']))
  unset($_SESSION['coupon']);

if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
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

  <!-- <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style> -->
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
          <h1>Checkout</h1>
          <nav class="d-flex align-items-center">
            <a href="index.php">Home > &nbsp;</a>
            <a href="checkout.php">Checkout</a>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->

  <!--================Checkout Area =================-->
  <section class="checkout_area section_gap">
    <div class="container">
      <div class="billing_details">
        <div class="row">
          <div class="col-lg-8">
            <h3 id="ship">Shipping Details</h3>
            <form id="masterDetailForm" class="row contact_form" method="post" novalidate="novalidate" autocomplete="on">
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" placeholder="First name" id="first" name="firstname" onfocus="this.placeholder=''" onblur="this.placeholder='First name'" required/>
                <!-- <span class="placeholder" data-placeholder=""></span> -->
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" placeholder="Last name" id="last" name="lastname" onfocus="this.placeholder=''" onblur="this.placeholder='Last name'" required/>
                <!-- <span class="placeholder" data-></span> -->
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="tel" class="form-control" minlength="10" maxlength="10" placeholder="Phone number" minlength="10" maxlength="10" id="number" name="phone" onfocus="this.placeholder=''" onblur="this.placeholder='Phone number'" required/>
                <!-- <span class="placeholder" data-></span> -->
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="email" class="form-control" placeholder="Email Address" id="email" name="email" onfocus="this.placeholder=''" onblur="this.placeholder='Email Address'" required/>
                <!-- <span class="placeholder" data-></span> -->
              </div>
              <!-- <div class="col-md-12 form-group p_star">
                <select class="country_select">
                  <option value="1">Country</option>
                  <option value="2">Country</option>
                  <option value="4">Country</option>
                </select>
              </div> -->
              <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control" placeholder="Address" id="street" name="street" onfocus="this.placeholder=''" onblur="this.placeholder='Address'" required/>
                <!-- <span class="placeholder" data-></span> -->
              </div>

              <div class="col-md-12 form-group">
                <input type="text" class="form-control" id="country" name="country" placeholder="Country" onfocus="this.placeholder=''" onblur="this.placeholder='Country'" required/>
              </div>
              <!-- <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control" id="add2" name="add2" />
                <span class="placeholder" data-placeholder="Address line 02"></span>
              </div> -->
              <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control" placeholder="Town/City" onfocus="this.placeholder=''" onblur="this.placeholder='Town/City'" id="city" name="city" required/>
                <!-- <span class="placeholder" data-></span> -->
              </div>
              <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control" placeholder="State" onfocus="this.placeholder=''" onblur="this.placeholder='State'" id="state" name="state" required/>
              </div>
              <div class="col-md-12 form-group">
                <input type="text" class="form-control" id="pincode" minlength="6" maxlength="6" name="pincode" placeholder="Pincode/ZIP" onfocus="this.placeholder=''" onblur="this.placeholder='Pincode/ZIP'" required/>
              </div>
              <div class="col-md-12 form-group">
                <input type="checkbox" id="savedAddress" name="savedAddress"/>
                <label>&nbsp&nbspProceed with default address.</label>
              </div>
              <div class="col-md-12 form-group">
                <p id="message"></p> 
              </div>
              <!-- <div class="col-md-12 form-group">
                <div class="creat_account">
                  <input type="checkbox" id="f-option2" name="selector" />
                  <label for="f-option2">Create an account?</label>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <div class="creat_account">
                  <h3>Shipping Details</h3>
                  <input type="checkbox" id="f-option3" name="selector" />
                  <label for="f-option3">Ship to a different address?</label>
                </div>
                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
              </div> -->
            </form>

            <form id="detailForm" action="placeorder.php" class="row contact_form" method="post">
                <input type="text" class="form-control" placeholder="First name" name="firstname" onfocus="this.placeholder=''" onblur="this.placeholder='First name'" required/>
                <input type="text" class="form-control" placeholder="Last name" name="lastname" onfocus="this.placeholder=''" onblur="this.placeholder='Last name'" required/>
                <input type="tel" class="form-control" minlength="10" maxlength="10" placeholder="Phone number" minlength="10" maxlength="10" name="phone" onfocus="this.placeholder=''" onblur="this.placeholder='Phone number'" required/>
                <input type="email" class="form-control" placeholder="Email Address" name="email" onfocus="this.placeholder=''" onblur="this.placeholder='Email Address'" required/>
                <input type="text" class="form-control" placeholder="Address" name="street" onfocus="this.placeholder=''" onblur="this.placeholder='Address'" required/>
                <input type="text" class="form-control" name="country" placeholder="Country" onfocus="this.placeholder=''" onblur="this.placeholder='Country'" required/>
                <input type="text" class="form-control" placeholder="Town/City" onfocus="this.placeholder=''" onblur="this.placeholder='Town/City'" name="city" required/>
                <input type="text" class="form-control" placeholder="State" onfocus="this.placeholder=''" onblur="this.placeholder='State'" name="state" required/>             
                <input type="text" class="form-control" minlength="6" maxlength="6" name="pincode" placeholder="Pincode/ZIP" onfocus="this.placeholder=''" onblur="this.placeholder='Pincode/ZIP'" required/>
                <input type="text" class="form-control" name="finalprice" placeholder="finalprice" onfocus="this.placeholder=''" onblur="this.placeholder='finalprice'" required/>
            </form>
          </div>
          
          <div class="col-lg-4">
            <div class="order_box">
              <h2>Your Order</h2>
              <ul class="list">
                <li>
                  <a>Product <span>Total</span></a>
                </li>

                <?php
                  $getCartItems = mysqli_query($conn, "SELECT * FROM cart where user_id='$uid' order by itemdatetime desc") or die(mysqli_error($conn));
                  if (mysqli_num_rows($getCartItems)) {
                      $subtotalQuery = mysqli_query($conn, "SELECT SUM(total_price) FROM cart where user_id='$uid' ") or die(mysqli_error($conn));
                      $chargeQuery = mysqli_query($conn, "SELECT * FROM shipping_charge") or die(mysqli_error($conn));
                      $charge = mysqli_fetch_array($chargeQuery);
                      $subtotal = mysqli_fetch_array($subtotalQuery);
                      $total = $subtotal[0] + $charge[0];  
                      while ($item = mysqli_fetch_array($getCartItems)) {?>
                        <li>
                          <a><?php echo $item['pname'] . ' ' . $item['pdetail']; ?><span class="middle">x <?php echo $item['quantity'];?></span>
                          <span class="last"><?php echo $item['pprice'];?></span></a>
                        </li>
                      <?php } ?>
              </ul>
              <ul id="finalprice" class="list list_2">
                <li id="subtotal">
                  <a>Subtotal <span>Rs. <?php echo $subtotal[0];?></span></a>
                </li>
                <li id="couponValue">
                  <a>Coupon Value <span></span></a>
                </li>
                <li id="shipcharge">
                  <a>Shipping <span>Rs. <?php echo $charge[0];?></span></a>
                </li>
                <li id="total">
                  <a>Total <span>Rs. <?php echo number_format($total, 2, '.', '');?></span></a>
                </li>
                <?php }else{ 
                    echo "<script>window.location.href='cart.php'</script>";
                }?>
                <li>
                  <div class="cupon_text d-flex align-items-center">
                      <input id="couponCode" type="text" placeholder="Coupon Code">
                      <a id="applyCoupon" class="primary-btn">Apply</a>
                  </div>
                  <p id="couponmsg"></p>
                </li>
              </ul>
              <!-- <div class="payment_item">
                <div class="radion_btn">
                  <input type="radio" id="f-option5" name="selector" />
                  <label for="f-option5">Check payments</label>
                  <div class="check"></div>
                </div>
                <p>
                  Please send a check to Store Name, Store Street, Store Town,
                  Store State / County, Store Postcode.
                </p>
              </div>
              <div class="payment_item active">
                <div class="radion_btn">
                  <input type="radio" id="f-option6" name="selector" />
                  <label for="f-option6">Paypal </label>
                  <img src="img/product/card.jpg" alt="" />
                  <div class="check"></div>
                </div>
                <p>
                  Pay via PayPal; you can pay with your credit card if you
                  don’t have a PayPal account.
                </p>
              </div> -->
              <div class="creat_account">
                <!-- <input type="checkbox" id="f-option4" name="selector" />
                <label for="f-option4">I’ve read and accept the </label>
                <a href="#">terms & conditions*</a> -->
              </div>
              <a id="paymentBtn" class="primary-btn">Proceed to Payment</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->

  <script type="text/javascript">
      $(document).ready(function(){
        $("#detailForm").hide();
        $("#couponValue").hide();
        var subtotal = <?php echo $subtotal[0];?>;
        var shippingCharge = <?php echo $charge[0];?>;
        var finalPrice = subtotal + shippingCharge;
        
        console.log(finalPrice);
        $("#couponmsg").hide();
        
        var uid;
        <?php 
          if(isset($uid)&& !empty($uid)) {?>
            uid = '<?php echo $uid; ?>';
            //alert(uid);
          <?php }?>
          //applying coupon  
          
          $("#applyCoupon").on('click',function(){
            var ci=$("#couponCode");
            var code = ci.val();
            console.log(code);
            if(code!=''){
              $("#couponValue").hide();
              //console.log(typeof uid);
              if(uid){
                //alert($("#couponValue").val());
                finalPrice = subtotal + shippingCharge;
                $("#total").find('span').html('Rs. '+finalPrice);
                console.log(uid);
                $.ajax({
                  url:'applyCoupon.php',
                  method:'post',
                  data:{
                    uid:uid,
                    code:code
                  },
                  success:function(response){
                    //alert(response);
                    var data=$.parseJSON(response);
                    //console.log(data.msg);
                    if(data.error=='yes'){
                      showCouponMsg(data.msg)
                    }else if(data.error=='no'){
                      var discount = Number((data.value/100)*subtotal).toFixed(2);
                      finalPrice= subtotal - discount + shippingCharge;
                      //finalPrice = Number(finalPrice).toFixed(2);
                      //console.log(finalPrice);
                      $("#couponValue").show();
                      $("#couponValue").find('span').html('- Rs. '+discount);
                      $("#total").find('span').html('Rs. '+Number(finalPrice).toFixed(2));
                      showCouponMsg(data.msg);
                    }
                    console.log(response);
                  }
                });
              }
            }else{
              ci.css("border", "1.5px solid red");
              ci.val('');
              ci.attr("placeholder", "Coupon Code");
            }
          });

          $("#couponCode").on('blur',function(){
              $(this).css("border", "2px grey");
              $(this).attr("placeholder", "Coupon Code");
          });


          $("#savedAddress").on('change',function() {
              if($(this).prop('checked')) {
                //alert("Checked Box Selected "+uid);
                $.ajax({
                    url:'fetchAddress.php',
                    method:'post',
                    data:{
                      uid:uid 
                    },
                    beforeSend: function() {
                      $('#message').show();
                      $('#message').html('fetching address...');
                    },
                    success:function(response){
                      $('#message').hide();
                      var data=$.parseJSON(response);
                      console.log(data);
                      if(data.error=='no'){
                        $("#masterDetailForm input[name='firstname']").val(data.first);
                        $("#masterDetailForm input[name='lastname']").val(data.last);
                        $("#masterDetailForm input[name='phone']").val(data.phone);
                        $("#masterDetailForm input[name='email']").val(data.email);
                        $("#masterDetailForm input[name='street']").val(data.street);
                        $("#masterDetailForm input[name='country']").val(data.country);
                        $("#masterDetailForm input[name='city']").val(data.city);
                        $("#masterDetailForm input[name='state']").val(data.state);
                        $("#masterDetailForm input[name='pincode']").val(data.pincode);
                      }else{
                        addressMsg(data.msg);
                      }
                    },
                    error:function(error){
                      console.log(error.statusText);
                    }
                });
              }else {
                $('#masterDetailForm').trigger("reset");
              }
          });


          function addressMsg(msg){
            $('#message').show();
            $('#message').html(msg);
            console.log(msg);
            setTimeout(() => {
              $('#message').hide();
            }, 2000);
          }

          $("#paymentBtn").on('click',function(){
            console.log(finalPrice);
            var firstname = $("#first").val();
            var lastname = $("#last").val();
            var phone = $("#number").val();
            var email = $("#email").val();
            var street = $("#street").val();
            var country = $("#country").val();
            var city = $("#city").val();
            var state = $("#state").val();
            var pincode = $("#pincode").val();
            
            if(firstname==''){
              $("#first").css("border", "2px solid red");
              window.location.href="#ship";
            }
            else if(lastname==''){
              $("#last").css("border", "2px solid red");
              window.location.href="#masterDetailForm";
            }
            else if(phone==''){
              $("#number").css("border", "2px solid red");
              window.location.href="#masterDetailForm";
            }
            else if(email==''){
              $("#email").css("border", "2px solid red");
              window.location.href="#masterDetailForm";
            }
            else if(street==''){
              $("#street").css("border", "2px solid red");
              window.location.href="#masterDetailForm";
            }
            else if(country==''){
              $("#country").css("border", "2px solid red");
              window.location.href="#country";
            }
            else if(city==''){
              $("#city").css("border", "2px solid red");
              window.location.href="#city";
            }
            else if(state==''){
              $("#state").css("border", "2px solid red");
            }
            else if(pincode==''){
              $("#pincode").css("border", "2px solid red");
            }
            else{
                console.log(firstname+' '+lastname+' '+phone+' '+email+' '+street+' '+country+' '+city+' '+state+' '+pincode);
                $("#detailForm input[name='firstname']").val(firstname);
                $("#detailForm input[name='lastname']").val(lastname);
                $("#detailForm input[name='phone']").val(phone);
                $("#detailForm input[name='email']").val(email);
                $("#detailForm input[name='street']").val(street);
                $("#detailForm input[name='country']").val(country);
                $("#detailForm input[name='city']").val(city);
                $("#detailForm input[name='state']").val(state);
                $("#detailForm input[name='pincode']").val(pincode);
                $("#detailForm input[name='finalprice']").val(finalPrice);
                
                $("#detailForm").submit();
            }
          });

          function showCouponMsg(msg){
            $("#couponCode").val('');
            $("#couponmsg").show();
            $("#couponmsg").html(msg);
            setTimeout(() => {
              $("#couponmsg").hide();
            }, 3000);
          }
          
      });
  </script>

  <!-- start footer Area -->
  <?php
  include('footer.php');
  ?>
  <!-- End footer Area -->

</body>

</html>