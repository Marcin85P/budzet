<?php if(!$this) die();?>

<form method="post" action="index.php?action=registerUser">
		
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
					<p class="word">REJESTRACJA</p>	
						
						<div class="fontel"><i class="icon-user"></i></div>
						<input type="text" name="nick" placeholder="Login" 
						value=
						"<?php
							if (isset($_SESSION['fr_nick'])) {
								echo $_SESSION['fr_nick'];
								unset($_SESSION['fr_nick']);
							}
						 ?>"/>	
						
						<?php	
							if(isset($_SESSION['loginCheck'])){
								echo "<div class='err_log'>$_SESSION[loginCheck]</div>";
								unset($_SESSION['loginCheck']);
							}
						?>
						
						<div class="fontel"><i class="icon-key"></i></div>
						<input type="password" name="pass1" placeholder="Hasło"/>
						
						<?php	
							if(isset($_SESSION['passwordLength'])){
								echo "<div class='err_log'>$_SESSION[passwordLength]</div>";
								unset($_SESSION['passwordLength']);
							}
						?>
						
						<div class="fontel"><i class="icon-key"></i></div>
						<input type="password" name="pass2" placeholder="Powtórz hasło"/>
						
						<?php	
							if(isset($_SESSION['passwordSame'])){
								echo "<div class='err_log'>$_SESSION[passwordSame]</div>";
								unset($_SESSION['passwordSame']);
							}
						?>
					
						<div class="col-12">
							<input type="submit" value="Zarejestruj">
						</div>
					
					<div class='reg'>
						<div class="button">
							<a class="tilelink" href="index.php?=showLoginForm"><i class="icon-login"></i>Logowanie</a>
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</div>
</form>