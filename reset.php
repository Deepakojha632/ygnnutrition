<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
	require 'vendor/autoload.php';
    include('connection.php');
    require_once "functions.php";

    if(isset($_POST['email'])){
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        //echo $email;
        $available = mysqli_query($conn, "SELECT * FROM user where email='$email'") or die( mysqli_error($conn));
        if(mysqli_num_rows($available) > 0){
            //echo $email.' registered';

            $activated = mysqli_query($conn, "SELECT * FROM user where email='$email' and status='1'") or die( mysqli_error($conn));
            if(mysqli_num_rows($activated) > 0){
                $token = generateNewString();

                $insertToken = mysqli_query($conn,"UPDATE user SET token='$token', 
                            token_expire=DATE_ADD(NOW(), INTERVAL 20 MINUTE)
                            WHERE email='$email'") or die( mysqli_error($conn));

                if(mysqli_affected_rows($conn) > 0){
                    $user = mysqli_fetch_array($activated);
                    $name = $user['uname']; 
                    $email_id = $user['email']; 
                    $subject = $name." password reset link";

                    $mail = new PHPMailer(true);

                    $accountResetMessage = "
                        Hi,<br>
                        ".$name."<br>
                        In order to reset your password, please click on the link below within 20 minute when you received it:<br>
                        <a href='http://localhost/ygn1/reset-password.php?email=$email_id&token=$token'>
                                    http://localhost/ygn1/reset-password.php?email=$email_id&token=$token
                        </a><br><br>
                        
                        Kind Regards,<br>
                        YQN  ";

                    try {
                        //Server settings
                        $mail->isSMTP();                                      	// Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               	// Enable SMTP authentication
                        $mail->Username = 'pratitsingh1996@gmail.com';          // SMTP username
                        $mail->Password = 'Min00EEPAK';                         // SMTP password
                        $mail->SMTPSecure = 'tls';                            	// Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    	// TCP port to connect to
        
                        //Recipients
                        $mail->setFrom('pratitsingh1996@gmail.com', 'YGN');
                        $mail->addAddress($email_id);     					    // Add a recipient ,Name is optional
                            
                        // Content
                        $mail->isHTML(true);                                  	// Set email format to HTML
                        $mail->Subject = $subject;
                        $mail->Body    = $accountResetMessage;
        
                        $mail->send();
                        echo "Reset link sent to your email id.";
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
                    }
                }else{
                    echo 'Something went wrong while resetting';
                }

            }else{
                echo $email.' not activated, Please check activation mail sent to your email.';
            }

        }else{
            echo $email.' not registered';
        }
    }else{
        echo 'No email found to search';
    }
?>