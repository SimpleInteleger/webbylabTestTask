<?php require_once('../assets/site/php/includes/config.php');
?>
<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Regestration</title>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">

		<link href="../assets/site/css/style.css" rel="stylesheet" type="text/css">
		<link href="../assets/site/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	</head>
	<body>

		<div class="container-fluid  ">
			<div class="container-sm" >

				<form action="" method="post" id="reg" class="bg-black p-5 text-center rounded">
					<div class="form-floating mb-3 mt-3">

						<input type="name" class="form-control" id="name" placeholder="name" name="name" required>
						<label for="name">Name:</label>
					</div>
					<div class="form-floating mb-3 mt-3">

						<input type="password" class="form-control" id="pwd" placeholder="password" name="pwd" required>
						<label for="pwd">Password:</label>
					</div>
					<button type="submit" name="submit" class="btn btn-outline-primary btn-lg">SEND</button>
				</form>
			</div>	
		</div>



		<script src="../assets/lib/js/jquery-3.5.1.min.js"></script>
		<script src="../assets/site/js/scripts.js"></script>
		<script src="../assets/site/js/bootstrap.bundle.min.js"></script>

	</body>
</html>	
<?php


	//precess login form if submitted
	if(isset($_POST['submit'])){


		$name = $_POST['name'];
		$password = $_POST['pwd'];

		if($user->AddUser($name,$password)){


			//logged is return to index page
			header('Location: index.php');
			exit;


			} else {
			$message = '<p class="alert-warning p-2 text-center"><strong>Problem Such User already exist<strong></p>';
		}

	}//end if submit
	if (isset($message)){ echo $message; }
?>