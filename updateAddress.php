<?php
    session_start();
    include('connection.php');
    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
        
        if(isset($_POST['ship-state']) && isset($_POST['ship-state']) && isset($_POST['ship-street']) && isset($_POST['ship-city']) && isset($_POST['ship-country']) && isset($_POST['ship-pincode'])){

            $shipstreet = $_POST['ship-street'];
            $shipcity = $_POST['ship-city'];
            $shipstate = $_POST['ship-state'];
            $shipcountry = $_POST['ship-country'];
            $shippincode = $_POST['ship-pincode'];

            //$sql = mysqli_query($conn,"select * from billing_address where uid='$uid'") or die( mysqli_error($conn));
            $sql1 = mysqli_query($conn,"select * from shipping_address where uid='$uid'") or die( mysqli_error($conn));
            // echo mysqli_num_rows($sql);
            // echo mysqli_num_rows($sql1);
            
            if(mysqli_num_rows($sql1)){
                //$billsql = mysqli_query($conn,"update billing_address set street='$billstreet',city='$billcity',country='$billcountry',pincode='$billpincode' where uid='$uid'") or die( mysqli_error($conn));
                $shipsql = mysqli_query($conn,"update shipping_address set street='$shipstreet',state='$shipstate',city='$shipcity',country='$shipcountry',pincode='$shippincode' where uid='$uid'") or die( mysqli_error($conn));
                if(mysqli_affected_rows($conn))
                    echo 'Address Updated';
                else
                    echo 'Same address found';
            }else{
                //$billsql = mysqli_query($conn,"insert into billing_address values('$uid','$billstreet','$billcity','$billcountry','$billpincode')") or die( mysqli_error($conn));
                $shipsql = mysqli_query($conn,"insert into shipping_address values('$uid','$shipstreet','$shipcity','$shipstate','$shipcountry','$shippincode')") or die( mysqli_error($conn));
                if(mysqli_affected_rows($conn))
                    echo 'Address Saved';
            }
        }
    }
?>