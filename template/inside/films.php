<?php require_once('../../assets/site/php/includes/config.php');
	//if not logged in redirect to login page
	if(!$user->is_logged_in()){ header('Location: ../index.php'); }	
?>
<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>FILMS</title>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		
		<link href="../../assets/site/css/style.css" rel="stylesheet" type="text/css">
		<link href="../../assets/site/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container-fluid ">
			<div class="container-md text-center">
				
				<p class="h1">Films</p>
				<form action="films.php" class="p-2 container-sm">
					<div class="input-group p-2">
						<span class="input-group-text">Searth Name</span>
						<input type="text" class="form-control" placeholder="Username" name="sname">
					</div>
					<button type="submit" class="btn btn-outline-primary btn-lg">SEARCH BY NAME</button>
				</form>
				<form action="films.php" class="p-2 container-sm">
					<div class="input-group p-2">
						<span class="input-group-text">Searth Actor</span>
						<input type="text" class="form-control" placeholder="Username" name="sactor">
					</div>
					<button type="submit" class="btn btn-outline-primary btn-lg">SEARCH BY ACTOR</button>
				</form>
				<div class="container text-center">
					
					<?php 	
						if((isset($_GET["sname"])==False) AND (isset($_GET["sactor"])==False)){
							echo ($films->ShowFilms());
						}
						else
						{
							if(isset($_GET["sname"])){
								echo ($films->SearchFilmsbyname($_GET["sname"]));
							}
							if(isset($_GET["sactor"])){
								echo ($films->SearchFilmsbyactor($_GET["sactor"]));
							}
						}
					?>
				</div>
				
				
			</div>
		</div>
		<script src="../../assets/lib/js/jquery-3.5.1.min.js"></script>
		<script src="../../assets/site/js/scripts.js"></script>
		<script src="../../assets/site/js/bootstrap.bundle.min.js"></script>
	</body>
</html>			