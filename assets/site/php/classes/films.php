<?php
	
	class Film {
		private $db;
		
		public function __construct($db){
			
			$this->db = $db;
		}
		public function ShowFilm($id){
			$echo_result="";
			
			try {
				
				$stmt = $this->db->prepare('SELECT id , name , year_release , format , actors_list FROM films WHERE id = :id ');
				$stmt->execute(array(':id' => $id));
				$data = $stmt->fetch();
				
				$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
				$echo_result=$echo_result."<div class='card-body'>";
				$echo_result=$echo_result."<h4 class='card-title'>".$data["name"]."</h4>";
				$echo_result=$echo_result."<p class='card-text'> Actors: ".$data["actors_list"]."</p>";
				$echo_result=$echo_result."<p class='card-text'>format: ".$data["format"]."</p>";
				$echo_result=$echo_result."<p class='card-text'>Year of release: ".$data["year_release"]."</p>";
				
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
				
				} catch(PDOException $e) {
				echo '<p class="error">'.$e->getMessage().'</p>';
			}
			return $echo_result;
		}
		
		public function ShowFilms(){
			$echo_result="";
			
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films ORDER BY name ASC  ");
				while($row = $stmt->fetch()){
					
					
					$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
					$echo_result=$echo_result."<div class='card-body'>";
					$echo_result=$echo_result."<h4 class='card-title'>".$row["name"]."</h4>";
					$echo_result=$echo_result."<a href='film.php?id=".$row["id"]."' class='btn btn-primary' target='_black'>More info</a>";
					$echo_result=$echo_result."</div>";
					$echo_result=$echo_result."</div>";
					
					
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			return $echo_result;
		}
		public function SearchFilmsbyname($name){
			$echo_result="";
			$sname=addslashes($name);
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE name LIKE '%".$sname."%' ORDER BY name ASC  ");
				while($row = $stmt->fetch()){
					
					
					$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
					$echo_result=$echo_result."<div class='card-body'>";
					$echo_result=$echo_result."<h4 class='card-title'>".$row["name"]."</h4>";
					$echo_result=$echo_result."<a href='film.php?id=".$row["id"]."' class='btn btn-primary' target='_black'>More info</a>";
					$echo_result=$echo_result."</div>";
					$echo_result=$echo_result."</div>";
					
					
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			return $echo_result;
		}
		public function SearchFilmsbyactor($actor){
			$echo_result="";
			$sactor=addslashes($actor);
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE actors_list LIKE '%".$sactor."%' ORDER BY name ASC  ");
				while($row = $stmt->fetch()){
					
					
					$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
					$echo_result=$echo_result."<div class='card-body'>";
					$echo_result=$echo_result."<h4 class='card-title'>".$row["name"]."</h4>";
					$echo_result=$echo_result."<a href='film.php?id=".$row["id"]."' class='btn btn-primary' target='_black'>More info</a>";
					$echo_result=$echo_result."</div>";
					$echo_result=$echo_result."</div>";
					
					
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			return $echo_result;
		}
		public function AdminsShowFilms(){
			$echo_result="";
			
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films ORDER BY name ASC  ");
				while($row = $stmt->fetch()){
					
					
					$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
					$echo_result=$echo_result."<div class='card-body'>";
					$echo_result=$echo_result."<h4 class='card-title'>".$row["name"]."</h4>";
					$echo_result=$echo_result."<a href='films.php?delid=".$row["id"]."' class='btn btn-danger' target='_black'>DELETE</a>";
					$echo_result=$echo_result."</div>";
					$echo_result=$echo_result."</div>";
					
					
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			return $echo_result;
		}
		public function AdminsSearchFilmsbyname($name){
			$echo_result="";
			$sname=addslashes($name);
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE name LIKE '%".$sname."%' ORDER BY name ASC  ");
				while($row = $stmt->fetch()){
					
					
					$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
					$echo_result=$echo_result."<div class='card-body'>";
					$echo_result=$echo_result."<h4 class='card-title'>".$row["name"]."</h4>";
					$echo_result=$echo_result."<a href='films.php?delid=".$row["id"]."' class='btn btn-danger' target='_black'>DELETE</a>";
					$echo_result=$echo_result."</div>";
					$echo_result=$echo_result."</div>";
					
					
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			return $echo_result;
		}
		public function AdminsSearchFilmsbyactor($actor){
			$echo_result="";
			$sactor=addslashes($actor);
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE actors_list LIKE '%".$sactor."%' ORDER BY name ASC  ");
				while($row = $stmt->fetch()){
					
					
					$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
					$echo_result=$echo_result."<div class='card-body'>";
					$echo_result=$echo_result."<h4 class='card-title'>".$row["name"]."</h4>";
					$echo_result=$echo_result."<a href='films.php?delid=".$row["id"]."' class='btn btn-danger' target='_black'>DELETE</a>";
					$echo_result=$echo_result."</div>";
					$echo_result=$echo_result."</div>";
					
					
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			return $echo_result;
		}
		
		public function AddFilm($name , $year , $format , $actors){
			try {
				//insert into database
				$stmt = $this->db->prepare('INSERT INTO films (name, year_release, format , actors_list ) VALUES (:name, :year_release, :format , :actors_list)');
				$stmt->execute(array(
				':name' => $name,
				':year_release' => $year,
				':format' => $format,
				':actors_list' => $actors
				));
				
				
				
				
				} catch (PDOException $e){
				echo $e->getMessage();
			}
		}
		public function DelFilm($id){
			$stmt = $this->db->prepare('DELETE FROM films WHERE id = :id');
			$stmt->execute(array(':id' => $id));
		}
		public function import($name){
			$myfile = fopen("../../import/".$name, "r") or die("Unable to open file!");
			// Output one line until end-of-file
			
			$string="";
			$array=array();
			$arrayone=array();
			
			while(!feof($myfile)) {
				$string = fgets($myfile);
				array_push($array,$string);
				
			}
			fclose($myfile);
			$sname="";
			$year="";
			$format="";
			$actors="";
			foreach($array as $val){
				
				if(strpos($val,":")!=FALSE){
					$arrayone = explode(':',$val);
					if($arrayone[0]=="Title"){ $sname = $arrayone[1];};
					if($arrayone[0]=="Release Year") {$year = $arrayone[1];};
					if($arrayone[0]=="Format") {$format = $arrayone[1];};
					if($arrayone[0]=="Stars") {$actors = $arrayone[1];};
					//echo "$val|$sname|$year|$format|$actors</br>";
					}else{
					if($sname != "" OR $year!= "" OR $format!= "" OR $actors!= "" ){
						$this->AddFilm($sname,$year,$format,$actors);
						$sname="";
						$year="";
						$format="";
						$actors="";
					}
				}
				
				
			}
			unlink("../../import/".$name);
		}
		
	}
	
