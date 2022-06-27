<?php
	include 'includes/asession.php';

	if(isset($_POST['subad'])){
		$subject = $_POST['subject'];

		try{
			$stmt = $conn->prepare("INSERT INTO subjects (subject) VALUES (:subject)");
			$stmt->execute(['subject'=>$subject]);

			$_SESSION['success'] = 'New Subject created';
		    header('location: subjects.php');
					 
		} 
		catch (Exception $e) {
			$_SESSION['error'] = 'Subject could not be created';
			header('location: subjects.php');
		}
	}
	else{
		$_SESSION['error'] = 'Fill up subject form first';
	}
	header('location: subjects');
				
	$pdo->close();

?>