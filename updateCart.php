<?php
    session_start();
    include('connection.php');
    
    if(isset($_SESSION['uid'])){
        $userid=$_SESSION['uid'];
        if(isset($_REQUEST['pid']) && isset($_REQUEST['quantity']) && isset($_REQUEST['cid'])){
            $pid = $_REQUEST['pid'];
            $cid = $_REQUEST['cid'];
            $requiredQuantity = $_REQUEST['quantity'];
            //echo $cid.' '.$pid.' '.$requiredQuantity;
            $prodDetail = mysqli_query($conn, "SELECT * FROM products where pid='$pid' and quantity > 0 ") or die( mysqli_error($conn));
            if(mysqli_num_rows($prodDetail)){
                $product = mysqli_fetch_array($prodDetail);
                $prodQuantity = $product['quantity'];
                $prodName = $product['pname'];
                $prodPrice = $product['SRP'];
                $totalPrice = $prodPrice * $requiredQuantity;
                //echo $totalPrice;

                if($prodQuantity >= $requiredQuantity){
                    $updateCartItem = mysqli_query($conn, "UPDATE cart SET quantity='$requiredQuantity',total_price='$totalPrice' where cid='$cid' and user_id='$userid' ") or die( mysqli_error($conn));
                    if(mysqli_affected_rows($conn) > 0){
                        //echo $prodName.' quantity updated into cart.';
                    }else{
                        //echo 'Something went wrong1, Please try again.';
                    }
                }else{
                    //echo 'Cannot add more 1. Required quantity is more than available product quantity';
                }
            }else{
                //echo 'Item out of stock.';
            }
        }
        else if(isset($_REQUEST['pid']) && isset($_REQUEST['quantity'])){
            $pid = $_REQUEST['pid'];
            $requiredQuantity = $_REQUEST['quantity'];
            echo $requiredQuantity;

            //echo $pid;
            $prodDetail = mysqli_query($conn, "SELECT * FROM products where pid='$pid' and quantity > 0 ") or die( mysqli_error($conn));
            if(mysqli_num_rows($prodDetail) > 0){
                $row = mysqli_fetch_array($prodDetail);
                //echo $row['pname'];
                $prodName = $row['pname'];
                $prodPrice = $row['SRP'];
                $totalPrice = $row['SRP'] * $requiredQuantity;
                $prodQuantity = $row['quantity'];
                $prodDetail = $row['weight'].=' ';
                $prodDetail = $prodDetail.=$row['unit'];
                $prodDetail = $prodDetail.=' ';
                if($row['flavour'] != 'NA'){
                    $prodDetail=$prodDetail.=$row['flavour'];
                    $prodDetail=$prodDetail.=' flavour';
                }

                $cartItemQuery = mysqli_query($conn, "SELECT * FROM cart where pid='$pid' and user_id='$userid'") or die( mysqli_error($conn));
                if(mysqli_num_rows($cartItemQuery) > 0){
                    $cartItem = mysqli_fetch_array($cartItemQuery);
                    $cid = $cartItem['cid'];
                    $requiredQuantity = $requiredQuantity + $cartItem['quantity'];
                    $totalPrice = $row['SRP']*$requiredQuantity;

                    //echo $requiredQuantity;
                    
                    if($prodQuantity >= $requiredQuantity){
                        $updateCartItem = mysqli_query($conn, "UPDATE cart SET quantity='$requiredQuantity',total_price='$totalPrice' where cid='$cid' and user_id='$userid' ") or die( mysqli_error($conn));
                        if(mysqli_affected_rows($conn) > 0){
                            //echo $prodName.' quantity updated into cart.';
                        }else{
                            //echo 'Something went wrong, Please try again.';
                        }
                    }else{
                        //echo 'Cannot add more 2. Required quantity is more than available product quantity';
                    }
                }else{
                    if($prodQuantity >= $requiredQuantity){
                        $insertIntoCart=mysqli_query($conn, "insert into cart(pid,pname,pprice,pdetail,quantity,user_id,total_price) values ('$pid','$prodName','$prodPrice','$prodDetail','$requiredQuantity','$userid','$totalPrice') ") or die( mysqli_error($conn));
                        if(mysqli_affected_rows($conn) > 0){
                            //echo $prodName.' added to cart.';
                        }else{
                            //echo 'Something went wrong, Please try again.';
                        }
                    }
                    else{
                        //echo 'Cannot add more 3. Required quantity is more than available product quantity';
                    }
                }
            }else{
                //echo 'Item out of stock.';
            }
        }
        else if(isset($_REQUEST['pid'])){
            $pid=$_REQUEST['pid'];
            $requiredQuantity=1;
            //echo $_REQUEST['quantity'];
            $prodDetail=mysqli_query($conn, "SELECT * FROM products where pid='$pid' and quantity > 0 ") or die( mysqli_error($conn));
            if(mysqli_num_rows($prodDetail) > 0){
                $row=mysqli_fetch_array($prodDetail);
                //echo $row['pname'];
                $prodName=$row['pname'];
                $prodPrice=$row['SRP'];
                $totalPrice=$row['SRP']*$requiredQuantity;
                $prodQuantity=$row['quantity'];
                $prodDetail=$row['weight'].=' ';
                $prodDetail=$prodDetail.=$row['unit'];
                $prodDetail=$prodDetail.=' ';
                if($row['flavour'] != 'NA'){
                    $prodDetail=$prodDetail.=$row['flavour'];
                    $prodDetail=$prodDetail.=' flavour';
                }

                $cartItemQuery=mysqli_query($conn, "SELECT * FROM cart where pid='$pid' and user_id='$userid' ") or die( mysqli_error($conn));
                if(mysqli_num_rows($cartItemQuery) > 0){
                    $cartItem = mysqli_fetch_array($cartItemQuery);
                    $cid = $cartItem['cid'];
                    $requiredQuantity = $cartItem['quantity']+1;
                    $totalPrice=$row['SRP']*$requiredQuantity;
                    
                    if($prodQuantity >= $requiredQuantity){
                        $updateCartItem = mysqli_query($conn, "UPDATE cart SET quantity='$requiredQuantity',total_price='$totalPrice' where cid='$cid' and user_id='$userid' ") or die( mysqli_error($conn));
                        if(mysqli_affected_rows($conn) > 0){
                            //echo $prodName.' quantity updated into cart.';
                        }else{
                            //echo 'Something went wrong, Please try again.';
                        }
                    }else{
                        //echo 'Cannot add more 4. Required quantity is more than available product quantity';
                    }
                }else{
                    if($prodQuantity >= $requiredQuantity){
                        $insertIntoCart = mysqli_query($conn, "insert into cart(pid,pname,pprice,pdetail,quantity,user_id,total_price) values ('$pid','$prodName','$prodPrice','$prodDetail','$requiredQuantity','$userid','$totalPrice') ") or die( mysqli_error($conn));
                        if(mysqli_affected_rows($conn) > 0){
                            //echo $prodName.' added to cart.';
                        }else{
                            //echo 'Something went wrong, Please try again.';
                        }
                    }
                    else{
                        //echo 'Cannot add more 5. Required quantity is more than available product quantity';
                    }
                }
            }else{
                //echo 'Item out of stock.';
            }
        }else if(isset($_POST['cid']) && isset($_POST['op'])){
            $cid = $_POST['cid'];
            $removeCartItem = mysqli_query($conn, "Delete from cart where cid='$cid' and user_id='$userid' ") or die( mysqli_error($conn));
            if(mysqli_affected_rows($conn)>0){
                //echo 'cart item deleted';
            }else{
                //echo 'Something went wrong while removing item from cart';
            }
        }
        else{
            //echo 'No product selected to add into cart';
        }
    }else{
        header('location:login.php');
    }
?>

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
        $getCartItems = mysqli_query($conn, "SELECT * FROM cart where user_id='$userid' order by itemdatetime desc") or die(mysqli_error($conn));
        if (mysqli_num_rows($getCartItems) > 0) {
            $subtotalQuery = mysqli_query($conn, "SELECT SUM(total_price) FROM cart where user_id='$userid' ") or die(mysqli_error($conn));
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
                                    if(mysqli_num_rows($productImage)){
                                        $image = mysqli_fetch_array($productImage);
                                        if(!empty($image['image1'])){?>
                                            <img src="img/Products/<?php echo $image['image1']; ?>" alt="<?php echo $items['pname'].' image';?>">
                                <?php }else{ ?>
                                        <img src="img/Products/logo.png" alt="image not available">
                                <?php }} ?>
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
            <!-- </td>
            <td>

            </td>
            <td>

            </td>
            <td> -->
                <!-- <div class="cupon_text d-flex align-items-center">
                    <input type="text" placeholder="Coupon Code">
                    <a class="primary-btn" href="#">Apply</a>
                    <a class="gray_btn" href="#">Close Coupon</a>
                </div>
            </td>
            <td>

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
                <h5><?php echo 'Rs.' . $subtotal[0]; ?></h5>
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