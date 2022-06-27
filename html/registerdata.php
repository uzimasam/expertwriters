<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['signup'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
        //$timestamp = #_POST['timestamp'];
		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;

		if($password != $repassword){
			$_SESSION['error'] = 'Passwords did not match';
			header('location: register');
		}
		else{
			$conn = $pdo->open();
			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM watu WHERE email=:email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'Email already taken';
				header('location: register');
			}
			else{
				$now = date('Y-m-d');
				$password = password_hash($password, PASSWORD_DEFAULT);
				//generate code
				$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code=substr(str_shuffle($set), 0, 12);

				try{
					$stmt = $conn->prepare("INSERT INTO watu (email, password, firstname, lastname, activate_code, created_on) VALUES (:email, :password, :firstname, :lastname, :code, :now)");
					$stmt->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'code'=>$code, 'now'=>$now]);
					$userid = $conn->lastInsertId();

					$message = "
						<h2>Hello ".$firstname.", Thank you for Registering.</h2>
						<p>Your Account:</p>
						<p>Email: ".$email."</p>
						<p>Please click the link below to activate your account.</p>
						<h3><a href='http://theexpertwriters.denvisbookshop.co.ke/html/activate.php?code=".$code."&user=".$userid."'>Activate Account</a></h3>
						<h4>Do not share the link above with anyone!</h4>
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
						$mail->Subject = 'Expert Writers Account Activation';
						$mail->Body    = $message;
	
						$mail->send();

						unset($_SESSION['firstname']);
				        unset($_SESSION['lastname']);
				        unset($_SESSION['email']);
	
						$_SESSION['success'] = 'Account created ;) Check your email to activate.';
				        header('location: login');
					 
					} 
					catch (Exception $e) {
						$_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				        header('location: register');
					}
				}
				catch(PDOException $e){
					$_SESSION['error'] = $e->getMessage();
					header('location: register');
				}
			}
				
			$pdo->close();


		}
	}
	else{
		$_SESSION['error'] = 'Fill up signup form first';
	}
	header('location: login');

?>