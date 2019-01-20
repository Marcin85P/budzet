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
	
	<div class="D-menu">
				
			<div id="buttonSticky">
			
				<button id="item">Ustaw</button>	
				
				<div id="submenu">
					<a href='index.php?action=settingsView'>Zmiana hasła</a>
					<a href="index.php?action=settingsCategory">Usuń kat. przych.</a>
					<a href="index.php?action=settingsCategoryExp">Usuń kat. wydatku</a>
				</div>		
					
			</div>
									
		</div>
	
	<div class="container" style="margin-top:30px">
		
	<br/>
	<br/>
	<label style="min-width: 240px; color:#79572d">Zmiana hasła:</label>

		<form method="post" action='index.php?action=settings'>
			<div class="row">			
				<div class="col-md-12 col-lg-7">
					<div id="windowSetting">				
					
						<div class="row">
							<div class="col-md-9 col-lg-8">
								<input type="password"  name="pass_o" placeholder="Podaj stare hasło"/>
								<div class="err_log">
								<?php
									if(isset($_SESSION['e_pass2'])) {
										echo $_SESSION['e_pass2'];
										unset($_SESSION['e_pass2']);
									}
								?>
								</div>
							</div>
							
							<div class="col-md-9 col-lg-8">
								<input type="password"  name="pass_n" placeholder="Podaj nowe hasło"/>
								<div class="err_log">
								<?php
									if(isset($_SESSION['e_pass'])) {
										echo $_SESSION['e_pass'];
										unset($_SESSION['e_pass']);
									}
								?>
								</div>
			
							</div>
							
							<div class="col-md-3 col-lg-4">
								<input type="submit" style="min-width:120px; margin-top:0" value="Zmień">
							</div>
						</div>
								
					</div>
				</div>
			</div>
		</form>
		
	</div>