<?php require_once('../includes/config.php');
?>
<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Import From File</title>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		<div class="container-fluid  ">
			<div class="container-sm" >
				<h1> IMPORT</h1>
				<form action="" method="post" id="login" class="bg-black p-5 text-center rounded" enctype="multipart/form-data">
					
					<div class="mb-3">
  <label for="formFile" class="form-label">Choose file</label>
  <input class="form-control" type="file" name="file" id="formFile">
</div>
					
					<button type="submit" name="submit" class="btn btn-outline-primary btn-lg">IMPORT</button>
				</form>
			</div>	
			</div>
		
		
		
		<script src="../../../lib/js/jquery-3.5.1.min.js"></script>
		<script src="../../js/scripts.js"></script>
		<script src="../../js/bootstrap.bundle.min.js"></script>
		
		</body>
</html>	
<?php
	
	
	//precess login form if submitted
	if(isset($_POST['submit'])){
		
		if ($_FILES['file']["name"] != ""){
			
			
			
			
			//unlink($tmp_path . $name);
			
			$target_dir = "../../import/";
			$target_file = $target_dir . basename($_FILES["file"]["name"]);
			$uploadOk = 1;
			$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$target_file_new = $target_dir . $_FILES["file"]["name"]; 
				
			
			
			// Check if file already exists
			
			if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}
			
			
			
			// Allow certain file formats
			if($FileType != "txt"  ) {
				echo "Sorry, only TXT files are allowed.";
				$uploadOk = 0;
			}
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file_new)) {
					echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
					} else {
					echo "Sorry, there was an error uploading your file.";
				}
			
			}
				
			
			$films->import($_FILES["file"]["name"]);
			
			}else{
			
			echo "file not exist";
			}
	}
	
?>