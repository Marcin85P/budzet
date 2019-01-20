<?php
if(!isset($portal)) die();
?>

<!DOCTYPE html>

<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<title>Budżet</title>
		<meta name="author" content="Marcin Piwowar"/>
		
		<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
		
		<link rel="stylesheet" href="hamburgerMenu.css" type="text/css" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/fontello.css"/>
			
	</head>
	
<body>
	<div class="conteinerStyle">
	
		<div class="logo">
			<h1>Budżet osobisty</h1>
		</div>
					
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
								include 'templates/expenses.php';
							break;
							
							case 'showBalance':
								include 'templates/balanceView.php';
							break;
							
							case 'customView':
								include 'templates/custom.php';
							break;
							
							case 'settingsView':
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
	
	<footer id="footer">

		<div class="container">
		
			<div class="row">
			
				<div class="col-4">
					<div class="fb">
						<i class="icon-facebook"></i> 
					</div>
				</div>
				
				<div class="col-4">	
					<div class="yt">
						<i class="icon-youtube"></i> 
					</div>
				</div>
				
				<div class="col-4">
					<div class="tw">
						<i class="icon-twitter"></i> 
					</div>
				</div>
				
			</div>
			
		</div>
	
		<div class="info">	
			Wszelkie prawa zastrzeżone &copy <?php echo date('Y') ?>
		</div>

	</footer>
	
		<script src="jquery-3.3.1.min.js"></script>
	
	<script>

	$(document).ready(function() {
		var NavY = $('.D-menu').offset().top;
	 
	var stickyNav = function(){
		var ScrollY = $(window).scrollTop();
			  
		if (ScrollY > NavY) { 
			$('.D-menu').addClass('sticky');
		} else {
			$('.D-menu').removeClass('sticky'); 
		}
	};
	 
	stickyNav();
	 
		$(window).scroll(function() {
			stickyNav();
		});
	});
	
	</script>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>