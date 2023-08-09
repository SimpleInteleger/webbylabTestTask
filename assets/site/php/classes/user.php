<?php
	
	class User {
		private $db;
		
		public function __construct($db){
			
			$this->db = $db;
		}
		
		public function SafetyEnter($string){
			$safestring = addslashes($string);
			$safestring = htmlspecialchars($safestring, ENT_QUOTES); 
			return $safestring;
		}
		
		public function is_logged_in(){
			
			if((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == true)){
				return true;
			}
			return false;
		}
		
		private function get_user_hash($name){
			
			try {
				
				$stmt = $this->db->prepare('SELECT id, name, password FROM users WHERE name = :name');
				$stmt->execute(array(':name' => $name));
				$data = $stmt->fetch();
				return $data;
				
				} catch(PDOException $e) {
				echo '<p class="error">'.$e->getMessage().'</p>';
			}
		}
		
		public function login($name,$password){
			
			$hashed = $this->get_user_hash($name);
			
			if($hashed != FALSE){
				if($password == $hashed['password']){
					
					
					$_SESSION['loggedin'] = true;
					$_SESSION['id'] = $hashed['id'];
					$_SESSION['name'] = $hashed['name'];
					return true;
				}else{
				return false;
				}
				}else{
				return false;
			}
		}
			public function CheckUser($name){
			$echo_result="";
			
			try {
				
				$stmt = $this->db->prepare('SELECT id , name , password FROM users WHERE name = :name ');
				$stmt->execute(array(':name' => $name));
				$data = $stmt->fetch();
				
				if(isset($data["name"])) {
					$echo_result="<h1>Such user already in exist</h1>";
					}else{
					$echo_result="OK";
				}
				
				} catch(PDOException $e) {
				echo '<p class="error">'.$e->getMessage().'</p>';
			}
			return $echo_result;
		}
		public function AddUser($name,$password){
			$ChU = $this->CheckUser($name);
			if ($ChU == "OK"){
				try {
					//insert into database
					$stmt = $this->db->prepare('INSERT INTO users (name, password ) VALUES (:name, :password)');
					$stmt->execute(array(
					':name' => $this->SafetyEnter($name),
					':password' => $this->SafetyEnter($password)
					));
					return true;
					} catch (PDOException $e){
					echo $e->getMessage();
				}
			}
			else
			{
				return false;
			}
		}
		
	}
	
