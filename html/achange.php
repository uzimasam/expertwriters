<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	include 'includes/asession.php';
	if(isset($_POST['tof'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$oldpassword = $_POST['oldpassword'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		$opassword = $admin['password'];
		if(password_verify($oldpassword, $admin['password'])){
			if($password != $repassword){
				$_SESSION['error'] = 'Passwords did not match';
				header('location: achangepassword');
			}
			else{
				$password = password_hash($password, PASSWORD_DEFAULT);
				$conn = $pdo->open();
				$stmt = $conn->prepare("UPDATE watu SET password=:password WHERE id=:id");
				$stmt->execute(['password'=>$password, 'id'=>$admin['id']]);

				$_SESSION['success'] = 'Password changed successfully';
			}
		}
		else{
			$_SESSION['error'] = 'Incorrect password';
			header('location: achangepassword');
		}
	}
	else{
		$_SESSION['error'] = 'Fill up change password form first';
		header('location: achangepassword');
	}
	$pdo->close();
	header('location: admin');

?>