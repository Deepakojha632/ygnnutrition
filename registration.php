<?php
  include 'connection.php';
  $page = basename(__FILE__);
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
  <link rel="stylesheet" href="css/main.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <!-- Start Header Area -->
  <?php
  include 'header.php';
  
  ?>
  <!-- End Header Area -->

  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
        <div class="col-first">
          <h1>Register</h1>
          <nav class="d-flex align-items-center">
            <a href="index.php">Home &nbsp;> &nbsp;</a>
            <a href="registration.php">Register</a>
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
            <img class="img-fluid" src="img/login.jpg" alt="" />
            <div class="hover">
              <h4>Already Registered?</h4>
              <p>
                There are advances being made in science and technology
                everyday, and a good example of this is the
              </p>
              <a class="primary-btn" href="login.php">Login</a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="login_form_inner">
            <h3>Create an Account</h3>
            <form class="row login_form" method="POST" id="contactForm">

              <div class="col-md-12 form-group">
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" title="Full name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full Name'" required />
              </div>
              <div class="col-md-12 form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" title="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required />
              </div>
              <div class="col-md-12 form-group">
                <input type="text" class="form-control" id="mobileNo" maxlength=10 minlength=10 name="mobile" placeholder="Mobile Number" title="Mobile no should must contain 10 digits" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mobile Number'" required />
              </div>
              <div class="col-md-12 form-group">
                <input type="password" class="form-control" id="password" title="Password should must contain (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars)" name="pswd" placeholder="Password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required />
              </div>
              <div class="col-md-12 form-group"></div>
              <div class="col-md-12 form-group">
                <button id="submit" name="submitBtn" type="submit" class="primary-btn">
                  Register
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Login Box Area =================-->

  <!-- start footer Area -->
  <?php include('footer.php'); ?>
  <!-- End footer Area -->

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
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
    $(document).ready(function() {

      var form = $("#contactForm");
      var submit = $("#submit");

      form.on("submit", function(e) {
        e.preventDefault(); //prevent default form submit
        $.ajax({
          url: 'registerUser.php',
          type: 'POST',
          dataType: "html",
          data: form.serialize(), // serialize form data
          beforeSend: function() {
            submit.html("Registering...");
          },
          success: function(response) {
            console.log(response);
            form.trigger("reset");
            submit.html("Register");
            //submit.attr("style","display: none !important");
          },
          error: function(er) {
            console.log(e);
          }
        });
      });
    });
  </script>
</body>

</html>