  <!-- start features Area -->
  <section class="features-area section_gap">
    <div class="container">
      <div class="row features-inner">
        <!-- single features -->
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="single-features">
            <div class="f-icon">
              <img src="img/features/f-icon1.png" alt="" />
            </div>
            <h6>Free Delivery</h6>
            <p>Free Shipping on all order</p>
          </div>
        </div>
        <!-- single features -->
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="single-features">
            <div class="f-icon">
              <img src="img/features/f-icon2.png" alt="" />
            </div>
            <h6>Return Policy</h6>
            <p>Free Shipping on all order</p>
          </div>
        </div>
        <!-- single features -->
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="single-features">
            <div class="f-icon">
              <img src="img/features/f-icon3.png" alt="" />
            </div>
            <h6>24/7 Support</h6>
            <p>Free Shipping on all order</p>
          </div>
        </div>
        <!-- single features -->
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="single-features">
            <div class="f-icon">
              <img src="img/features/f-icon4.png" alt="" />
            </div>
            <h6>Secure Payment</h6>
            <p>Free Shipping on all order</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end features Area -->
  <footer class="footer-area section_gap">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Products</h6>
            <ul>
              <?php
              $prodQuery = mysqli_query($conn, "SELECT * FROM products group by pname order by pname limit 13") or die(mysqli_error($conn));
              if (mysqli_num_rows($prodQuery)) {
                while ($product = mysqli_fetch_array($prodQuery)) { ?>
                  <li><a href="single-product.php?pid=<?php echo $product['pid']; ?>"><?php echo $product['pname']; ?></a></li>
              <?php }
              } ?>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Categories</h6>
            <ul>
              <?php
              $catQuery = mysqli_query($conn, "SELECT * FROM product_category order by catname") or die(mysqli_error($conn));
              if (mysqli_num_rows($catQuery)) {
                while ($category = mysqli_fetch_array($catQuery)) { ?>
                  <li><a href="category.php?catid=<?php echo $category['catid']; ?>"><?php echo $category['catname']; ?></a></li>
              <?php }
              } ?>

            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>My Account</h6>
            <ul>
              <?php
              if (isset($_SESSION['uid'])) { ?>
                <li><a href="account.php">Profile</a></li>
              <?php } else {
                $_SESSION['pagename'] = 'account.php'; ?>
                <li><a href="login.php">Profile</a></li>
              <?php }
              if (isset($_SESSION['uid'])) { ?>
                <li><a href="account.php#order_sec">My Orders</a></li>
              <?php } else {
                $_SESSION['pagename'] = 'account.php#order_sec'; ?>
                <li><a href="login.php">My Orders</a></li>
              <?php }
              if (isset($_SESSION['uid'])) { ?>
                <li><a href="account.php#wishlist_sec">Wishlist</a></li>
              <?php } else {
                $_SESSION['pagename'] = 'account.php#wishlist_sec'; ?>
                <li><a href="login.php">Wishlist</a></li>
              <?php } ?>
            </ul><br>
            <h6>Contact Us</h6>
            <ul>
              <li>
                <address class="style-normal"> +91 9874561230<br><a href="mailto:support@ygn.com">support@ygn.com</a></address>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Newsletter</h6>
            <div class="" id="mc_embed_signup">
              <form target="_blank" novalidate="true" action="" method="get" class="form-inline">
                <div class="d-flex flex-row">
                  <input class="form-control" id="newsletter-email" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email" />

                  <button class="click-btn btn btn-default" id="subsBtn" type="button">Subscribe</button>
                  <!-- <div style="position: absolute; left: -5000px">
                  <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text" />
                </div> -->

                  <!-- <div class="col-lg-4 col-md-4">
												<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
											</div>  -->
                </div>
                <strong>
                  <p id="msgBox"></p>
                </strong>
                <div class="footer-social d-flex align-items-center">
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-instagram"></i></a>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                  <a href="#"><i class="fa fa-youtube"></i></a>
                </div>
                <div class="info"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
        <p class="footer-para m-0">
          <strong>Disclaimer</strong>: Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis expedita voluptates autem odit dolore, accusamus illum facere temporibus debitis, recusandae quae soluta pariatur eius velit aliquam? Iste dicta recusandae quo? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque, error voluptate numquam laboriosam dolores pariatur, sequi doloremque, magnam corporis maiores sapiente officia minima! Suscipit iure sit vel eos minima officia?
        </p>
      </div>
      <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
        <p class="footer-text m-0">
          <!-- Copyright section -->
          Copyright &copy;
          <script>
            document.write(new Date().getFullYear());
          </script>
          ygnnutrition.com | All rights reserved.
          <!-- Copyright section -->
        </p>
      </div>
    </div>
  </footer>

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