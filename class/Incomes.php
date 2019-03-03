<?php

class Incomes{
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
			
			$result = $connect->query("SELECT name FROM incomes_category_assigned_to_users WHERE user_id = $_SESSION[id]");
			
			for($i=0; $i < $result->num_rows; $i++){
				$category = mysqli_fetch_assoc($result);
				$arrayCategory[$i] = $category['name'];
			}
			
			$_SESSION['arrayCategoryIncomes'] = $arrayCategory;
		}
		
		function deleteIncomesCategory(){
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			if(empty($_POST['valueKey'])){
				return ACTION_FAILED;
			}
			else{
				$incomesCategory = mb_strtolower($_POST['valueKey'], 'UTF-8');
				$result = $connect->query("SELECT id FROM incomes_category_assigned_to_users WHERE name = '$incomesCategory' AND user_id = $_SESSION[id]");
				$array_assoc = mysqli_fetch_assoc($result);
				
				$inne = $connect->query("SELECT id FROM incomes_category_assigned_to_users WHERE name = 'inne' AND user_id = $_SESSION[id]");
				$array_inne = mysqli_fetch_assoc($inne);
				
				if($result->num_rows > 0 && $incomesCategory != 'inne'){
					$connect->query("UPDATE incomes SET income_category_assigned_to_user_id = $array_inne[id] WHERE income_category_assigned_to_user_id = $array_assoc[id] AND user_id = $_SESSION[id]");
					$connect->query("DELETE FROM incomes_category_assigned_to_users WHERE name = '$incomesCategory' AND user_id = $_SESSION[id]");
					return ACTION_OK;
				}
			}
		}
		
		function deleteIncomes($id){
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			$connect->query("DELETE FROM incomes WHERE id=$id");
		}
		
		function addIncomesCategory(){
			$connect = $this -> dbo;
			$connect -> query ('SET NAMES utf8');
			$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
			
			if(empty($_POST['checkAddIncomes'])){
				return FAILED_POST;
			}
			else{
				$category = $_POST['checkAddIncomes'];
				
				$result = $connect->query("SELECT id FROM incomes_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
				$num = $result->num_rows;
				
				if($num<=0) {
					$result->close;
					$connect->query("INSERT INTO incomes_category_assigned_to_users VALUES (NULL, $_SESSION[id], '$category')");
					$result = $connect->query("SELECT id FROM incomes_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
					
					return ACTION_OK;
				}
				else{
					return ACTION_FAILED;
				}
			}
		}
		
		function editIncome($id){
			$amount = $_POST['amount'];
			$date = $_POST['date'];
			$category = $_POST['choiceIncomes'];
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
				$result = $connect->query("SELECT id FROM incomes_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
				
				$line = $result->fetch_assoc();

				if($connect->query("UPDATE incomes SET income_category_assigned_to_user_id = $line[id], amount = '$amount', date = '$date', comment = '$comment' WHERE id = '$id'")){
					return ACTION_OK;
				}
				else{
					return false;
				}
			}
		}

		function addIncomesFunction(){
			$amount = $_POST['amount'];
			$amount = str_replace(",",".",$amount);
			$_SESSION['amount'] = $amount;
			
			$date = $_POST['date'];
			$_SESSION['date'] = $date;
			
			$category = $_POST['choiceIncomes'];
			$_SESSION['category'] = $category;
			
			$comment = $_POST['comment'];
			
			if(empty($amount)) {
				$_SESSION['e_amount'] = "Podaj kwotę przychodu!";
				return false;
			}
			else if(!is_numeric($amount)){
				$_SESSION['e_amount'] = "Podana wartość musi być liczbą!";
				return false;
			}
			
			if(empty($date)){
				$_SESSION['e_date'] = "Ustaw datę przychodu!";
				return false;
			}
			
			$category = mb_strtolower($category, 'UTF-8');
			
			if(empty($category)){
				$_SESSION['e_category'] = "Podaj kategorię przychodu!";
				return false;
			}
			
			if(empty($comment)){
				$comment = "";
			}
			
			if(!$this->dbo){
				return false;
			}
			
			else {
				$connect = $this -> dbo;
				$connect -> query ('SET NAMES utf8');
				$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
				
				$result = $connect->query("SELECT id FROM incomes_category_assigned_to_users WHERE name = '$category' AND user_id = $_SESSION[id]");
				
				$line = $result->fetch_assoc();
				
				if ($connect->query ("INSERT INTO incomes VALUES (NULL, $_SESSION[id], $line[id], '$amount', '$date', '$comment')")) {

					unset($_SESSION['amount']);
					unset($_SESSION['date']);
					unset($_SESSION['category']);
					unset($_SESSION['comment']);
					
					$result->close();
					return ACTION_OK;
				}
				else {
					if(!$result) return false;
				}				
				$connect->close();
			}			
		}
	}
	
?>