<?php 
	if(!isset($portal)) die();

	if(!isset($_SESSION['zalogowany'])){
		header('Location:index.php?action=showLoginForm');
	}
?>
	<link rel="stylesheet" href="main.css" type="text/css" />
	<header>

		<nav class="page-navigation clearfix">
		
			<label class="navigation-toggle" for="input-toggle">
				<span></span>
				<span></span>
				<span></span>
			</label>
		
			<input type="checkbox" id="input-toggle">
			
			<ul class="menu">
				<li><a href='index.php?action=showIncomes'>Dodaj przychód</a></li>
				<li><a href='index.php?action=showExpenses'>Dodaj wydatek</a></li>
				<li><a href='index.php?action=tableView'>Przegląd bilansu</a></li>
				<li><a href='index.php?action=settingsView'>Ustawienia</a></li>
				<li><a href='index.php?action=logout' class="logout">Wyloguj się</a></li>	
			</ul>
				
		</nav>
	
	</header>
		
	<div class="container">
				
		<div class="article">
		<?php	

			echo "<p style='margin-top:5%'>Podaj przedział dat:<br/></p>";
			echo "<form action='index.php?action=tableViewCustom' method='post'>
				Od: <input type='date' name='custom_input_1' style='max-width:200px'></br>
				Do: <input type='date' name='custom_input_2' style='max-width:200px'><br/>
				<input type='submit' value='OK'></form><br/>";
				
				if(isset($_SESSION['e_input'])){					
					echo $_SESSION['e_input'];
					unset($_SESSION['e_input']);
				}
		?>
		</div>
		
	</div>