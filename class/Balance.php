<?php
if(!isset($_SESSION['zalogowany'])){
	header('Location:index.php?action=showLoginForm');
}

class Balance extends BalanceData{
	private $dbo = null;

	function __construct($dbo)
	{
		$this->dbo = $dbo;
	}

	function connect(){
		$connect = $this->dbo;
		mysqli_query($connect, "SET CHARSET utf8");
		mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
		
		return $connect;
	}
	
	function setActualDate(){
		$_SESSION['last_date'] = date('Ymd');
		$_SESSION['first_day'] = date('Ym01');
		$_SESSION['score'] = '(bieżący miesiąc)';
	}
	
	function setDateY(){
		$_SESSION['last_date'] = date('Ymd');
		$_SESSION['first_day'] = date('Y0101');
		$_SESSION['score'] = "(bieżący rok)";
	}
	
	function setDateM(){
		if(date('m') == 01){
			$date = date('Y1201');
			$_SESSION['first_day'] = $date - 10000;
		}else{
			$date = date('Ym01');
			$_SESSION['first_day'] = $date - 100;
		}
		
		$date = date('Ym00');
		$_SESSION['last_date'] = $date;		
		$_SESSION['score'] = "(poprzedni miesiąc)";
	}
	
	function setDateC($firstD, $lastD){
		$_SESSION['last_date'] = str_replace('-', '', $lastD);
		$_SESSION['first_day'] = str_replace('-', '', $firstD);
		
		if((empty($_SESSION['first_day'])) || (empty($_SESSION['last_date']))) {
			$_SESSION['e_input'] = "<span style='color:red'>Ustaw datę!</span>";
			$this->setActualDate();
			unset($_SESSION['c']);
			header('Location:index.php?action=customView');
			exit();
		}
		
		if($_SESSION['first_day'] > $_SESSION['last_date']) {
			$_SESSION['first_day'] = str_replace('-', '', $lastD);
			$_SESSION['last_date'] = str_replace('-', '', $firstD);
			$_SESSION['score'] = "(od ".$lastD." do ".$firstD.")";
		}
		else{
			$_SESSION['score'] = "(od ".$firstD." do ".$lastD.")";
		}
	}
	
	function askAQuestionIncome(){
		return 
			"SELECT incomes.user_id, incomes.income_category_assigned_to_user_id, incomes.amount, incomes.date, incomes.comment,  incomes_category_assigned_to_users.user_id, incomes_category_assigned_to_users.name
					FROM incomes, incomes_category_assigned_to_users 
						WHERE incomes.income_category_assigned_to_user_id = incomes_category_assigned_to_users.id 
							AND incomes.user_id=$_SESSION[id] 
							AND incomes.date 
								BETWEEN $_SESSION[first_day] 
								AND $_SESSION[last_date]
							AND incomes.date 
								ORDER BY date DESC";
	}
	
	function askAQuestionExpense(){
		return
			"SELECT expenses.user_id, expenses.expense_category_assigned_to_user_id, expenses.payment_method_assigned_to_user_id, expenses.amount, expenses.date, expenses.comment, expenses_category_assigned_to_users.user_id,  expenses_category_assigned_to_users.name, payment_methods_assigned_to_users.user_id, payment_methods_assigned_to_users.name_pay
					FROM expenses, expenses_category_assigned_to_users, payment_methods_assigned_to_users 
						WHERE expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id
							AND expenses.payment_method_assigned_to_user_id = payment_methods_assigned_to_users.id
							AND expenses.user_id=$_SESSION[id] 
							AND expenses.date 
								BETWEEN $_SESSION[first_day] 
								AND $_SESSION[last_date]
							AND expenses.date 
								ORDER BY date DESC";
	}
	
	function sumCategory($connect, $name){	
		$suma_k = "SELECT SUM(amount) FROM $name 
			WHERE user_id = $_SESSION[id] 
			AND date BETWEEN $_SESSION[first_day] 
			AND $_SESSION[last_date]";
												
		$question = mysqli_query($connect, $suma_k);
		
		while($row = mysqli_fetch_array($question)){
			$sum_all_cat = $row['SUM(amount)'];
		}
		return $sum_all_cat;
	}

	function tableView($name){
		if(isset($_SESSION['a'])){
			$this->setDateM();
		}
		else if(isset($_SESSION['b'])){
			$this->setDateY();
		}
		else if(isset($_SESSION['c'])){
			$this->setDateC($_POST['custom_input_1'], $_POST['custom_input_2']);
		}
		else
			$this->setActualDate();
		
		if($name == 'incomes') {
			$askAQuestion = $this->askAQuestionIncome();
			$questName = 'income_category_assigned_to_user_id';
			$_SESSION['chartTitleIncomes'] = 'PRZYCHODY (%)';
		}
		else {
			$askAQuestion = $this->askAQuestionExpense();
			$questName = "expense_category_assigned_to_user_id";
			$_SESSION['chartTitleExpenses'] = 'WYDATKI (%)';
		}
		
		$connect = $this->connect();
		$result_incomes = $connect->query($askAQuestion); 
		$how_result = $result_incomes->num_rows;
		
		$category_occurrence_counter = 0;
		$category_array = [];
		$category_number = 0;
		$percentage_result = [];
		$array_number = 0;
		
		$sum_all_cat = $this->sumCategory($connect, $name);
		$object = new BalanceData(0, '', 0, '', '');

		for($i = 0; $i < $how_result; $i++){
			$array_assoc = mysqli_fetch_assoc($result_incomes);
			
			$category_t = $array_assoc['name'];
			$object->category = ucfirst($category_t);		
			$object->b_date = $array_assoc['date'];
			$object->comment = $array_assoc['comment'];
			$object->amount = $array_assoc['amount'];
			
			
			$array[$i][0] = $object->b_date;
			$array[$i][1] = $object->category;
			$array[$i][2] = $object->amount;
			$array[$i][3] = $object->comment;
			
			if($name != 'incomes'){
				$object->payment_method = $array_assoc['name_pay'];
				$array[$i][4] = $object->payment_method;
			}
			
			$arrayImplode[$i] = implode(',', $array[$i]);

			for($j=0; $j <= $i; $j++){
				if(in_array($category_t, $category_array))
					$j = $i;
				else{
					$category_array[$array_number] = $category_t;
					
						if($category_number != $array_assoc[$questName]){		
							$category_number = $array_assoc[$questName];
				
							$sumaMY = "SELECT SUM(amount) FROM $name 
								WHERE $questName = $category_number 
								AND user_id = $_SESSION[id] 
								AND date BETWEEN $_SESSION[first_day] 
								AND $_SESSION[last_date]";

							$quest = mysqli_query($connect, $sumaMY);

							while($row = mysqli_fetch_array($quest)){
								$sum_cat = $row['SUM(amount)'];
							}
							if($sum_all_cat <= 0)
								$sum_all_cat = 1;
							
							$percentage_result[$array_number] = round(($sum_cat / $sum_all_cat) * 100, 2);
						}
					$array_number++;
				}
			}
			$array_name[$i] = $category_t;
			
			if($name == 'incomes'){
				$_SESSION['percentage_resultIncomes'] = $percentage_result;
				$_SESSION['category_arrayIncomes'] = $category_array;
			}
			else{
				$_SESSION['percentage_resultExpenses'] = $percentage_result;
				$_SESSION['category_arrayExpenses'] = $category_array;
			}
		}
		$result_incomes->close();
		return $arrayImplode;
	}
}