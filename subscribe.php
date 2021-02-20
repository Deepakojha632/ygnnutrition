<?php
	use PHPMailer\PHPMailer\PHPMailer;
	require 'vendor/autoload.php';
	include 'connection.php';

    if(isset($_POST['email']) && !empty($_POST['email'])){
        $email = strtolower($_POST['email']);

        $query = mysqli_query($conn, "SELECT * FROM newsletter where email='$email' ") or die(mysqli_error($conn));
        if(mysqli_num_rows($query)){
            echo $email.' Already Subscribed for newsletter';
        }else{

            $mail = new PHPMailer(true);
            //$mail->SMTPDebug = 4;  
            $subject = "Newsletter";
            $message = "
                Hi,<br>
                ".$email."</br>
                Thank you for subscribing to YGN Nutrition. Now you be updated to latest news from us.
                <br><br>
                Kind Regards,<br>
                YQN ";

            try {
                //Server settings
                $mail->isSMTP();                                      	// Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               	// Enable SMTP authentication
                $mail->Username = 'pratitsingh1996@gmail.com';              // SMTP username
                $mail->Password = 'Min00EEPAK';                 // SMTP password
                $mail->SMTPSecure = 'ssl';                            	// Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                    	// TCP port to connect to

                //Recipients
                $mail->setFrom('pratitsingh1996@gmail.com', 'YGN');
                $mail->addAddress($email);     							// Add a recipient ,Name is optional
                    
                // Content
                $mail->isHTML(true);                                  	// Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();
                $query = mysqli_query($conn, "insert into newsletter values('$email')") or die(mysqli_error($conn));
                if(mysqli_affected_rows($conn))
                    echo 'Subscribed';
            } catch (Exception $e) {
                echo "Message could not be sent. {$mail->ErrorInfo}";
            }
        }
    }
?>