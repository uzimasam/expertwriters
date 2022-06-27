<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	include 'includes/asession.php';
	$aid = $_POST['aid'];
	$ema = $admin['email'];
	$conn = $pdo->open();
	$stmt = $conn->prepare("SELECT * FROM kazi WHERE id=:aid");
	$stmt->execute(['aid'=>$aid]);
	$urow = $stmt->fetch();
	$title = $urow['Title'];
	$Amount = $urow['Amount'];
	$stmt = $conn->prepare("SELECT * FROM watu WHERE id=:cid");
	$stmt->execute(['cid'=>$urow['cid']]);
	$user = $stmt->fetch();
    $email = $user['email'];
    $meso = "
		<h3>Hello ".$admin['firstname']."</h3>
		<h3>You have submitted the work for assingment titled <b>".$title."</b> </h3>
		<h3>The system has requested payment amounting to ".$Amount.".00 USD  for the work done</h3>
		<h3><a href='http://theexpertwriters.com/html/login'>Access Website</a></h3>
		<h4>Good time;)</h4>
	";
	$message = "
		<h3>Hello ".$user['firstname']."</h3>
		<h3>Your assingment titled <b>".$title."is done.</b></h3>
		<h3>Login to your account to be able to pay ".$Amount.".00 USD for the job done and receive the work as soon as possible</h3>
		<h3><a href='http://theexpertwriters.com/html/login'>Access Website</a></h3>
		<h4>Good time;)</h4>
	";

	if(isset($_POST['subs'])){
		$aid = $_POST['aid'];
		$total = count($_FILES['submissions']['name']);
		

		try{
			for( $i=0 ; $i < $total ; $i++ ) {
			    $tmpFilePath = $_FILES['submissions']['tmp_name'][$i];
			    if ($tmpFilePath != ""){
    				$newFilePath = "subs/".$_FILES['submissions'] ['name'][$i];
	    			if(move_uploaded_file($tmpFilePath, $newFilePath)){
		    			$filename = $_FILES['submissions']['name'][$i];
			    		$stmt = $conn->prepare("INSERT INTO subs (aid, submissions) VALUES (:aid, :submissions)");
				    	$stmt->execute(['aid'=>$aid, 'submissions'=>$filename]);
				    }
			    }
		    }
		    $stmt = $conn->prepare("UPDATE kazi SET status=:status WHERE id=:aid");
			$stmt->execute(['status'=>3, 'aid'=>$aid]);
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
				$mail->Subject = 'Expert Writers Assingment Completed';
				$mail->Body    = $message;
	
				$mail->send();
						
					 
			} 
			catch (Exception $e) {
			    $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
			    header('location: job?key='.$aid);
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
				$mail->Subject = 'Expert Writers Job Upload';
				$mail->Body    = $meso;
	
				$mail->send();

				unset($_SESSION['firstname']);
		        unset($_SESSION['lastname']);
		        unset($_SESSION['email']);

				$_SESSION['success'] = 'Work done submitted successfully;)';
		        header('location: job?key='.$aid);
				 
			} 
			catch (Exception $e) {
				$_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
		        header('location: job?key='.$aid);
			}
			$_SESSION['success'] = 'Work done submitted successfully;)';
			header('location: job?key='.$aid);
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
	}
	else{
		$_SESSION['error'] = 'Fill up upload section first';
	}

	$pdo->close();

	header('location: job?key='.$aid);

?>