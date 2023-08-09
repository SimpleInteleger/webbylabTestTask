<?php
	
	class Film {
		private $db;
		private $order = "АаБбВвГгДдЕеЄєЖжЗзИиІіЇїЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЬьvЮюЯяAaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789";
		public function __construct($db){
			
			$this->db = $db;
		}
		public function sortfunc($a, $b) {
		if ( strlen($a["name"]) > 1 AND strlen($b["name"]) > 1){
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
		}else return 0;	
			
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
		
		public function pagination($count,$quantiti,$page,$search){
			
			$type="";
			if($search == true) $type="&";
			else $type="?";
			$echo_data="<ul class='pagination pagination-lg justify-content-center' style='margin:20px 0'>";
			$page_big=$page;
			$page_amount=$quantiti/$count;
			$page_amount_up=round($page_amount,0,PHP_ROUND_HALF_UP);
			$page_amount_down=round($page_amount - 1 ,0,PHP_ROUND_HALF_DOWN);
			$page_start= $page_big;
			$page_amount_behind=$page_start/intval($count);
			$page_amount_behind_dec=intval($page_amount_behind)-1;
			$page_amount_behind_inc=intval($page_amount_behind)+1;
			$page_amount_front=round(abs($page_amount-$page_amount_behind),0,PHP_ROUND_HALF_DOWN);
			if ($page_amount_behind > 2) {
				$echo_data=$echo_data." <li class='page-item'><a class='page-link' href='0' >&#171;</a></li>";
			} 
			if ($page_amount_behind > 1) {
				$echo_data=$echo_data."<li class='page-item'><a class='page-link' href='".$page_amount_behind_dec."'>&#60;</a></li>";
			} 
			$echo_data=$echo_data."<li class='page-item disabled'><a class='page-link' href='".$page_amount_behind."'>$page_amount_behind</a></li>";
			if ($page_amount_front > 1) {
				$echo_data=$echo_data."<li class='page-item'><a class='page-link' href='".$page_amount_behind_inc."'>&#62;</a></li>";
			} 
			if ($page_amount_front > 2) {
				$echo_data=$echo_data."<li class='page-item'><a class='page-link' href='".$page_amount_down."'>&#187;</a></li>";
			} 
			$echo_data=$echo_data."</ul>";
			return $echo_data;
		}
		
		public function ShowFilms($count){
			$echo_result="";
			$numbers=0;
			$films=array();
			try{
				$stmt1 =  $this->db->query("SELECT id , name FROM films ORDER BY name ASC ");
				while($row1 = $stmt1->fetch()){
					$numbers = $numbers +1;	
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			try{
				$stmt =  $this->db->query("SELECT id , name FROM films ORDER BY name ASC LIMIT $count OFFSET 0 ");
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
			$echo_result=$echo_result.$this->pagination($count,$numbers,0,false);
			return $echo_result;
		}
		public function PagedShowFilms($count,$pg){
		$page = $pg*$count;
			$echo_result="";
			$numbers=0;
			$films=array();
			try{
				$stmt1 =  $this->db->query("SELECT id , name FROM films ORDER BY name ASC ");
				while($row1 = $stmt1->fetch()){
					$numbers = $numbers +1;	
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			try{
				$stmt =  $this->db->query("SELECT id , name FROM films ORDER BY name ASC LIMIT $count OFFSET $page ");
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
			$echo_result=$echo_result.$this->pagination($count,$numbers,$page,false);
			return $echo_result;
		}
		
		public function SearchFilmsbyname($name,$count){
			$echo_result="";
			$numbers=0;
			$sname=$this->SafetyEnter($name);
			$films=array();
			try{
				$stmt1 =  $this->db->query("SELECT id , name FROM films WHERE name LIKE '%".$sname."%' ORDER BY name ASC ");
				while($row1 = $stmt1->fetch()){
					$numbers = $numbers +1;	
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE name LIKE '%".$sname."%' ORDER BY name ASC LIMIT $count OFFSET 0 ");
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
			$echo_result=$echo_result.$this->pagination($count,$numbers,0,true);
			return $echo_result;
		}
		public function PagedSearchFilmsbyname($name,$count,$pg){
		$page = $pg*$count;
			$echo_result="";
			$numbers=0;
			$sname=$this->SafetyEnter($name);
			$films=array();
			try{
				$stmt1 =  $this->db->query("SELECT id , name FROM films WHERE name LIKE '%".$sname."%' ORDER BY name ASC ");
				while($row1 = $stmt1->fetch()){
					$numbers = $numbers +1;	
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE name LIKE '%".$sname."%' ORDER BY name ASC LIMIT $count OFFSET $page ");
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
			$echo_result=$echo_result.$this->pagination($count,$numbers,$page,true);
			return $echo_result;
		}
		public function SearchFilmsbyactor($actor,$count){
			$echo_result="";
			$numbers=0;
			$sactor=$this->SafetyEnter($actor);
			$films=array();
			try{
				$stmt1 =  $this->db->query("SELECT id , name FROM films WHERE actors_list LIKE '%".$sactor."%' ORDER BY name ASC ");
				while($row1 = $stmt1->fetch()){
					$numbers = $numbers +1;	
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE actors_list LIKE '%".$sactor."%' ORDER BY name ASC LIMIT $count OFFSET 0 ");
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
			$echo_result=$echo_result.$this->pagination($count,$numbers,0,true);
			return $echo_result;
		}
		public function PagedSearchFilmsbyactor($actor,$count,$pg){
		$page = $pg*$count;
			$echo_result="";
			$numbers=0;
			$sactor=$this->SafetyEnter($actor);
			$films=array();
			try{
				$stmt1 =  $this->db->query("SELECT id , name FROM films WHERE actors_list LIKE '%".$sactor."%' ORDER BY name ASC ");
				while($row1 = $stmt1->fetch()){
					$numbers = $numbers +1;	
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE actors_list LIKE '%".$sactor."%' ORDER BY name ASC LIMIT $count OFFSET $page ");
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
			$echo_result=$echo_result.$this->pagination($count,$numbers,$page,true);
			return $echo_result;
		}
		public function AdminsShowFilms($count){
			$echo_result="";
			$numbers=0;
			$films=array();
			try{
				$stmt1 =  $this->db->query("SELECT id , name FROM films ORDER BY name ASC ");
				while($row1 = $stmt1->fetch()){
					$numbers = $numbers +1;	
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films ORDER BY name ASC LIMIT $count OFFSET 0 ");
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
				$echo_result=$echo_result."<a href='films.php?delid=".$val["id"]."&delname=".$val["name"]."'  class='btn btn-danger' target='_black'>DELETE</a>";
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
			}
			$echo_result=$echo_result.$this->pagination($count,$numbers,0,false);
			return $echo_result;
		}
		public function PagedAdminsShowFilms($count,$pg){
		$page = $pg*$count;
			$echo_result="";
			$numbers=0;
			$films=array();
			try{
				$stmt1 =  $this->db->query("SELECT id , name FROM films ORDER BY name ASC ");
				while($row1 = $stmt1->fetch()){
					$numbers = $numbers +1;	
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films ORDER BY name ASC LIMIT $count OFFSET $page ");
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
				$echo_result=$echo_result."<a href='films.php?delid=".$val["id"]."&delname=".$val["name"]."'  class='btn btn-danger' target='_black'>DELETE</a>";
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
			}
			$echo_result=$echo_result.$this->pagination($count,$numbers,$page,false);
			return $echo_result;
		}
		public function AdminsSearchFilmsbyname($name,$count){
			$echo_result="";
			$numbers=0;
			$sname=$this->SafetyEnter($name);
			$films=array();
			try{
				$stmt1 =  $this->db->query("SELECT id , name FROM films WHERE name LIKE '%".$sname."%' ORDER BY name ASC ");
				while($row1 = $stmt1->fetch()){
					$numbers = $numbers +1;	
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE name LIKE '%".$sname."%' ORDER BY name ASC LIMIT $count OFFSET 0 ");
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
				$echo_result=$echo_result."<a href='films.php?delid=".$val["id"]."&delname=".$val["name"]."' class='btn btn-danger' target='_black'>DELETE</a>";
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
			}
			$echo_result=$echo_result.$this->pagination($count,$numbers,0,true);
			return $echo_result;
		}
		public function PagedAdminsSearchFilmsbyname($name,$count,$pg){
		$page = $pg*$count;
			$echo_result="";
			$numbers=0;
			$sname=$this->SafetyEnter($name);
			$films=array();
			try{
				$stmt1 =  $this->db->query("SELECT id , name FROM films WHERE name LIKE '%".$sname."%' ORDER BY name ASC ");
				while($row1 = $stmt1->fetch()){
					$numbers = $numbers +1;	
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE name LIKE '%".$sname."%' ORDER BY name ASC LIMIT $count OFFSET $page ");
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
				$echo_result=$echo_result."<a href='films.php?delid=".$val["id"]."&delname=".$val["name"]."' class='btn btn-danger' target='_black'>DELETE</a>";
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
			}
			$echo_result=$echo_result.$this->pagination($count,$numbers,$page,true);
			return $echo_result;
		}
		public function AdminsSearchFilmsbyactor($actor,$count){
			$echo_result="";
			$numbers=0;
			$sactor=$this->SafetyEnter($actor);
			$films=array();
			try{
				$stmt1 =  $this->db->query("SELECT id , name FROM films WHERE actors_list LIKE '%".$sactor."%' ORDER BY name ASC ");
				while($row1 = $stmt1->fetch()){
					$numbers = $numbers +1;	
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE actors_list LIKE '%".$sactor."%' ORDER BY name ASC LIMIT $count OFFSET 0 ");
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
				$echo_result=$echo_result."<a href='films.php?delid=".$val["id"]."&delname=".$val["name"]."' class='btn btn-danger' target='_black'>DELETE</a>";
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
			}
			$echo_result=$echo_result.$this->pagination($count,$numbers,0,true);
			return $echo_result;
		}
		public function PagedAdminsSearchFilmsbyactor($actor,$count,$pg){
		$page = $pg*$count;
			$echo_result="";
			$numbers=0;
			$sactor=$this->SafetyEnter($actor);
			$films=array();
			try{
				$stmt1 =  $this->db->query("SELECT id , name FROM films WHERE actors_list LIKE '%".$sactor."%' ORDER BY name ASC ");
				while($row1 = $stmt1->fetch()){
					$numbers = $numbers +1;	
				}
				} catch(PDOException $e) {
				echo $e->getMessage();
			}
			try{
				
				$stmt =  $this->db->query("SELECT id , name FROM films WHERE actors_list LIKE '%".$sactor."%' ORDER BY name ASC LIMIT $count OFFSET $page ");
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
				$echo_result=$echo_result."<a href='films.php?delid=".$val["id"]."&delname=".$val["name"]."' class='btn btn-danger' target='_black'>DELETE</a>";
				$echo_result=$echo_result."</div>";
				$echo_result=$echo_result."</div>";
			}
			$echo_result=$echo_result.$this->pagination($count,$numbers,$page,true);
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
			public function CheckFilm($name){
		$echo_result="";
			
			try {
				
				$stmt = $this->db->prepare('SELECT id , name , year_release , format , actors_list FROM films WHERE name = :name ');
				$stmt->execute(array(':name' => $name));
				$data = $stmt->fetch();
				
				if(isset($data["name"])) {
				$echo_result="<h1>Such Fiml already in exist</h1>";
				}else{
				$echo_result="OK";
				}
				
				} catch(PDOException $e) {
				echo '<p class="error">'.$e->getMessage().'</p>';
			}
			return $echo_result;
			}
		public function import($name){
			$myfile = fopen("../../import/".$name, "r") or die("Unable to open file!");
			// Output one line until end-of-file
			$count=0;
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
		$count=$count+1;
		$sname="";
		$year="";
		$format="";
		$actors="";
		}
		}
		
		
		}
		//unlink("../../import/".$name);
		return $count;
		}
		
		}
		
				