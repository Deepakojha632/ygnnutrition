<?php
    session_start();
    include('connection.php');
    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
        //$bill = mysqli_query($conn,"select * from billing_address where uid='$uid'") or die( mysqli_error($conn));
        $ship = mysqli_query($conn,"select * from shipping_address where uid='$uid'") or die( mysqli_error($conn));
    }
    else{
        header('login.php');
    }


    if(isset($ship)){
        if(mysqli_num_rows($ship)){
            //$billAddress = mysqli_fetch_array($bill);
            $shipAddress = mysqli_fetch_array($ship);?>
            <div class="col-lg-6">
                <div class="details_item">
                    <ul class="list">
                    <li>
                        <div class="a_alt"><span>Street</span> : <?php echo $shipAddress['street']; ?></div>
                    </li>
                    <li>
                        <div class="a_alt"><span>City</span> : <?php echo $shipAddress['city']; ?></div>
                    </li>
                    <li>
                        <div class="a_alt"><span>State</span> : <?php echo $shipAddress['state']; ?></div>
                    </li>
                    <li>
                        <div class="a_alt"><span>Country</span> : <?php echo $shipAddress['country']; ?></div>
                    </li>
                    <li>
                        <div class="a_alt"><span>Postcode </span> : <?php echo $shipAddress['pincode']; ?></div>
                    </li>
                    </ul>
                </div>
            </div>
<?php }}?>


<!-- <div class="col-lg-6">
    <div class="details_item">
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
</div> -->
    