<?php require_once('../../assets/site/php/includes/config.php');
	//if not logged in redirect to login page
	if(!$user->is_logged_in()){ header('Location: ../index.php'); }	
?>
<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>MENU</title>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		
		<link href="../../assets/site/css/style.css" rel="stylesheet" type="text/css">
		<link href="../../assets/site/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container-fluid ">
			<div class="container-sm text-center">
				
				<p class="h1">Menu</p>
				<div class="btn-group-vertical">
					<button type="button" class="btn btn-outline-primary"><a class="nav-link text-dark" href='films.php'>films</a></button>
					<button type="button" class="btn btn-outline-primary"><a class="nav-link text-dark" href='../../assets/site/php/admin/index.php'>admin</a></button>
				</div>
				
				
			</div>
		</div>
		<script src="../../assets/lib/js/jquery-3.5.1.min.js"></script>
		<script src="../../assets/site/js/scripts.js"></script>
		<script src="../../assets/site/js/bootstrap.bundle.min.js"></script>
	</body>
</html>	