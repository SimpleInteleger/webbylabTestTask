<?php
	
	class User {
		private $db;
		
		public function __construct($db){
			
			$this->db = $db;
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
		
	}
	
