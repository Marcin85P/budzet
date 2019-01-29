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
			
			$result = $connect->query("SELECT name FROM expenses_category_assigned_to_users WHERE user_id = $_SESSION[id]");
			
			for($i=0; $i < $result->num_rows; $i++){
				$category = mysqli_fetch_assoc($result);
				$arrayCategory[$i] = $category['name'];
			}
			
			$_SESSION['arrayCategoryExpenses'] = $arrayCategory;
			$connect->close();
		}
		
		function deleteExpensesCategory(){
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			$expensesCategory = mb_strtolower($_POST['deleteExpensesCategory'], 'UTF-8');
			$result = $connect->query("SELECT id FROM expenses_category_assigned_to_users WHERE name = '$expensesCategory' AND user_id = $_SESSION[id]");
			$array_assoc = mysqli_fetch_assoc($result);
			
			$inne = $connect->query("SELECT id FROM expenses_category_assigned_to_users WHERE name = 'inne' AND user_id = $_SESSION[id]");
			$array_inne = mysqli_fetch_assoc($inne);
			
			if($result->num_rows > 0 && $expensesCategory != 'inne'){
				$connect->query("UPDATE expenses SET expense_category_assigned_to_user_id = $array_inne[id] WHERE expense_category_assigned_to_user_id = $array_assoc[id] AND user_id = $_SESSION[id]");
				$connect->query("DELETE FROM expenses_category_assigned_to_users WHERE name = '$expensesCategory' AND user_id = $_SESSION[id]");
				return ACTION_OK;
			}
			if($expensesCategory == 'inne'){
				return ACTION_FAILED_NAME;
			}
			else{
				return ACTION_FAILED;
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
				$_SESSION['e_payment_methods'] = "Podaj sposób płatności!";
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
				$num = $result->num_rows;
				
				if($num<=0) {
					$result->close;
					$connect->query("INSERT INTO expenses_category_assigned_to_users VALUES (NULL, $_SESSION[id], '$category')");
					$result = $connect->query("SELECT id FROM expenses_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
				}
				
				$line = $result->fetch_assoc();
				
				$result->close;
				$result = $connect->query("SELECT id FROM payment_methods_assigned_to_users WHERE name = '$payment_methods' AND user_id = $_SESSION[id]");
				$num_payment = $result->num_rows;
				
				if($num_payment<=0) {
					$result->close;
					$connect->query("INSERT INTO payment_methods_assigned_to_users VALUES (NULL, $_SESSION[id], '$payment_methods')");
					$result = $connect->query("SELECT id FROM payment_methods_assigned_to_users WHERE name = '$payment_methods' AND user_id = $_SESSION[id]");
				}
				
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