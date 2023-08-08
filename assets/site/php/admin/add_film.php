<?php require_once('../includes/config.php');
?>
<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>add Film</title>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		<div class="container-fluid  ">
			<div class="container-sm" >
				<h1> ADD Film</h1>
				<form action="" method="post" id="add" class="bg-black p-5 text-center rounded">
				<div class="form-floating mb-3 mt-3 bg-danger" id="info_error" style="display:none";>
					<h2></h2>
					</div>
					<div class="form-floating mb-3 mt-3">
						
						<input type="name" class="form-control" id="name" placeholder="name" name="name" required>
						<label for="name">Name:</label>
					</div>
					<div >
						<label for="Year">Year:</label>
						<input type="number" placeholder="YYYY" min="1850" max="2023" class="form-control" id="year"  name="year" required>
						
					</div>
					<div >
						<label >Format:</label>
						<div class="form-check">
							<input type="radio" class="form-check-input" id="radio1" name="format" value="VHS" checked>VHS
							<label class="form-check-label" for="radio1"></label>
						</div>
						<div class="form-check">
							<input type="radio" class="form-check-input" id="radio2" name="format" value="DVD">DVD
							<label class="form-check-label" for="radio2"></label>
						</div>
						<div class="form-check">
							<input type="radio" class="form-check-input" id="radio3" name="format" value="Blu-ray">Blu-ray
							<label class="form-check-label" for="radio3"></label>
						</div>
					</div>
					<div class="mb-3 mt-3">
						<label for="comment">Actors:</label>
						<textarea class="form-control" rows="5" id="actors" name="actors" required></textarea>
					</div>
					
					<button type="submit" name="submit" class="btn btn-outline-primary btn-lg">ADD</button>
				</form>
			</div>	
			</div>
		
		
		
		<script src="../../../lib/js/jquery-3.5.1.min.js"></script>
		<script src="../../js/scripts.js"></script>
		<script src="../../js/bootstrap.bundle.min.js"></script>
		
		</body>
</html>	
<?php
	$log=false;
	
	//precess login form if submitted
	if(isset($_POST['submit'])){
		
		$films->AddFilm($_POST["name"],$_POST["year"],$_POST["format"],$_POST["actors"]);
		header('Location: films.php?added='.$_POST["name"]);
		exit;
	}
	
?>