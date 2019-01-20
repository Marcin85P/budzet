<?php
	class Registration
	{
		private $dbo = null;

		function __construct($dbo)
		{
			$this->dbo = $dbo;
		}
		
		function showRegistrationForm()
		{
			include 'templates/registrationForm.php';
		}
		
		function registerUser()
		{
			$nick = $_POST['nick'];
			$password = $_POST['pass1'];
			
			$_SESSION['fr_nick'] = $nick;
			
			if ((strlen($nick)<3) || (strlen($nick)>20)) {
				$_SESSION['e_nick'] = "Login musi posiadać od 3 do 20 znaków!";
				return false;
			}
			
			if (ctype_alnum($nick) == false || preg_match('@[ęóąśłżźćńĘÓĄŚŁŻŹĆŃ]@', $nick)) {
				$_SESSION['e_nick'] = "Login może składać się tylko z liter i cyfr (bez polskich znaków)";
				return false;
			}
		
			$pass1 = $_POST['pass1'];
			$pass2 = $_POST['pass2'];
			
			if ((strlen($pass1) < 6) || (strlen($pass1) > 20)) {
				$_SESSION['e_pass'] = "Hasło musi posiadać od 6 do 20 znaków!";
				return false;
			}
			
			if ($pass1 != $pass2) {
				$_SESSION['e_pass2'] = "Podane hasła nie są identyczne!";
				return false;
			}
			
			$password = $pass1;
			
			$pass_hash = password_hash($password, PASSWORD_DEFAULT);
				
			if(!$this->dbo){
				return SERVER_ERROR;
			}
			else {
				
				$result = $this->dbo->query("SELECT id FROM users WHERE username='$nick'");
				
				if(!$result) return SERVER_ERROR;
				
				$how_many_found_nick = $result->num_rows;
				
				if ($how_many_found_nick > 0) {
					$_SESSION['e_nick'] = "Istnieje już użytkownik o takim nicku! Wybierz inny.";
					return false;
				}
					
				if ($result = $this->dbo->query("INSERT INTO users VALUES (NULL, '$nick', '$pass_hash')")) {
					
					$result = $this->dbo->query("SELECT id FROM users WHERE username='$nick'");
					$line = $result->fetch_assoc();
					$id_user = $line['id'];
					$result->close();
					
					$this->dbo->query("INSERT INTO expenses_category_assigned_to_users (id, user_id, name) SELECT NULL, '$id_user', expenses_category_default.name FROM expenses_category_default");					
					$this->dbo->query("INSERT INTO incomes_category_assigned_to_users (id, user_id, name) SELECT NULL, '$id_user', incomes_category_default.name FROM incomes_category_default");						
					$this->dbo->query("INSERT INTO payment_methods_assigned_to_users (id, user_id, name) SELECT NULL, '$id_user' , payment_methods_default.name FROM payment_methods_default");
					
					unset($_SESSION['fr_nick']);
					return ACTION_OK;
				}
				else {
					if(!$result) return SERVER_ERROR;
				}
			}		

		}
	}