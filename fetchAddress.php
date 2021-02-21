<?php 
    include('connection.php');
    $data=array();
    if(isset($_POST['uid']) && !empty($_POST['uid'])){
        $uid = mysqli_real_escape_string($conn,$_POST['uid']);
        
        $userInfoQuery = mysqli_query($conn,"select * from user where uid='$uid'") or die(mysqli_error($conn));
        if(mysqli_num_rows($userInfoQuery)){
            $userInfo = mysqli_fetch_array($userInfoQuery);
            $addressQuery = mysqli_query($conn,"select * from shipping_address where uid='$uid'") or die(mysqli_error($conn));
            if(mysqli_num_rows($addressQuery)){
                $address = mysqli_fetch_array($addressQuery);
                $data = array(
                    'error' => 'no',
                    'first' => $userInfo['uname'],
                    'last' => '',
                    'phone' => $userInfo['phone'],
                    'email' => $userInfo['email'],
                    'street' => $address['street'],
                    'city' => $address['city'],
                    'state' => $address['state'],
                    'country' => $address['country'],
                    'pincode' => $address['pincode']
                );
            }else{
                $data= array(
                    'error' => 'yes',
                    'msg' => 'No saved address in your account'
                );
            }
            echo json_encode($data);
        }
    }else{
        header('location:login.php');
    }
?>