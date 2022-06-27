<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	include 'includes/asession.php';
	$key = $_POST['key'];
	$Amount = $_POST['Amount'];
	$ema = $admin['email'];
	$conn = $pdo->open();
	$stmt = $conn->prepare("SELECT * FROM kazi WHERE id=:aid");
	$stmt->execute(['aid'=>$key]);
	$urow = $stmt->fetch();
	$title = $urow['Title'];
	$stmt = $conn->prepare("SELECT * FROM watu WHERE id=:cid");
	$stmt->execute(['cid'=>$urow['cid']]);
	$user = $stmt->fetch();
    $email = $user['email'];
    $meso = "
		<h3>Hello ".$admin['firstname']."</h3>
		<h3>You have updated the quotation for the assingment titled <b>".$title."</b> to ".$Amount.".00 USD </h3>
		<h3><a href='http://theexpertwriters.com/html/login'>Access Website</a></h3>
		<h4>Good time;)</h4>
	";
	$message = "
		<h3>Hello ".$user['firstname']."</h3>
		<h3>The quotation for your assingment titled <b>".$title.",</b></h3>
		<h3>has been updated to ".$Amount.".00 USD</h3>
		<h3><a href='http://theexpertwriters.com/html/login'>Access Website</a></h3>
		<h4>Good time;)</h4>
	";
	
	if(isset($_POST['sq'])){
		$Amount = $_POST['Amount'];
		$key = $_POST['key'];
		try{
			$stmt = $conn->prepare("UPDATE kazi SET Amount=:Amount, status=:status WHERE id=:aid");
			$stmt->execute(['Amount'=>$Amount, 'status'=>2, 'aid'=>$key]);
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
						$mail->Subject = 'Expert Writers Quotation Update';
						$mail->Body    = $message;
	
						$mail->send();
						
						$_SESSION['success'] = 'Quotation updated successfully;)';
				        header('location: job?key='.$key);
					 
					} 
					catch (Exception $e) {
						$_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				        header('location: job?key='.$key);
					}
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
						$mail->addAddress($ema);              
						$mail->addReplyTo('expertwriters@denvisbookshop.co.ke');
					   
						//Content
						$mail->isHTML(true);                                  
						$mail->Subject = 'Expert Writers Quotation Update';
						$mail->Body    = $meso;
	
						$mail->send();

						unset($_SESSION['firstname']);
				        unset($_SESSION['lastname']);
				        unset($_SESSION['email']);
	
						$_SESSION['success'] = 'Quotation updated successfully;)';
				        header('location: job?key='.$key);
					 
					} 
					catch (Exception $e) {
						$_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				        header('location: job?key='.$key);
					}
			$_SESSION['success'] = 'Quotation updated successfully';
		    header('location: job?key='.$key);
					 
		} 
		catch (Exception $e) {
			$_SESSION['error'] = 'Quotation could not be updated';
			header('location: job?key='.$key);
		}
	}
	else{
		$_SESSION['error'] = 'Fill up quotation form first';
	}
	header('location: job?key='.$key);
				
	$pdo->close();

?>