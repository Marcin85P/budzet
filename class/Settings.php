<?php
	class Settings{
		private $dbo = null;

		function __construct($dbo)
		{
			$this->dbo = $dbo;
		}
		
		function changePassword(){		
			if(!$this->dbo){
				return SERVER_ERROR;
			}
			else {
				$pass_o = $_POST['pass_o'];
				$pass_n = $_POST['pass_n'];
				
				$query = "SELECT password FROM users WHERE id = $_SESSION[id]";			
				$result = $this->dbo->query($query);
				
				$password_base = $result->fetch_assoc();
				
				$pass_base = $password_base['password'];
				
				if ((strlen($pass_n) < 6) || (strlen($pass_n) > 15)) {
					return ACTION_FAILED;
				}
				
				if (password_verify($pass_o, $pass_base)){ 
					$pass_hash_n = password_hash($pass_n, PASSWORD_DEFAULT);
					
					$this->dbo->query("UPDATE users SET password='$pass_hash_n' WHERE id=$_SESSION[id]");
					$_SESSION['update_password_successful'] = true;
					return ACTION_OK;
				}
				else{
					return ACTION_FAILED;
				}
			}					
		}
	}