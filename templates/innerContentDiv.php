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
	
		<main>
				<div class="con">
				
					<div class="article">

					<p>
					<?php
						if(!isset($komunikat))
							echo 'Strona, która pomaga kontrolować Twoje wydatki. Przeglądaj swój bilans i sprawdź czy w ostatnim czasie zaoszczędziłeś czy się zadłużyłeś.';
						else{
							echo $komunikat;
							echo "</br>";
							echo "<a href='index.php?action=showMain'><input type='button' value='OK'></a>";
						}?>
					</p>
					
					</div>
					
				</div>
		</main>