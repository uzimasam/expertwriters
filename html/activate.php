<?php include 'includes/session.php'; ?>
<?php
	$output = '';
	if(!isset($_GET['code']) OR !isset($_GET['user'])){
		$output .= '
			<div class="alert alert-danger">
                <h4><i class="icon fa fa-warning"></i> Error!</h4>
                Code to activate account not found.
            </div>
            <h4>You may <a href="register">Create New Account</a> or head to <a href="./">Homepage</a>.</h4>
		'; 
	}
	else{
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM watu WHERE activate_code=:code AND id=:id");
		$stmt->execute(['code'=>$_GET['code'], 'id'=>$_GET['user']]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			if($row['status']){
				$output .= '
					<div class="alert alert-danger">
		                <h4><i class="icon fa fa-warning"></i> Error!</h4>
		                Account already activated.
		            </div>
		            <h4>You may <a href="login">Login to your account</a> or head to <a href="./">Homepage</a>.</h4>
				';
			}
			else{
				try{
					$stmt = $conn->prepare("UPDATE watu SET status=:status WHERE id=:id");
					$stmt->execute(['status'=>1, 'id'=>$row['id']]);
					$output .= '
						<div class="alert alert-success">
			                <h4><i class="icon fa fa-check"></i> Success!</h4>
			                Account activated - Email: <b>'.$row['email'].'</b>.
			            </div>
						<h4>You may <a href="login">Login to your account</a> or head to <a href="./">Homepage</a>.</h4>
						';
				}
				catch(PDOException $e){
					$output .= '
						<div class="alert alert-danger">
			                <h4><i class="icon fa fa-warning"></i> Error!</h4>
			                '.$e->getMessage().'
			            </div>
						<h4>You may <a href="register">Create New Account</a> or head to <a href="./">Homepage</a>.</h4>
						';
				}

			}
			
		}
		else{
			$output .= '
				<div class="alert alert-danger">
	                <h4><i class="icon fa fa-warning"></i> Error!</h4>
	                Cannot activate account. Wrong code.
	            </div>
				<h4>You may <a href="register">Create New Account</a> or head to <a href="./">Homepage</a>.</h4>
				';
		}

		$pdo->close();
	}
?>
<body class="hold-transition login-page">
<div class="register-box">
  	
  	<div class="register-box-body">
		<?php
      echo $output;
    ?>
  	</div>
</div>
	
</body>
</html>