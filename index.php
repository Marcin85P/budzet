<?php
	include 'constants.php';
	spl_autoload_register('classLoader');
	session_start();

	try{
		$portal = new PortalFront("localhost", "root", "", "aplikacjaobiektowo");
		$action = 'showMain';
		
		 if (isset($_GET['action'])) {
			$action = $_GET['action'];
		 }
		 
		$komunikat = $portal->getMessage();
		
		if(($action == 'showLoginForm' || $action == 'showRegistrationForm' || $action == 'registerUser') && $portal->zalogowany){
			header('Location:index.php?action=showMain');
			return;
		}

		 switch($action){
			 case 'login' :
				switch($portal->login()){
					case ACTION_OK :
						header('Location:index.php?action=showMain');
						return;
					
					case NO_LOGIN_REQUIRED :
						header('Location:index.php?action=showMain');
						return;
						
					case ACTION_FAILED :
					
					case FORM_DATA_MISSING:
						$portal->setMessage('Błędna nazwa lub hasło użytkownika');
						break;
						
					default:
						$portal->setMessage('Błąd serwera. Zalogowanie nie jest obecnie możliwe.');
				}
			header('Location:index.php?action=showLoginForm');		
			break;
			
			case 'registerUser':
				switch($portal->registerUser()){
					case ACTION_OK:
						$_SESSION['successful_registration'] = true;
						$portal->setMessage('Rejestracja przebiegła pomyślnie, możesz się już zalogować na swoje konto!');
						header('Location:index.php?action=showLoginForm');
					return;
					
					case ACTION_FAILED:
					
					case FAILED_LENGTH:
						$portal->setMessage('Login musi posiadać od 3 do 15 znaków');
						$_SESSION['loginCheck'] = $portal->getMessage();
					break;
					
					case FAILED_LETTER:
						$portal->setMessage("Login może składać się tylko z liter i cyfr (bez polskich znaków)");
						$_SESSION['loginCheck'] = $portal->getMessage();
					break;
					
					case FAILED_PASSWORD_LENGTH:
						$portal->setMessage("Hasło musi posiadać od 6 do 20 znaków");
						$_SESSION['passwordLength'] = $portal->getMessage();
					break;
					
					case FAILED_PASSWORD_SAME:
						$portal->setMessage("Podane hasła nie są identyczne");
						$_SESSION['passwordSame'] = $portal->getMessage();
					break;
					
					case ACTION_DUPLICATE:
						$portal->setMessage("Istnieje już użytkownik o takim nicku");
						$_SESSION['loginCheck'] = $portal->getMessage();
					break;
					
					case SERVER_ERROR:
					default:
						$portal->setMessage('Błąd serwera!');
				}
			header('Location:index.php?action=showRegistrationForm');
			break;
			
			case 'addIncomes':
				switch($portal->addIncomesFunction()):
					case ACTION_OK:
						$portal->setMessage('Twój przychód został dodany.');
						header('Location:index.php?action=showIncomes');
					return;
					endswitch;
					
			header('Location:index.php?action=showIncomes');
			break;
			
			case 'addExpenses':
				switch($portal->addExpensesFunction()):
					case ACTION_OK:
						$portal->setMessage('Twój wydatek został dodany.');
						header('Location:index.php?action=showExpenses');
					return;
					endswitch;
					
			header('Location:index.php?action=showExpenses');
			break;
			
			case 'tableView':
				$_SESSION['arrayIncomes'] = $portal->tableView('incomes');
				$_SESSION['arrayExpenses'] = $portal->tableView('expenses');	
				header('Location:index.php?action=showBalance');
			break;
			
			case 'tableViewPreviousMonth':
				$_SESSION['a'] = true;
				$_SESSION['arrayIncomes'] = $portal->tableView('incomes');
				$_SESSION['arrayExpenses'] = $portal->tableView('expenses');	
				header('Location:index.php?action=showBalance');
			break;			

			case 'tableViewCurrentYear':
				$_SESSION['b'] = true;
				$_SESSION['arrayIncomes'] = $portal->tableView('incomes');
				$_SESSION['arrayExpenses'] = $portal->tableView('expenses');
				header('Location:index.php?action=showBalance');
			break;	
			
			case 'tableViewCustom':
				$_SESSION['c'] = true;
				$_SESSION['arrayIncomes'] = $portal->tableView('incomes');
				$_SESSION['arrayExpenses'] = $portal->tableView('expenses');	
				header('Location:index.php?action=showBalance');
			break;
			
			case 'settings':
				switch($portal->changePassword()):
					case ACTION_OK:
						$_SESSION['passChange'] = true;
						$portal->setMessage('Twoje hasło zostało zmienione.');
						header('Location:index.php?action=settingsView');
					return;
					
					case ACTION_FAILED:
						$portal->setMessage('Twoje hasło jest zbyt krótkie lub niepoprawne.');
						header('Location:index.php?action=settingsView');
					return;
				
					case SERVER_ERROR:
						default:
							$portal->setMessage('Błąd serwera!');
					endswitch;
				header('Location:index.php?action=settingsView');
			break;
			
			case 'editIncomeAction':
				switch($portal->editIncomesAction($_GET['idIncome'])):
					case ACTION_OK:
						header('Location:index.php?action=tableView');
					return;
				endswitch;
				
			header('Location:index.php?action=tableView');
			break;
			
			case 'editExpenseAction':
				switch($portal->editExpensesAction($_GET['idExpense'])):
					case ACTION_OK:
						header('Location:index.php?action=tableView');
					return;
				endswitch;
				
			header('Location:index.php?action=tableView');
			break;
			
			case 'addIncomesCategory':
				switch($portal->addIncomesCategory()):
					case ACTION_OK:
						$_SESSION['passChange'] = true;
						$portal->setMessage('Kategoria przychodu została dodana.');
						header('Location:index.php?action=settingsView');
					return;
					
					case FAILED_POST:
						$portal->setMessage('Nie podano kategorii.');
						header('Location:index.php?action=settingsView');
					return;
					
					case ACTION_FAILED:
						$portal->setMessage('Ta kategoria już istnieje.');
						header('Location:index.php?action=settingsView');
					return;
					
					endswitch;
			break;
			
			case 'addExpensesCategory':
				switch($portal->addExpensesCategory()):
					case ACTION_OK:
						$_SESSION['passChange'] = true;
						$portal->setMessage('Kategoria wydatku została dodana.');
						header('Location:index.php?action=settingsView');
					return;
					
					case FAILED_POST:
						$portal->setMessage('Nie podano kategorii.');
						header('Location:index.php?action=settingsView');
					return;
					
					case ACTION_FAILED:
						$portal->setMessage('Ta kategoria już istnieje.');
						header('Location:index.php?action=settingsView');
					return;
					
					endswitch;
			break;

			case 'addPaymentMethod':
				switch($portal->addPaymentMethod()):
					case ACTION_OK:
						$_SESSION['passChange'] = true;
						$portal->setMessage('Forma płatności została dodana do listy.');
						header('Location:index.php?action=settingsView');
					return;
					
					case FAILED_POST:
						$portal->setMessage('Nie podano formy płatności.');
						header('Location:index.php?action=settingsView');
					return;
					
					case ACTION_FAILED:
						$portal->setMessage('Ta forma płatności już istnieje.');
						header('Location:index.php?action=settingsView');
					return;
					
					endswitch;
			break;
			
			case 'deleteCategory':
				switch($portal->deleteIncomesCategory()):
					case ACTION_OK:
						$_SESSION['passChange'] = true;
						$portal->loadCategoryIncomes();
						include 'templates/ajaxIncomes.php';
					return;
					
					case ACTION_FAILED:
						include 'templates/ajaxIncomes.php';
					return;
					
					endswitch;
			break;
			
			case 'editIncomesCategory':
				switch($portal->editIncomesCategory()):
					case ACTION_OK:
						$_SESSION['passChange'] = true;
						$portal->loadCategoryIncomes();
						include 'templates/ajaxIncomes.php';
					return;
					
					case ACTION_FAILED:
						include 'templates/ajaxIncomes.php';
					return;
					
					endswitch;
			break;
			
			case 'editPaymentMethods':
				switch($portal->editPaymentMethods()):
					case ACTION_OK:
						$_SESSION['passChange'] = true;
						$portal->loadPaymentMethods();
						include 'templates/ajaxPayment.php';
					return;
					
					case ACTION_FAILED:
						include 'templates/ajaxPayment.php';
					return;
					
					endswitch;
			break;
			
			case 'deleteCategoryExp':
				switch($portal->deleteExpensesCategory()):
					case ACTION_OK:
						$_SESSION['passChange'] = true;
						$portal->loadCategoryExpenses();
						include 'templates/ajaxExpenses.php';
					return;
					
					case ACTION_FAILED:
						include 'templates/ajaxExpenses.php';
					return;
					
					endswitch;
			break;
			
			case 'deletePaymentMethod':
				switch($portal->deletePaymentMethod()):
					case ACTION_OK:
						$_SESSION['passChange'] = true;
						$portal->loadPaymentMethods();
						include 'templates/ajaxPayment.php';
					return;
					
					case ACTION_FAILED:
						include 'templates/ajaxPayment.php';
					return;
					
					endswitch;
			break;
			
			case 'logout':
				$portal->logout();
				header('Location:index.php?action=showLoginForm');
			break;

			default:
			include 'templates/mainTemplate.php';			
		 }
	}
	
	catch(Exception $e){
		echo 'Błąd: ' . $e->getMessage();
		exit('Portal chwilowo niedostępny');
	}
	
	function classLoader($nazwa){
		if(file_exists("class/$nazwa.php")){
			require_once("class/$nazwa.php");
		} else {
			throw new Exception("Brak pliku z definicją klasy.");
		}
	}