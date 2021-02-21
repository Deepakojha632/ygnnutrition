<?php
    session_start();
    include('connection.php');
    
    if(isset($_POST['pid']) && isset($_POST['uid'])){
        $pid = $_POST['pid'];
        $uid = $_POST['uid'];
        //echo $pid.' '.$uid;

        $get = mysqli_query($conn,"select * from wishlist where uid='$uid' and pid='$pid' ") or die( mysqli_error($conn));
        if(mysqli_num_rows($get)){
            echo 'Already added to wishlist';
        }else{
            $add = mysqli_query($conn,"insert into wishlist values('$uid','$pid')") or die( mysqli_error($conn));
            if(mysqli_affected_rows($conn))
                echo 'Product added to wishlist';
        }
    }
?>