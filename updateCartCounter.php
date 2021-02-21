<?php
    session_start();
    include('connection.php');
    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
        $name = $_SESSION['name']; 

        $itemsInCart = mysqli_query($conn, "SELECT * FROM cart where user_id='$uid' ") or die(mysqli_error($conn));
        $counts = mysqli_num_rows($itemsInCart);
        //echo $counts;
?>



<span class="fa fa-shopping-cart"></span>
<?php 
    if(isset($counts)){?>
        <span ID="lblCartCount" runat="server" CssClass="badge badge-warning" ForeColor="White"><?php echo $counts; ?></span>
<?php } ?>
<?php } ?>