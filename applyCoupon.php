<?php 
    session_start();
    include('connection.php');
    $data = array();

    if(isset($_POST['uid']) && !empty($_POST['uid']) && isset($_POST['code']) && !empty($_POST['code'])){
        $uid = mysqli_real_escape_string($conn,$_POST['uid']);
        $code =  mysqli_real_escape_string($conn,$_POST['code']);
        //echo $uid.' '.$code;
        $check = mysqli_query($conn,"select * from coupon where code='$code' and status='1'") or die(mysqli_error($conn));
        if(mysqli_num_rows($check)){
            $couponInfo = mysqli_fetch_array($check);
            // $data = $couponInfo;
            $coupon = array(
                'id' => $couponInfo['id'],
                'code' => $couponInfo['code'],
                'value' => $couponInfo['discount'],
            );
            $applied = mysqli_query($conn,"select couponinfo from orders where uid='$uid' ") or die(mysqli_error($conn));
            if(mysqli_num_rows($applied)){
                $used=0;
                while($coupons = mysqli_fetch_array($applied)){
                    $coupinfo = unserialize($coupons['couponinfo']);

                    if(isset($coupinfo) && !empty($coupinfo)){
                        if($coupinfo['code']==$couponInfo['code']){
                            $used=1;
                            break;
                        }
                    }
                }

                if($used){
                    $data = array(
                        'error' => 'yes',
                        'msg' => 'Already used'
                    );
                }else{
                    $data = array(
                        'error' => 'no',
                        'code' => $couponInfo['code'],
                        'value' => $couponInfo['discount'],
                        'msg' => 'Coupon Applied'
                    );
                    $_SESSION['coupon'] = $coupon;
                }
                //echo $coupinfo;
            }else{
                $data = array(
                    'error' => 'no',
                    'code' => $couponInfo['code'],
                    'value' => $couponInfo['discount'],
                    'msg' => 'Coupon Applied'
                );
                $_SESSION['coupon'] = $coupon;
            }
        }else{
            $data = array(
                'error' => 'yes',
                'msg' => 'Invalid coupon'
            );
        }
        echo json_encode($data);
        //echo json_encode($_SESSION['coupon']);
    }
?>