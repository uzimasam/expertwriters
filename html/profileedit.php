<?php
	include 'includes/session.php';

	$conn = $pdo->open();

	if(isset($_POST['edit'])){
		$email = $_POST['email'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$photo = $_POST['photo'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$filename);	
		}
		else{
			$filename = $user['photo'];
		}

		try{
			$stmt = $conn->prepare("UPDATE watu SET email=:email, firstname=:firstname, lastname=:lastname, photo=:photo WHERE id=:id");
			$stmt->execute(['email'=>$email, 'firstname'=>$firstname, 'lastname'=>$lastname, 'photo'=>$filename, 'id'=>$user['id']]);

			$_SESSION['success'] = 'Your account details have been updated successfully :)';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	$pdo->close();

	header('location: profile');

?>