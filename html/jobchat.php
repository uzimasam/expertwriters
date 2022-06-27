<?php
	include 'includes/asession.php';
	
	if(isset($_POST['asschat'])){
		$subject = $_POST['message'];
		$key = $_POST['key'];
		$cid = $_POST['cid'];
		$lid = $admin['id'];
		try{
			$stmt = $conn->prepare("UPDATE chat SET chec=1 WHERE aid=:aid and level=0");
			$stmt->execute(['aid'=>$key]);
			$stmt = $conn->prepare("INSERT INTO chat (message, level, cid, aid) VALUES (:message, :level, :cid, :aid)");
			$stmt->execute(['message'=>$subject, 'level'=>$lid, 'cid'=>$cid, 'aid'=>$key]);

			$_SESSION['success'] = 'Mesage sent to client';
		    header('location: job?key='.$key);
					 
		} 
		catch (Exception $e) {
			$_SESSION['error'] = 'Message could not be sent to client';
			header('location: job?key='.$key);
		}
	}
	else{
		$_SESSION['error'] = 'Fill up chat box first';
	}
	header('location: job?key='.$key);
				
	$pdo->close();

?>