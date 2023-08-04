<?php require_once('../../assets/site/php/includes/config.php');
	//if not logged in redirect to login page
	if(!$user->is_logged_in()){ header('Location: ../index.php'); }	
?>
<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>FILM</title>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		
		<link href="../../assets/site/css/style.css" rel="stylesheet" type="text/css">
		<link href="../../assets/site/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container-fluid ">
			<div class="container-md text-center">
				
				
					
					<?php 	
						
							echo ($films->ShowFilm($_GET["id"]));
						
					?>
				</div>
				
				
			</div>
		</div>
		<script src="../../assets/lib/js/jquery-3.5.1.min.js"></script>
		<script src="../../assets/site/js/scripts.js"></script>
		<script src="../../assets/site/js/bootstrap.bundle.min.js"></script>
	</body>
</html>			