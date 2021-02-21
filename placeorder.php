<html>

<head>
    <script src="js/jquery3_5_1.min.js"></script>
    <style>

        #payuForm{
            display:none;
        }
    </style>
</head>

<?php 
    session_start();
    include('connection.php');
    $MERCHANT_KEY = "Uj0GBM1t";
    $SALT = "7shOTuAMmc";
    // Merchant Key and Salt as provided by Payu.

    $successUrl = 'http://localhost/ygn1/confirmation.php';
    $failureUrl = $successUrl;

    $PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
    //$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

    $action = $PAYU_BASE_URL . '/_payment';
                                                                                       //finalprice=44420
    if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
        $stamp = strtotime("now");
        $orderid = 'ORD'.$uid.$stamp;
        $orderid = str_replace(".", "", $orderid); 

        if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['street']) && isset($_POST['country']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['pincode']) && isset($_POST['finalprice']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['street']) && !empty($_POST['country']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['pincode']) && !empty($_POST['finalprice'])){
            $first = mysqli_real_escape_string($conn,$_POST['firstname']);
            $last = mysqli_real_escape_string($conn,$_POST['lastname']);
            $phone = mysqli_real_escape_string($conn,$_POST['phone']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $street = mysqli_real_escape_string($conn,$_POST['street']);
            $country = mysqli_real_escape_string($conn,$_POST['country']);
            $city = mysqli_real_escape_string($conn,$_POST['city']);
            $state = mysqli_real_escape_string($conn,$_POST['state']);
            $pincode = mysqli_real_escape_string($conn,$_POST['pincode']);
            $finalPrice = mysqli_real_escape_string($conn,$_POST['finalprice']);
            //echo $_POST['finalprice'];

            $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

            $cartitems = mysqli_query($conn,"select * from cart where user_id='$uid'") or die(mysqli_error($conn));
            
            if(mysqli_num_rows($cartitems)){
                //$product=array();
                $products = array();
                while($row=mysqli_fetch_array($cartitems)){
                    $product=array(
                        'pid' => $row['pid'],
                        'name' => $row['pname'],
                        'detail' => $row['pdetail'],
                        'quantity' => $row['quantity'],
                        'total_price' => $row['total_price']
                    );
                    $products[] = $product;
                }
            }

            $checkout = array(
                'uid' => $uid,
                'orderid' => $orderid,
                'first' => $first,
                'last' => $last,
                'phone' => $phone,
                'email' => $email,
                'street' => $street,
                'country' => $country,
                'city' => $city,
                'state' => $state,
                'pincode' => $pincode,
                'finalprice' => $finalPrice,
                'cartitems' => $products,
                'coupon' => isset($_SESSION['coupon'])? $_SESSION['coupon'] :''
            );

            $_SESSION['checkout'] = $checkout;
            //print_r($_SESSION['checkout']);

            $forpaymentinfo = array(
                'key' => $MERCHANT_KEY,
                'txnid' => $txnid,
                'firstname' => $first,
                'amount' => $finalPrice,
                'phone' => $phone,
                'email' => $email,
                'productinfo' => json_encode($products)
            );

            $hash = '';
            // Hash Sequence
            $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

            $hashVarsSeq = explode('|', $hashSequence);
            $hash_string = '';	
            foreach($hashVarsSeq as $hash_var) {
                $hash_string .= isset($forpaymentinfo[$hash_var]) ? $forpaymentinfo[$hash_var] : '';
                $hash_string .= '|';
            }

            $hash_string .= $SALT;
            //print_r($hash_string);

            $hash = strtolower(hash('sha512', $hash_string));

        }else{
            header('location:checkout.php');
        }
    }
    else{
        header('location:login.php');
    }

?>

    <form id="payuForm" action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY; ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid; ?>" />
      <table>
        <tr>
          <!-- <td><b>Mandatory Parameters</b></td> -->
        </tr>
        <tr>
          <!-- <td>Amount: </td> -->
          <td><input type="hidden" name="amount" value="<?php echo floatval($forpaymentinfo['amount']); ?>"/></td>
          <!-- <td>First Name: </td> -->
          <td><input type="hidden" name="firstname" id="firstname" value="<?php echo $forpaymentinfo['firstname'];?>"/></td>
        </tr>
        <tr>
          <!-- <td>Email: </td> -->
          <td><input type="hidden" name="email" id="email" value="<?php echo $forpaymentinfo['email']; ?>"/></td>
          <!-- <td>Phone: </td> -->
          <td><input type="hidden" name="phone" value="<?php echo $forpaymentinfo['phone']; ?>"/></td>
        </tr>
        <tr>
          <!-- <td>Product Info: </td> -->
          <td colspan="3"><textarea type="hidden" name="productinfo"><?php echo $forpaymentinfo['productinfo']; ?></textarea></td>
        </tr>
        <tr>
          <!-- <td>Success URI: </td> -->
          <td colspan="3"><input type="hidden" name="surl" value="<?php echo $successUrl; ?>" size="64" /></td>
        </tr>
        <tr>
          <!-- <td>Failure URI: </td> -->
          <td colspan="3"><input type="hidden" name="furl" value="<?php echo $failureUrl; ?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>
        <tr>
          <?php if($hash) { ?>
            <td colspan="4"><input type="submit" value="Submit" /></td>
          <?php } ?>
        </tr>
      </table>
    </form>

    <?php
        if(isset($checkout)){

            $checkoutInfo=serialize($checkout);
            $query = mysqli_query($conn,"insert into transactions values('$txnid','$checkoutInfo')") or die(mysqli_error($conn));
            if(mysqli_affected_rows($conn)){
                echo "<script type='text/javascript'>
                         $(document).ready(function(){
                             $('#payuForm').submit();
                        });
                    </script>";
            }
        }
    ?>
</html>