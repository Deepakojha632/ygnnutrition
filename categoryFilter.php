<?php
require 'connection.php';

if (isset($_POST["catid"]) && isset($_POST['sort']) && isset($_POST['pageno'])) {
  $catid = $_POST["catid"];
  $pageno = $_POST["pageno"];
  $sortValue = $_POST['sort'];
  //echo $catid.' '.$pageno.''.$sortValue;

  $limitPerPage = 24;
  $offest = ($pageno - 1) * $limitPerPage;
  //echo $offest;

  $sql = mysqli_query($conn, "SELECT * from products where catid='$catid' group by pname limit {$offest},{$limitPerPage}") or die(mysqli_error($conn));

  if ($sortValue == 'popularity') {
  } else if ($sortValue == 'priceasc') {
    $sql = mysqli_query($conn, "SELECT * from products where catid='$catid' group by pname order by SRP asc limit {$offest},{$limitPerPage}") or die(mysqli_error($conn));
  } else if ($sortValue == 'pricedsc') {
    $sql = mysqli_query($conn, "SELECT * from products where catid='$catid' group by pname order by SRP desc limit {$offest},{$limitPerPage}") or die(mysqli_error($conn));
  } else if ($sortValue == 'ratingdsc') {
  }

  if (mysqli_num_rows($sql)) {
    while ($row = mysqli_fetch_array($sql)) {
      $prodid = $row['pid']; ?>
      <div class="col-lg-4 col-md-6">
        <div class="single-product">
          <a href="single-product.php?pid=<?php echo $row['pid']; ?>" class="s_product_link">
            <?php if (!empty($row['image1'])) { ?>
              <img class="img-fluid" src="img/Products/<?php echo $row['image1']; ?>" alt="<?php echo $row['image1']; ?>" />
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
                <h6><?php echo $row['pname']; ?></h6>
              </div>
              <span class="vegnonveg">
                <div class="vegnonveg--icon veg">
                  <div class="dot"></div>
                </div>
                <p><?php
                    if ($row['flavour'] != 'NA') {
                      echo ucfirst($row['flavour']) . ' ' . $row['weight'] . ' ' . $row['unit'];
                    } else {
                      echo $row['weight'] . ' ' . $row['unit'];
                    } ?></p>
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
                <a name="wishlist" class="social-info">
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
  }
} else if (isset($_POST['sort']) && isset($_POST['pageno'])) {
  $pageno = $_POST["pageno"];
  $sortValue = $_POST['sort'];
  //echo $pageno.''.$sortValue;

  $limitPerPage = 24;
  $offest = ($pageno - 1) * $limitPerPage;
  //echo $offest;

  $sql = mysqli_query($conn, "SELECT * FROM products GROUP BY pname order by pname limit {$offest},{$limitPerPage} ") or die(mysqli_error($conn));

  if ($sortValue == 'popularity') {
  } else if ($sortValue == 'priceasc') {
    $sql = mysqli_query($conn, "SELECT * from products group by pname order by SRP asc limit {$offest},{$limitPerPage}") or die(mysqli_error($conn));
  } else if ($sortValue == 'pricedsc') {
    $sql = mysqli_query($conn, "SELECT * from products group by pname order by SRP desc limit {$offest},{$limitPerPage}") or die(mysqli_error($conn));
  } else if ($sortValue == 'ratingdsc') {
  }

  if (mysqli_num_rows($sql)) {
    while ($row = mysqli_fetch_array($sql)) {
      $prodid = $row['pid']; ?>
      <div class="col-lg-4 col-md-6">
        <div class="single-product">
          <a href="single-product.php?pid=<?php echo $row['pid']; ?>" class="s_product_link">
            <?php if (!empty($row['image1'])) { ?>
              <img class="img-fluid" src="img/Products/<?php echo $row['image1']; ?>" alt="<?php echo $row['image1']; ?>" />
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
                <h6><?php echo $row['pname']; ?></h6>
              </div>
              <span class="vegnonveg">
                <div class="vegnonveg--icon veg">
                  <div class="dot"></div>
                </div>
                <p><?php
                    if ($row['flavour'] != 'NA') {
                      echo ucfirst($row['flavour']) . ' ' . $row['weight'] . ' ' . $row['unit'];
                    } else {
                      echo $row['weight'] . ' ' . $row['unit'];
                    } ?></p>
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
                <a name="wishlist" class="social-info">
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
  }
} else if (isset($_POST["catid"]) && isset($_POST['sort'])) {
  $catid = $_POST["catid"];
  $sortValue = $_POST['sort'];
  //echo $sortValue.' '.$catid;

  $sql = mysqli_query($conn, "SELECT * from products where catid='$catid' group by pname ") or die(mysqli_error($conn));

  // "popularity"
  // "priceAsc"
  // "priceDsc"
  // "ratingDsc"

  if ($sortValue == 'popularity') {
  } else if ($sortValue == 'priceasc') {
    $sql = mysqli_query($conn, "SELECT * from products where catid='$catid' group by pname order by SRP asc ") or die(mysqli_error($conn));
  } else if ($sortValue == 'pricedsc') {
    $sql = mysqli_query($conn, "SELECT * from products where catid='$catid' group by pname order by SRP desc ") or die(mysqli_error($conn));
  } else if ($sortValue == 'ratingdsc') {
  }
  if (mysqli_num_rows($sql)) {
    while ($row = mysqli_fetch_array($sql)) {
      $prodid = $row['pid']; ?>
      <div class="col-lg-4 col-md-6">
        <div class="single-product">
          <a href="single-product.php?pid=<?php echo $row['pid']; ?>" class="s_product_link">
            <?php if (!empty($row['image1'])) { ?>
              <img class="img-fluid" src="img/Products/<?php echo $row['image1']; ?>" alt="<?php echo $row['image1']; ?>" />
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
                <h6><?php echo $row['pname']; ?></h6>
              </div>
              <span class="vegnonveg">
                <div class="vegnonveg--icon veg">
                  <div class="dot"></div>
                </div>
                <p><?php
                    if ($row['flavour'] != 'NA') {
                      echo ucfirst($row['flavour']) . ' ' . $row['weight'] . ' ' . $row['unit'];
                    } else {
                      echo $row['weight'] . ' ' . $row['unit'];
                    } ?></p>
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
                <a name="wishlist" class="social-info">
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
  }
} else if (isset($_POST["catid"])) {
  $catid = $_POST["catid"];
  //$sortValue = $_POST['sort'];
  //echo $catid;
  $limitPerPage = 24;
  $pageno = 1;


  // "popularity"
  // "priceAsc"
  // "priceDsc"
  // "ratingDsc"
  $offest = ($pageno - 1) * $limitPerPage;

  // if($sortValue=='popularity'){

  // }else if($sortValue=='priceAsc'){
  //   $sql=mysqli_query($conn,"SELECT * from products group by pname order by SRP asc limit {$offest},{$limitPerPage}") or die( mysqli_error($conn));

  // }else if($sortValue=='priceDsc'){
  //   $sql=mysqli_query($conn,"SELECT * from products group by pname order by SRP desc limit {$offest},{$limitPerPage} ") or die( mysqli_error($conn));
  // }else if($sortValue=='ratingDsc'){

  // }

  if (!isset($sql))
    $sql = mysqli_query($conn, "SELECT * from products where catid='$catid' group by pname limit {$offest},{$limitPerPage} ") or die(mysqli_error($conn));
  while ($row = mysqli_fetch_array($sql)) {
    $prodid = $row['pid']; ?>
    <div class="col-lg-4 col-md-6">
      <div class="single-product">
        <a href="single-product.php?pid=<?php echo $row['pid']; ?>" class="s_product_link">
          <?php if (!empty($row['image1'])) { ?>
            <img class="img-fluid" src="img/Products/<?php echo $row['image1']; ?>" alt="<?php echo $row['image1']; ?>" />
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
              <h6><?php echo $row['pname']; ?></h6>
            </div>
            <span class="vegnonveg">
              <div class="vegnonveg--icon veg">
                <div class="dot"></div>
              </div>
              <p><?php
                  if ($row['flavour'] != 'NA') {
                    echo ucfirst($row['flavour']) . ' ' . $row['weight'] . ' ' . $row['unit'];
                  } else {
                    echo $row['weight'] . ' ' . $row['unit'];
                  } ?></p>
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
              <a name="wishlist" class="social-info">
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
} else if (isset($_POST['sort'])) {
  $sortValue = $_POST['sort'];
  echo $sortValue;
  $limitPerPage = 24;
  $pageno = 1;

  // "popularity"
  // "priceAsc"
  // "priceDsc"
  // "ratingDsc"

  $offest = ($pageno - 1) * $limitPerPage;

  if ($sortValue == 'popularity') {
  } else if ($sortValue == 'priceasc') {
    $sql = mysqli_query($conn, "SELECT * from products group by pname order by SRP asc limit {$offest},{$limitPerPage}") or die(mysqli_error($conn));
  } else if ($sortValue == 'pricedsc') {
    $sql = mysqli_query($conn, "SELECT * from products group by pname order by SRP desc limit {$offest},{$limitPerPage} ") or die(mysqli_error($conn));
  } else if ($sortValue == 'ratingdsc') {
    //$sql = mysqli_query($conn,"SELECT * from products group by pname order by SRP desc limit {$offest},{$limitPerPage} ") or die( mysqli_error($conn));
  }

  if (!isset($sql))
    $sql = mysqli_query($conn, "SELECT * from products group by pname limit {$offest},{$limitPerPage} ") or die(mysqli_error($conn));
  while ($row = mysqli_fetch_array($sql)) {
    $prodid = $row['pid']; ?>
    <div class="col-lg-4 col-md-6">
      <div class="single-product">
        <a href="single-product.php?pid=<?php echo $row['pid']; ?>" class="s_product_link">
          <?php if (!empty($row['image1'])) { ?>
            <img class="img-fluid" src="img/Products/<?php echo $row['image1']; ?>" alt="<?php echo $row['image1']; ?>" />
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
              <h6><?php echo $row['pname']; ?></h6>
            </div>
            <span class="vegnonveg">
              <div class="vegnonveg--icon veg">
                <div class="dot"></div>
              </div>
              <p><?php
                  if ($row['flavour'] != 'NA') {
                    echo ucfirst($row['flavour']) . ' ' . $row['weight'] . ' ' . $row['unit'];
                  } else {
                    echo $row['weight'] . ' ' . $row['unit'];
                  } ?></p>
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
            </div>
          </div>
        </a>
      </div>
    </div>
<?php
  }
}
?>