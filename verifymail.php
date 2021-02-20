<?php
    include('connection.php');
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    mysqli_query($conn , "update user set status=1 where uid='$id' ");
    header('location:login.php');
?>