<?php
if(!isset($portal)) die();
?>

<!DOCTYPE html>

<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<title>Budget</title>
		<meta name="author" content="Marcin Piwowar"/>
		
		<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		
		<link rel="stylesheet" href="hamburgerMenu.css" type="text/css" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/fontello.css"/>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	
	<body>

		<div class="logo">			
			<i class="icon-bank"></i>
			MyPersonalBudget
		</div>
		
		<?php if(isset($_SESSION['zalogowany'])){
			include 'templates/menu.php';
		}?>
		
		<script>
			var button = document.getElementsByClassName("menu-icon")[0];
			
			button.onclick = function() {
				document.getElementsByClassName("menuJS")[0].classList.toggle("show");
				return false;
			}
		</script>
			
		<div class="containerStyle">						
			<?php
				switch($action):
					case 'showLoginForm' :
						include 'loginForm.php';
					break;
					
					case 'showRegistrationForm':
						$portal->showRegistrationForm();
					break;
					
					case 'showIncomes':
						$_SESSION['date'] = date("Y-m-d");
						$portal->loadCategoryIncomes();
						include 'templates/incomes.php';
					break;
					
					case 'showExpenses':
						$_SESSION['date'] = date("Y-m-d");
						$portal->loadCategoryExpenses();
						$portal->loadPaymentMethods();
						include 'templates/expenses.php';
					break;
					
					case 'showBalance':
						include 'templates/balanceView.php';
					break;
					
					case 'deleteIncomes':
						$portal->deleteIncomes($_GET['idIncome']);
						header('Location:index.php?action=tableView');
					break;
					
					case 'deleteExpenses':
						$portal->deleteExpenses($_GET['idExpense']);
						header('Location:index.php?action=tableView');
					break;
					
					case 'customView':
						include 'templates/custom.php';
					break;
					
					case 'settingsView':
						$portal->loadCategoryIncomes();
						$portal->loadCategoryExpenses();
						$portal->loadPaymentMethods();
						include 'templates/settings.php';
					break;
					
					case 'settingsCategory':
						include 'templates/settingsCategoryIncomes.php';
					break;
					
					case 'settingsCategoryExp':
						include 'templates/settingsCategoryExpenses.php';
					break;
					
					case 'showMain':
					default:
						include 'templates/innerContentDiv.php';
				endswitch;
			?>
		</div>
		
		<div class="static"></div>
		
		<footer id="footer">
		
			<div class="info">	
				Wszelkie prawa zastrzeżone &copy <?php echo date('Y') ?>
			</div>

		</footer>

	<script src="jquery-3.3.1.min.js"></script>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<script src="bootstrap/js/bootstrap.min.js"></script>

	</body>

</html>