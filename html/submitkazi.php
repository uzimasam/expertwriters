<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	include 'includes/session.php';
	date_default_timezone_set('Africa/Nairobi');
	$conn = $pdo->open();
	$stmt = $conn->prepare("SELECT *, MAX(id) AS numrows FROM kazi");
	$stmt->execute();
	$urow = $stmt->fetch();
	$laid = $urow['numrows'];
	$aid = $laid+1;
	$ema = 'uzimasamuel1@gmail.com';
	$meso = "
		<h2>New assingment has been submitted.</h2>
		<h3><a href='http://theexpertwriters.com/html/login'>Access Website</a></h3>
		<h4>Good time</h4>
	";
	if(isset($_POST['kazi'])){
		$cid = $user['id'];
		$firstname = $user['firstname'];
		$email = $user['email'];
		$title = $_POST['title'];
		$subject = $_POST['subject'];
		$links = $_POST['links'];
		$duetime = $_POST['duetime'];
		$notes = $_POST['notes'];
		$timeposted = date('Y-m-d');
		$total = count($_FILES['attachments']['name']);
		for( $i=0 ; $i < $total ; $i++ ) {
			$tmpFilePath = $_FILES['attachments']['tmp_name'][$i];
			if ($tmpFilePath != ""){
				$newFilePath = "docs/".$_FILES['attachments'] ['name'][$i];
				if(move_uploaded_file($tmpFilePath, $newFilePath)){
					$filename = $_FILES['attachments']['name'][$i];
					$stmt = $conn->prepare("INSERT INTO upload (aid, attachments) VALUES (:aid, :attachments)");
					$stmt->execute(['aid'=>$aid, 'attachments'=>$filename]);
				}
			}
		}

		try{
			$stmt = $conn->prepare("INSERT INTO kazi (cid, title, subject, links, duetime, timeposted, notes, status) VALUES (:cid, :title, :subject, :links, :duetime, :timeposted, :notes, :status)");
			$stmt->execute(['cid'=>$cid, 'title'=>$title, 'subject'=>$subject, 'links'=>$links, 'duetime'=>$duetime, 'timeposted'=>$timeposted, 'notes'=>$notes, 'status'=>1]);
				
			$_SESSION['success'] = 'Assingment submitted successfully;)';
					$message = "
						<h2>Hello ".$firstname.", This email is to confirm that you have uploaded your assingment under the title ".$title.".</h2>
						<h4>Thank you for choosng the expert writers!</h4>
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
						$mail->Subject = 'Expert Writers Assingment Upload';
						$mail->Body    = $message;
	
						$mail->send();
						
	
						$_SESSION['success'] = 'Assingment submitted successfully;)';
				        header('location: upload');
					 
					} 
					catch (Exception $e) {
						$_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				        header('location: upload');
					}//Load phpmailer
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
						$mail->addAddress($ema);              
						$mail->addReplyTo('expertwriters@denvisbookshop.co.ke');
					   
						//Content
						$mail->isHTML(true);                                  
						$mail->Subject = 'Expert Writers Assingment Upload';
						$mail->Body    = $meso;
	
						$mail->send();

						unset($_SESSION['firstname']);
				        unset($_SESSION['lastname']);
				        unset($_SESSION['email']);
	
						$_SESSION['success'] = 'Assingment submitted successfully;)';
				        header('location: upload');
					 
					} 
					catch (Exception $e) {
						$_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				        header('location: upload');
					}
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
	}
	else{
		$_SESSION['error'] = 'Fill up upload section first';
	}

	$pdo->close();

	header('location: upload');

?>