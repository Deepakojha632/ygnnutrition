<?php
	use PHPMailer\PHPMailer\PHPMailer;
	require 'vendor/autoload.php';
	include 'connection.php';
	
	if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["pswd"]) && isset($_POST["mobile"])){
		$email = strtolower($_POST['email']); 
		$name = $_POST['name'];
		echo $_POST['pswd'];
		$password = password_hash($_POST['pswd'], PASSWORD_BCRYPT);
		$mobile = $_POST['mobile'];

		$sql = mysqli_query($conn, "SELECT * FROM user where email='$email' ") or die( mysqli_error($conn));
		//$row = ;
		if(mysqli_num_rows($sql) > 0)
			echo 'Email id already exits';
		else{
			$sql1=mysqli_query($conn, "INSERT INTO user (uname, password, email, phone) VALUES ( '$name', '$password', '$email', '$mobile') ") or die( mysqli_error($conn));
			$id= mysqli_insert_id($conn);
			//echo $id;

			$mail = new PHPMailer(true);

			//$mail->SMTPDebug = 4;  
			$subject = $name." registration confirmation link";
			$mailmessageverification = "
				Hi,<br>
				".$name."</br>
				Click here for account verification : <a href = 'http://localhost/ygn1/verifymail.php?id=$id'> http://localhost/ygn1/verifymail.php?id=$id </a>
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
				$mail->Body    = $mailmessageverification;

				$mail->send();
				echo $name.", we've just send a verification link to your email id. check your mail for activating your account.";
			} catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				if(isset($id)){
					$delete = mysqli_query($conn, "delete FROM user where uid='$id' ") or die( mysqli_error($conn));
					if(mysqli_affected_rows($conn))
						echo 'Sudo user removed';
				}

			}
		}
	}else{
		echo 'Something went wrong';
	}
?>