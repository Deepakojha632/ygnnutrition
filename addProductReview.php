<?php
    include('connection.php');
    if(isset($_POST['uid']) && isset($_POST['pid']) && isset($_POST['star']) && isset($_POST['message'])){
        $uid = $_POST['uid'];
        $pid = $_POST['pid'];
        $star = $_POST['star'];
        $comment = $_POST['message'];
        //echo $pid;

        $getReview = mysqli_query($conn,"select * from product_review where userid='$uid' and pid='$pid'") or die( mysqli_error($conn));
        //  echo mysqli_num_rows($getReview);
        if(mysqli_num_rows($getReview)){
            $updateReview = mysqli_query($conn,"update product_review set star='$star',comment='$comment' where pid='$pid' and userid='$uid'") or die( mysqli_error($conn));
            if(mysqli_affected_rows($conn)){
                echo 'Review updated';
            }
        }else{
            $addReview = mysqli_query($conn,"insert into product_review(userid,pid,star,comment) values ('$uid','$pid','$star','$comment') ") or die( mysqli_error($conn));
            if(mysqli_affected_rows($conn)){
                echo 'Review added';
            }
        }
    }
?>
