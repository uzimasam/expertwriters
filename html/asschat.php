<?php
	include 'includes/session.php';
	
	if(isset($_POST['asschat'])){
		$subject = $_POST['message'];
		$key = $_POST['key'];
		$cid = $user['id'];
		try{
			$stmt = $conn->prepare("UPDATE chat SET chec=1 WHERE cid=:cid and aid=:aid and level!=0");
			$stmt->execute(['cid'=>$cid, 'aid'=>$key]);

			$_SESSION['success'] = 'Your account details have been updated successfully :)';
			$stmt = $conn->prepare("INSERT INTO chat (message, cid, aid) VALUES (:message, :cid, :aid)");
			$stmt->execute(['message'=>$subject, 'cid'=>$cid, 'aid'=>$key]);

			$_SESSION['success'] = 'Mesage sent to writer';
		    header('location: assingment?key='.$key);
					 
		} 
		catch (Exception $e) {
			$_SESSION['error'] = 'Message could not be sent to writer';
			header('location: assingment?key='.$key);
		}
	}
	else{
		$_SESSION['error'] = 'Fill up chat box first';
	}
	header('location: assingment?key='.$key);
				
	$pdo->close();

?>