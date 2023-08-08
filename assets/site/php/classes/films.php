<?php
	
	class Film {
		private $db;
		private $order = "АаБбВвГгДдЕеЄєЖжЗзИиІіЇїЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЬьvЮюЯяAaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789";
		public function __construct($db){
			
			$this->db = $db;
		}
		public function sortfunc($a, $b) {
			if (strpos($this->order,$a["name"][1]) AND strpos($this->order,$b["name"][1])) {
				if ( strpos($this->order,$a["name"][1]) == strpos($this->order,$b["name"][1])){
					if (strpos($this->order,$a["name"][2]) AND strpos($this->order,$b["name"][2])) {
						if ( strpos($this->order,$a["name"][2]) == strpos($this->order,$b["name"][2])){
							if (strpos($this->order,$a["name"][3]) AND strpos($this->order,$b["name"][3])) {
								if ( strpos($this->order,$a["name"][3]) == strpos($this->order,$b["name"][3])){
									return 0;
								}
								else{
								return (strpos($this->order,$a["name"][3]) < strpos($this->order,$b["name"][3])) ? -1 : 1;}
								}else{
								if(strpos($this->order,$a["name"][3])) return -1;
								else if (strpos($this->order,$b["name"][3])) return 1;
								else return 0;
							}
						}
						else{
						return (strpos($this->order,$a["name"][2]) < strpos($this->order,$b["name"][2])) ? -1 : 1;}
						}else{
						if(strpos($this->order,$a["name"][2])) return -1;
						else if (strpos($this->order,$b["name"][2])) return 1;
						else return 0;
					}
					
				}
				else{
				return (strpos($this->order,$a["name"][1]) < strpos($this->order,$b["name"][1])) ? -1 : 1;}
				}else{
				if(strpos($this->order,$a["name"][1])) return -1;
				else if (strpos($this->order,$b["name"][1])) return 1;
				else return 0;
			}
			
			
		}
		public function SafetyEnter($string){
			$safestring = addslashes($string);
			$safestring = htmlspecialchars($safestring, ENT_QUOTES); 
			return $safestring;
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
			
			$films=array();
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films ORDER BY name ASC  ");
				while($row = $stmt->fetch()){
					array_push($films,$row);
					
					
					
					
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			uasort($films, array($this, 'sortfunc'));
			
			foreach($films as $val){
				$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
				$echo_result=$echo_result."<div class='card-body'>";
				$echo_result=$echo_result."<h4 class='card-title'>".$val["name"]."</h4>";
				$echo_result=$echo_result."<a href='film.php?id=".$val["id"]."' class='btn btn-primary' target='_black'>More info</a>";
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
			}
			return $echo_result;
		}
		public function SearchFilmsbyname($name){
			$echo_result="";
			$sname=$this->SafetyEnter($name);
			$films=array();
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE name LIKE '%".$sname."%' ORDER BY name ASC  ");
				while($row = $stmt->fetch()){
					array_push($films,$row);
					
					
					
					
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			uasort($films, array($this, 'sortfunc'));
			
			foreach($films as $val){
				$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
				$echo_result=$echo_result."<div class='card-body'>";
				$echo_result=$echo_result."<h4 class='card-title'>".$val["name"]."</h4>";
				$echo_result=$echo_result."<a href='film.php?id=".$val["id"]."' class='btn btn-primary' target='_black'>More info</a>";
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
			}
			return $echo_result;
		}
		public function SearchFilmsbyactor($actor){
			$echo_result="";
			$sactor=$this->SafetyEnter($actor);
			$films=array();
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE actors_list LIKE '%".$sactor."%' ORDER BY name ASC  ");
				while($row = $stmt->fetch()){
					array_push($films,$row);
					
					
					
					
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			uasort($films, array($this, 'sortfunc'));
			
			foreach($films as $val){
				$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
				$echo_result=$echo_result."<div class='card-body'>";
				$echo_result=$echo_result."<h4 class='card-title'>".$val["name"]."</h4>";
				$echo_result=$echo_result."<a href='film.php?id=".$val["id"]."' class='btn btn-primary' target='_black'>More info</a>";
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
			}
			return $echo_result;
		}
		public function AdminsShowFilms(){
			$echo_result="";
			
			$films=array();
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films ORDER BY name ASC  ");
				while($row = $stmt->fetch()){
					array_push($films,$row);
					
					
					
					
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			uasort($films, array($this, 'sortfunc'));
			
			foreach($films as $val){
				$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
				$echo_result=$echo_result."<div class='card-body'>";
				$echo_result=$echo_result."<h4 class='card-title'>".$val["name"]."</h4>";
				$echo_result=$echo_result."<a href='films.php?delid=".$val["id"]."' class='btn btn-danger' target='_black'>DELETE</a>";
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
			}
			return $echo_result;
		}
		public function AdminsSearchFilmsbyname($name){
			$echo_result="";
			$sname=$this->SafetyEnter($name);
			$films=array();
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE name LIKE '%".$sname."%' ORDER BY name ASC  ");
				while($row = $stmt->fetch()){
					array_push($films,$row);
					
					
					
					
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			uasort($films, array($this, 'sortfunc'));
			
			foreach($films as $val){
				$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
				$echo_result=$echo_result."<div class='card-body'>";
				$echo_result=$echo_result."<h4 class='card-title'>".$val["name"]."</h4>";
				$echo_result=$echo_result."<a href='films.php?delid=".$val["id"]."' class='btn btn-danger' target='_black'>DELETE</a>";
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
			}
			return $echo_result;
		}
		public function AdminsSearchFilmsbyactor($actor){
			$echo_result="";
			$sactor=$this->SafetyEnter($actor);
			$films=array();
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE actors_list LIKE '%".$sactor."%' ORDER BY name ASC  ");
				while($row = $stmt->fetch()){
					array_push($films,$row);
					
					
					
					
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			uasort($films, array($this, 'sortfunc'));
			
			foreach($films as $val){
				$echo_result=$echo_result."<div class='card d-inline-block w-100' style='width:400px'>";
				$echo_result=$echo_result."<div class='card-body'>";
				$echo_result=$echo_result."<h4 class='card-title'>".$val["name"]."</h4>";
				$echo_result=$echo_result."<a href='films.php?delid=".$val["id"]."' class='btn btn-danger' target='_black'>DELETE</a>";
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
			}
			return $echo_result;
		}
		
		public function AddFilm($name , $year , $format , $actors){
			try {
				//insert into database
				$stmt = $this->db->prepare('INSERT INTO films (name, year_release, format , actors_list ) VALUES (:name, :year_release, :format , :actors_list)');
				$stmt->execute(array(
				':name' => $this->SafetyEnter($name),
				':year_release' => $year,
				':format' => $format,
				':actors_list' => $this->SafetyEnter($actors)
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
		
				