<?php 
    include('connection.php');

    if(isset($_POST['pid']) && !empty($_POST['pid']) && isset($_POST['uid']) && !empty($_POST['uid'])){
        $pid = $_POST['pid'];
        $uid = $_POST['uid'];
        $sql = mysqli_query($conn,"delete from wishlist where pid='$pid' and uid='$uid' ") or die(mysqli_error($conn));
        // if(mysqli_affected_rows($conn))
        //     //echo 'item removed from wishlist';
    }
    if(isset($_POST['uid']) && !empty($_POST['uid'])){
        $uid = $_POST['uid'];
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
                <h6><?php
                    if ($product['flavour'] != 'NA') {
                    echo $product['flavour'] . ' ' . $product['weight'] . ' ' . $product['unit'];
                    } else {
                    echo $product['weight'] . ' ' . $product['unit'];
                    } ?></h6>
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
<?php } } ?>