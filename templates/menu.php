<?php 
	if(!isset($portal)) die();

	if(!isset($_SESSION['zalogowany'])){
		header('Location:index.php?action=showLoginForm');
	}
?>

<nav>
	<div class='colorMenu'>
		<div id='menu'>
			<a href='#' class='menu-icon'><i class='fa fa-bars'></i></a>
			<ul class='menuJS'>
				<li><a class='home' href='index.php?action=showMain'><div></div><i class='icon-home'></i></a></li>
				<li><a href='index.php?action=showIncomes'><i class='icon-money'></i> Dodaj przychód</a></li>
				<li><a href='index.php?action=showExpenses'><i class='icon-credit-card'></i> Dodaj wydatek</a></li>
				<li><a href='index.php?action=tableView'><i class='icon-chart-pie'></i> Przegląd bilansu</a></li>
				<li><a href='index.php?action=settingsView'><i class='icon-cog-alt'></i> Ustawienia</a></li>
				<li><a class='out' href='index.php?action=logout'><i class='icon-logout'></i> Wyloguj</a></li>
			</ul>
		</div>
		<div class='loginM'><i class='icon-user'></i> <?php echo $_SESSION['user']; ?></div>
		<div style='clear: both;'></div>
	</div>
</nav>