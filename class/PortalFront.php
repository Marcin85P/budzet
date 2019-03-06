<?php
	
	class PortalFront extends Portal
	{
		public $zalogowany = null;
		
		function __construct($host, $db_user, $db_password, $db_name)
		{
			$this->dbo = $this->initDB($host, $db_user, $db_password, $db_name);
			$this->zalogowany = $this->getActualUser();
		}
		
		function getActualUser()
		{
			if(isset($_SESSION['zalogowany'])){
				return $_SESSION['zalogowany'];
			}
			else{
				return null;
			}
		}
		
		function setMessage($komunikat)
		{
			$_SESSION['komunikat'] = $komunikat;
		}
		
		function getMessage()
		{
			if(isset($_SESSION['komunikat'])){
				$komunikat = $_SESSION['komunikat'];
				unset($_SESSION['komunikat']);
				return $komunikat;
			}
			else {
				return null;
			}
		}
		
		function login()
		{
			if(!$this->dbo) return SERVER_ERROR;
			
			if($this->zalogowany){
				return NO_LOGIN_REQUIRED;
			}
			
			if(!isset($_POST["log"]) || !isset($_POST["loginpassword"])){
				return FORM_DATA_MISSING;
			}
			
			$log = $_POST["log"];
			$pass = $_POST["loginpassword"];
			
			$_SESSION['login'] = $log;
				
			$log = htmlentities($log, ENT_QUOTES, "UTF-8");
			
			if($result = $this->dbo->query(sprintf("SELECT * FROM users WHERE username='%s'", mysqli_real_escape_string($this->dbo, $log)))) {
				$how_many_found_users = $result->num_rows;
					
					if($how_many_found_users>0){
						$line = $result->fetch_assoc();
						
						if (password_verify($pass, $line['password'])){
							$_SESSION['zalogowany'] = true;
							$_SESSION['id'] = $line['id'];
							$_SESSION['user'] = $line['username'];
							$_SESSION['password'] = $line['password'];
							return ACTION_OK;
							
						}else return FORM_DATA_MISSING;

					}else return FORM_DATA_MISSING;
				}
		}

		function logout(){
			unset($_SESSION['zalogowany']);
			$this->zalogowany = null;
		}
		
		function showRegistrationForm(){
			$reg = new Registration($this->dbo);
			return $reg->showRegistrationForm();
		}
		
		function registerUser(){
			$reg = new Registration($this->dbo);
			return $reg->registerUser();
		}
		
		function loadCategoryIncomes(){
			$load = new Incomes($this->dbo);
			return $load->loadCategory();
		}
		
		function loadCategoryExpenses(){
			$load = new Expenses($this->dbo);
			return $load->loadCategory();
		}
		
		function loadPaymentMethods(){
			$load = new Expenses($this->dbo);
			return $load->loadPaymentMethods();
		}
		
		function editIncomesAction($id){
			$edit = new Incomes($this->dbo);
			return $edit->editIncome($id);
		}
		
		function editExpensesAction($id){
			$edit = new Expenses($this->dbo);
			return $edit->editExpense($id);
		}
		
		function addIncomesCategory(){
			$add = new Incomes($this->dbo);
			return $add->addIncomesCategory();
		}
		
		function addExpensesCategory(){
			$add = new Expenses($this->dbo);
			return $add->addExpensesCategory();
		}
		
		function addPaymentMethod(){
			$add = new Expenses($this->dbo);
			return $add->addPaymentMethod();
		}
		
		function addIncomesFunction(){
			$inc = new Incomes($this->dbo);
			return $inc->addIncomesFunction();
		}
		
		function addExpensesFunction(){
			$exp = new Expenses($this->dbo);
			return $exp->addExpensesFunction();
		}
		
		function tableView($name){
			$tab = new Balance($this->dbo);
			return $tab->tableView($name);
		}
		
		function deleteIncomes($id){
			$delInc = new Incomes($this->dbo);
			return $delInc->deleteIncomes($id);
		}
		
		function deleteExpenses($id){
			$delExp = new Expenses($this->dbo);
			return $delExp->deleteExpenses($id);
		}
		
		function changePassword(){
			$settings = new Settings($this->dbo);
			return $settings->changePassword();
		}
		
		function editIncomesCategory(){
			$edit = new Incomes($this->dbo);
			return $edit->editIncomesCategory();
		}
		
		function editExpensesCategory(){
			$edit = new Expenses($this->dbo);
			return $edit->editExpensesCategory();
		}
		/*
		function setLimit(){
			$setLim = new Expenses($this->dbo);
			return $setLim->setLimit();
		}*/
		
		function editPaymentMethods(){
			$edit = new Expenses($this->dbo);
			return $edit->editPaymentMethods();
		}
		
		function deleteIncomesCategory(){
			$del = new Incomes($this->dbo);
			return $del->deleteIncomesCategory();
		}
		
		function deleteExpensesCategory(){
			$del = new Expenses($this->dbo);
			return $del->deleteExpensesCategory();
		}
		
		function deletePaymentMethod(){
			$del = new Expenses($this->dbo);
			return $del->deletePaymentMethod();
		}
	}
?>