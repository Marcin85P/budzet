<?php if(!isset($portal)) die(); ?>

<form action="index.php?action=login" method="post">
			
	<div class="container">
		<div class="row">
		
			<div class="col-12 col-md-6">
				<div class="infowin">
					<h4>Dlaczego warto kontrolować swój budżet?</h4>
					<p>Jak mawiał Dave Ramsey, jeden z autorytetów w zakresie finansów osobistych i radzenia sobie z długami: „Budżet to mówienie Twoim pieniądzom dokąd mają iść, zamiast zastanawiania się dokąd one same sobie poszły”.
					Nie jest możliwe wzbogacanie się, jeśli nie wiemy co tak naprawdę dzieje się z Naszymi pieniędzmi. Najwyższa pora zacząć kontrolować swoje wydatki...</p>
				</div>
			</div>
			
			<div class="col-12 col-md-6">
				<div class="window">
					<?php
						if(isset($_SESSION['successful_registration'])){
							echo"<div class='inf'><span font-size:13px'>$komunikat</span></div>";
						}
					?>
					<p class="word">LOGOWANIE</p>
					
					<div class="fontel"><i class="icon-user"></i></div>
						<input type="text" name="log" placeholder="Login" 
						value=
						"<?php
							if (isset($_SESSION['login'])) {
								echo $_SESSION['login'];
								unset($_SESSION['login']);
							}
						 ?>"/>
					
					<div class="fontel"><i class="icon-key"></i></div>					
						<input type="password" name="loginpassword" placeholder="Hasło"/>
					
					<?php 
					if(!isset($_SESSION['successful_registration']))
						if(isset($komunikat))
							echo "<div class='err_log'>$komunikat</div>";
						
					unset($_SESSION['successful_registration']);
					?>
					
					<div class="col-12">
						<input type="submit" value="Zaloguj">
					</div>
					
					<div class='reg'>
						Nie masz jeszcze konta?
						<div class="button">
							<a class="tilelink" href="index.php?action=showRegistrationForm"><i class="icon-user-plus"></i> Rejestracja</a>
						</div>
					</div>
								
				</div>
			</div>
			
		</div>
		
	</div>
			
</form>