<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['reset'])){
		$email = $_POST['email'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM watu WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			//generate code
			$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code=substr(str_shuffle($set), 0, 15);
			try{
				$stmt = $conn->prepare("UPDATE watu SET reset_code=:code WHERE id=:id");
				$stmt->execute(['code'=>$code, 'id'=>$row['id']]);
				
				$message = "
					<h2>Hello ".$row['firstname']." </h2>
					<h2>We received a Password Reset request for Your Account:</h2>
					<p>Email: ".$email."</p>
					<h4>Please click the link below to reset your password.</h4>
					<h3><a href='https://theexpertwriters.denvisbookshop.co.ke/html/password_reset.php?code=".$code."&user=".$row['id']."'>Reset Password</a></h3>
					<br/>
				";

				//Load phpmailer
	    		require 'vendor/autoload.php';

	    		$mail = new PHPMailer(true);                             
			    try {
			        //Server settings
			        $mail->isSMTP();                                     
			        $mail->Host = 'mail.denvisbookshop.co.ke';                      
			        $mail->SMTPAuth = true;                               
			        $mail->Username = 'expertwriters@denvisbookshop.co.ke';     
			        $mail->Password = 'uzimasamuel';                    
			        $mail->SMTPOptions = array(
			            'ssl' => array(
			            'verify_peer' => false,
			            'verify_peer_name' => false,
			            'allow_self_signed' => true
			            )
			        );                         
			        $mail->SMTPSecure = 'ssl';                           
			        $mail->Port = 465;                                   

					$mail->setFrom('expertwriters@denvisbookshop.co.ke', 'Expert Writers');
			        
			        //Recipients
			        $mail->addAddress($email);              
			        $mail->addReplyTo('expertwriters@denvisbookshop.co.ke');
			       
			        //Content
			        $mail->isHTML(true);                                  
			        $mail->Subject = 'Expert Writers Password Reset';
			        $mail->Body    = $message;

			        $mail->send();

			        $_SESSION['success'] = 'Password reset link sent. Check your email';
			     
			    } 
			    catch (Exception $e) {
			        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
			    }
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}
		else{
			$_SESSION['error'] = 'Email not found';
		}

		$pdo->close();

	}
	else{
		$_SESSION['error'] = 'Input email associated with account';
	}

	header('location: login');

?>