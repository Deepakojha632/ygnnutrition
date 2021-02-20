<?php
    include('connection.php');
    
    if(isset($_POST['weight']) && isset($_POST['flavour']) && isset($_POST['name'])){
        $pname = $_POST['name'];
        $weight = $_POST['weight'];
        $flavour = $_POST['flavour'];
        $getPID = mysqli_query($conn, "SELECT pid FROM products where pname='$pname' and weight='$weight' and flavour='$flavour' ") or die( mysqli_error($conn));
        if(mysqli_num_rows($getPID)){
            $pid = mysqli_fetch_array($getPID);
            echo $pid['pid'];   
        }
    }
?>