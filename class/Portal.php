<?php
	class Portal
	{
		 private $dbo = null;
		 
		 function __construct($host, $db_user, $db_password, $db_name)
		 {
			$this->dbo = $this->initDB($host, $db_user, $db_password, $db_name);
		 }
		 
		 function initDB($host, $db_user, $db_password, $db_name)
		 {
			$dbo = new mysqli($host, $db_user, $db_password, $db_name);
			
			if($dbo->connect_errno){
				$msg = "Brak połączenia z bazą danych: ";
				$msg = $dbo->connect_error;
				throw new Exception($msg);
			}
			return $dbo;
		 }
	}