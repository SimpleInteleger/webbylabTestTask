<?php require_once('../includes/config.php');
	//if not logged in redirect to login page
	if(!$user->is_logged_in()){ header('Location: ../../../../template/index.php'); }	
?>
<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>ADMIN MENU</title>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container-fluid ">
			<div class="container-sm text-center">
				
				<p class="h1">ADMIN MENU</p>
				<div class="btn-group-vertical">
					<button type="button" class="btn btn-outline-primary"><a class="nav-link text-dark" href='films.php'>films list</a></button>
					<button type="button" class="btn btn-outline-primary"><a class="nav-link text-dark" href='import.php'>import from file</a></button>
				</div>
				
				
			</div>
		</div>
		<script src="../../../lib/js/jquery-3.5.1.min.js"></script>
		<script src="../../js/scripts.js"></script>
		<script src="../../js/bootstrap.bundle.min.js"></script>
	</body>
</html>	