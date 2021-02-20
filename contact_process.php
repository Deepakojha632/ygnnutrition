<?php
	session_start();
    use PHPMailer\PHPMailer\PHPMailer;
	require 'vendor/autoload.php';
    include('connection.php');
	
	$response = array();

	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])){

		//$to = "18352020@pondiuni.ac.in";
		$from = mysqli_real_escape_string($conn,$_POST['email']);
		$name = mysqli_real_escape_string($conn,$_POST['name']);
		$subject = mysqli_real_escape_string($conn,$_POST['subject']);
		$message = mysqli_real_escape_string($conn,$_POST['message']);

		$mail = new PHPMailer(true);

		$msg = "<strong>
				Name  :- ".$name."<br>
				Email  :- ".$from."<br>
				Subject  :- ".$subject."<br>
				Message  :- ".$message."<br></strong>";

		try {
			//Server settings
			$mail->isSMTP();                                      	// Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               	// Enable SMTP authentication
			$mail->Username = 'pratitsingh1996@gmail.com';          // SMTP username
			$mail->Password = 'Min00EEPAK';                 		// SMTP password
			$mail->SMTPSecure = 'tls';                            	// Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    	// TCP port to connect to

			//Recipients
			$mail->setFrom($from, 'YGN');
			$mail->addAddress('pratitsingh1996@gmail.com');     	// Add a recipient ,Name is optional

			// Content
			$mail->isHTML(true);                                  	// Set email format to HTML
			$mail->Subject = 'New query from ygnutrition';
			$mail->Body    = $msg;

			$mail->send();
			$query = mysqli_query($conn,"insert into contact_us(name,email,subject,message) values('$name','$from','$subject','$message')") or die(mysqli_error($conn));
			if(mysqli_affected_rows($conn)){
				$response= array(
					'error' => "no",
					'msg'=>"Email sent successfully."
				);
			}else{
				$response= array(
					'error' => "yes",
					'msg'=>"Something went wrong."
				);
			}
		} catch (Exception $e) {
			$response= array(
				'error' => "no",
				'msg' => "Email not sent."
			); 
		}
		echo json_encode($response);
	}
?>