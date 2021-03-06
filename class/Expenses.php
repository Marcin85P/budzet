<?php
	class Expenses{	
		private $dbo = null;
		function __construct($dbo)
		{
			$this->dbo = $dbo;
		}
		
		function loadCategory(){
			$arrayCategory = array();
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			$result = $connect->query("SELECT name, limit_exp FROM expenses_category_assigned_to_users WHERE user_id = $_SESSION[id]");
			
			for($i=0; $i < $result->num_rows; $i++){
				$category = mysqli_fetch_assoc($result);
				$arrayCategory[$i] = $category['name'];
				$arrayLimit[$i] = $category['limit_exp'];
			}
			
			$_SESSION['arrayCategoryExpenses'] = $arrayCategory;
			$_SESSION['limit_exp'] = $arrayLimit;
		}
		
		function deleteExpenses($id){
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			$connect->query("DELETE FROM expenses WHERE id=$id");
		}
		
		function loadPaymentMethods(){
			$arrayPay = array();
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			$result = $connect->query("SELECT name_pay FROM payment_methods_assigned_to_users WHERE user_id = $_SESSION[id]");
			
			for($i=0; $i < $result->num_rows; $i++){
				$payment_methods = mysqli_fetch_assoc($result);
				$arrayPay[$i] = $payment_methods['name_pay'];
			}
			
			$_SESSION['arrayPay'] = $arrayPay;
		}
		
		function deletePaymentMethod(){
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			if(empty($_POST['valueKey'])){
				return ACTION_FAILED;
			}
			else{
				$payment_methods = mb_strtolower($_POST['valueKey'], 'UTF-8');
				$result = $connect->query("SELECT id FROM payment_methods_assigned_to_users WHERE name_pay = '$payment_methods' AND user_id = $_SESSION[id]");
				$array_assoc = mysqli_fetch_assoc($result);
				
				$cash = $connect->query("SELECT id FROM payment_methods_assigned_to_users WHERE name_pay = 'gotówka' AND user_id = $_SESSION[id]");
				$array_cash = mysqli_fetch_assoc($cash);
				
				$connect->query("UPDATE expenses SET payment_method_assigned_to_user_id = $array_cash[id] WHERE payment_method_assigned_to_user_id = $array_assoc[id] AND user_id = $_SESSION[id]");
				$connect->query("DELETE FROM payment_methods_assigned_to_users WHERE name_pay = '$payment_methods' AND user_id = $_SESSION[id]");
				return ACTION_OK;
			}
		}
		
		function editPaymentMethods(){
			if(($_POST['valueKeyPay'] != 'undefine')&&($_POST['inPay'] != '')){
				$pay = mb_strtolower($_POST['valueKeyPay'], 'UTF-8');
				$payNew = mb_strtolower($_POST['inPay'], 'UTF-8');
				$connect = $this -> dbo;
				$connect -> query ('SET NAMES utf8');
				$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
				
				$result = $connect->query("SELECT id FROM payment_methods_assigned_to_users WHERE name_pay = '$payNew' AND user_id = $_SESSION[id]");
				$num = $result->num_rows;
				
				if($num<=0){
					$connect -> query("UPDATE payment_methods_assigned_to_users SET name_pay = '$payNew' WHERE name_pay = '$pay' AND user_id = $_SESSION[id]");
					return ACTION_OK;
				}
				else{
					return ACTION_FAILED;
				}
			}
			else{
				return ACTION_FAILED;
			}
		}
		
		function setLimit(){
			$limit = $_POST['valLimit'];
			
			if(isset($limit)){
				$connect = $this -> dbo;
				$connect -> query ('SET NAMES utf8');
				$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
				$cat = mb_strtolower($_POST['inExp'], 'UTF-8');
				$connect->query("UPDATE expenses_category_assigned_to_users SET limit_exp = '$limit' WHERE name = '$cat' AND user_id = $_SESSION[id]");
			}
		}
		
		function editExpensesCategory(){
			if(($_POST['valueKeyExp'] != 'undefine')&&($_POST['inExp'] != '')){
				$cat = mb_strtolower($_POST['valueKeyExp'], 'UTF-8');
				$catNew = mb_strtolower($_POST['inExp'], 'UTF-8');
				
				$catNew = str_replace("_"," ",$catNew);
				$cat = str_replace("_"," ",$cat);
				$connect = $this -> dbo;
				$connect -> query ('SET NAMES utf8');
				$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
				
				$result = $connect->query("SELECT id FROM expenses_category_assigned_to_users WHERE name = '$catNew' AND user_id = $_SESSION[id]");
				$num = $result->num_rows;
				
				if($num<=0){
					$connect -> query("UPDATE expenses_category_assigned_to_users SET name = '$catNew' WHERE name = '$cat' AND user_id = $_SESSION[id]");
					return ACTION_OK;
				}
				else{
					return ACTION_FAILED;
				}
			}
			else{
				return ACTION_FAILED;
			}
		}
		
		function deleteExpensesCategory(){
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			if(empty($_POST['valueKey'])){
				return ACTION_FAILED;
			}
			else{
				$expensesCategory = mb_strtolower($_POST['valueKey'], 'UTF-8');
				$expensesCategory = str_replace("_"," ",$expensesCategory);
				
				$result = $connect->query("SELECT id FROM expenses_category_assigned_to_users WHERE name = '$expensesCategory' AND user_id = $_SESSION[id]");
				$array_assoc = mysqli_fetch_assoc($result);
				
				$inne = $connect->query("SELECT id FROM expenses_category_assigned_to_users WHERE name = 'inne' AND user_id = $_SESSION[id]");
				$array_inne = mysqli_fetch_assoc($inne);
				
				if($result->num_rows > 0 && $expensesCategory != 'inne'){
					$connect->query("UPDATE expenses SET expense_category_assigned_to_user_id = $array_inne[id] WHERE expense_category_assigned_to_user_id = $array_assoc[id] AND user_id = $_SESSION[id]");
					$connect->query("DELETE FROM expenses_category_assigned_to_users WHERE name = '$expensesCategory' AND user_id = $_SESSION[id]");
					return ACTION_OK;
				}
			}
		}
		
		function addExpensesCategory(){
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			if(empty($_POST['checkAddExpenses'])){
				return FAILED_POST;
			}
			else{
				$category = $_POST['checkAddExpenses'];
				
				$result = $connect->query("SELECT id FROM expenses_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
				$num = $result->num_rows;
				
				if($num<=0) {
					$result->close;
					$connect->query("INSERT INTO expenses_category_assigned_to_users VALUES (NULL, $_SESSION[id], '0', '$category')");
					$result = $connect->query("SELECT id FROM expenses_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
					
					return ACTION_OK;
				}
				else{
					return ACTION_FAILED;
				}
			}
		}
		
		function addPaymentMethod(){
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			if(empty($_POST['checkAddPayment'])){
				return FAILED_POST;
			}
			else{
				$payment_methods = $_POST['checkAddPayment'];
				
				$result = $connect->query("SELECT id FROM payment_methods_assigned_to_users WHERE name_pay = '$payment_methods' AND user_id = $_SESSION[id]");
				$num_payment = $result->num_rows;
				
				if($num_payment<=0) {
					$result->close;
					$connect->query("INSERT INTO payment_methods_assigned_to_users VALUES (NULL, $_SESSION[id], '$payment_methods')");
					$result = $connect->query("SELECT id FROM payment_methods_assigned_to_users WHERE name = '$payment_methods' AND user_id = $_SESSION[id]");
					
					return ACTION_OK;
				}
				else{
					return ACTION_FAILED;
				}
			}
		}
		
		function editExpense($id){
			$amount = $_POST['amount'];
			$date = $_POST['date'];
			$payment_methods = $_POST['payment_methods'];
			$category = $_POST['choiceExpenses'];
			$comment = $_POST['comment'];
			
			if(empty($amount)) {
				return false;
			}
			else if(!is_numeric($amount)){
				return false;
			}
			
			if(empty($date)){
				return false;
			}
			
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			if(!$this->dbo){
				return false;
			}
			else{
				$result = $connect->query("SELECT id FROM expenses_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
				$line = $result->fetch_assoc();

				$resultPay = $connect->query("SELECT id FROM payment_methods_assigned_to_users WHERE name_pay = '$payment_methods' AND user_id = $_SESSION[id]");
				$linePay = $resultPay->fetch_assoc();

				if($connect->query("UPDATE expenses SET expense_category_assigned_to_user_id = $line[id], payment_method_assigned_to_user_id = $linePay[id], amount = '$amount', date = '$date', comment = '$comment' WHERE id = '$id'")){
					return ACTION_OK;
				}
				else{
					return false;
				}
			}
		}
		
		function limitWindow(){
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			if(!$this->dbo){
				return false;
			}
			else{
				if($_POST['amount'] > 0){
					$_SESSION['amount'] = $_POST['amount'];
				}else{
					$_SESSION['amount'] = 0;
				}
				
				$_SESSION['limit'] = $_POST['limit'];
				$category = $_POST['category'];
				$dateFirst = date('Ym01');
				$dateLast = date('Ym31');
				
				$pytanie = "SELECT expenses.id, expenses.user_id, expenses.expense_category_assigned_to_user_id, expenses.amount, expenses.date, expenses_category_assigned_to_users.user_id,  expenses_category_assigned_to_users.name
						FROM expenses, expenses_category_assigned_to_users
							WHERE expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id
								AND expenses.user_id=$_SESSION[id]
								AND expenses_category_assigned_to_users.name = '$category'
								AND expenses.date 
									BETWEEN $dateFirst
									AND $dateLast";
				
				$result = $connect->query($pytanie);
				$how_result = $result->num_rows;
				
				$sumOfTheMonth = 0;
				
				for($i = 0; $i < $how_result; $i++){
					$amountQue = mysqli_fetch_assoc($result);
					$sumOfTheMonth = $sumOfTheMonth + $amountQue['amount'];
				}
				
				$_SESSION['howMuchWasSpent'] = number_format ( $sumOfTheMonth, 2, '.', '');
				$howMuchWasLeft = $_SESSION['limit'] - $sumOfTheMonth;
				
				if($howMuchWasLeft < 0){
					$_SESSION['howMuchWasLeft'] = 0;
				}else{
					$_SESSION['howMuchWasLeft'] = number_format ( $howMuchWasLeft, 2, '.', '');
				}
				
				$sumAll = $sumOfTheMonth + $_SESSION['amount'];
				$_SESSION['sumAll'] = number_format ( $sumAll, 2, '.', '');

				return ACTION_OK;
			}
		}
		
		function addExpensesFunction(){
			$amount = $_POST['amount'];
			$amount = str_replace(",",".",$amount);
			$_SESSION['amount'] = $amount;
			
			$date = $_POST['date'];
			$_SESSION['date'] = $date;
			
			$payment_methods = $_POST['payment_methods'];
			$_SESSION['payment_methods'] = $payment_methods;
			
			$category = $_POST['choiceExpenses'];
			$_SESSION['category_exp'] = $category;
			
			$comment = $_POST['comment'];
			
			if(empty($amount)) {
				$_SESSION['e_amount'] = "Podaj kwotę wydatku!";
				return false;
			}
			else if(!is_numeric($amount)){
				$_SESSION['e_amount'] = "Podana wartość musi być liczbą!";
				return false;
			}
			
			if(empty($date)){
				$_SESSION['e_date'] = "Ustaw datę wydatku!";
				return false;
			}
			
			$payment_methods = mb_strtolower($payment_methods, 'UTF-8');
			
			if(empty($payment_methods)) {
				$_SESSION['e_payment_methods'] = "Podaj formę płatności!";
				return false;
			}
			
			$category = mb_strtolower($category, 'UTF-8');
			
			if(empty($category)){
				$_SESSION['e_category'] = "Podaj kategorię wydatku!";
				return false;
			}
				
			if(empty($comment)){
				$comment = "";
			}
			
			if(!$this->dbo){
				return SERVER_ERROR;
			}
		
			else {
				$connect = $this -> dbo;
				$connect -> query ('SET NAMES utf8');
				$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
				
				$result = $connect->query("SELECT id FROM expenses_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
				
				$line = $result->fetch_assoc();
				
				$result->close;
				$result = $connect->query("SELECT id FROM payment_methods_assigned_to_users WHERE name_pay = '$payment_methods' AND user_id = $_SESSION[id]");
				
				$line_payment = $result->fetch_assoc();
				
				if ($connect->query ("INSERT INTO expenses VALUES (NULL, $_SESSION[id], $line[id], $line_payment[id], '$amount', '$date', '$comment')")) {
				
					unset($_SESSION['amount']);
					unset($_SESSION['date']);
					unset($_SESSION['payment_methods']);
					unset($_SESSION['category_exp']);
					unset($_SESSION['comment']);
					
					$result->close();					
					return ACTION_OK;
				}
				else{
					if(!$result) return SERVER_ERROR;
				}
				$connect->close();
			}
		}
	}