<?php if(!isset($portal)) die(); ?>

<link rel="stylesheet" href="style.css" type="text/css" />

<form action="index.php?action=login" method="post">
			<div id="window">
			
			<?php
				if(isset($_SESSION['successful_registration'])){
					echo"<div class='reg'>
								<span style='color:green; font-size:14px'>$komunikat</span>
							</div>";
				}
			?>

				<div class="row1">
					<div class="col-12">
						<p class="word">LOGOWANIE</p>
					</div>
					<div class="col-12">
						<input type="text" name="log" placeholder="Login" 
						value=
							"<?php
								if (isset($_SESSION['login'])) {
									echo $_SESSION['login'];
									unset($_SESSION['login']);
								}
							 ?>"/>
					</div>
						
					<div class="col-12">
						<input type="password" name="loginpassword" placeholder="Hasło"/>
					</div>
				</div>
				
				<?php 
				if(!isset($_SESSION['successful_registration']))
					if(isset($komunikat))
						echo "<div class='err_log'>$komunikat</div>";
					
				unset($_SESSION['successful_registration']);
				?>
				
				<div class="row1">
					<div class="col-12">
						<input type="submit" value="Zaloguj">
					</div>
				</div>

				<div class='reg'>
						<h6>Nie masz jeszcze konta?</h6>
						<a href="index.php?action=showRegistrationForm">Zarejestruj się!</a>
				</div>
				
			</div>
		</form>