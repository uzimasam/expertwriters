<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	include 'includes/session.php';
	if(isset($_POST['tof'])){
		$oldpassword = $_POST['oldpassword'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		if(password_verify($oldpassword, $user['password'])){
			if($password != $repassword){
				$_SESSION['error'] = 'Passwords did not match';
				header('location: achangepassword');
			}
			else{
				$password = password_hash($password, PASSWORD_DEFAULT);
				$conn = $pdo->open();
				$stmt = $conn->prepare("UPDATE watu SET password=:password WHERE id=:id");
				$stmt->execute(['password'=>$password, 'id'=>$user['id']]);

				$_SESSION['success'] = 'Password changed successfully';
			}
		}
		else{
			$_SESSION['error'] = 'Incorrect password';
			header('location: changepassword');
		}
	}
	else{
		$_SESSION['error'] = 'Fill up change password form first';
		header('location: changepassword');
	}
	$pdo->close();
	header('location: index');

?>