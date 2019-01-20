<?php if(!$this) die();?>
<link rel="stylesheet" href="style.css" type="text/css" />
	<form method="post" action="index.php?action=registerUser">
				<div id="window">
					<div class="row1">
						
					<div class="col-12">
							<p class="word">REJESTRACJA</p>
						</div>	
						
						<div class="col-12">
							<input type="text" name="nick" placeholder="Login" 
							value=
							"<?php
								if (isset($_SESSION['fr_nick'])) {
									echo $_SESSION['fr_nick'];
									unset($_SESSION['fr_nick']);
								}
							 ?>"/>
								<div class="err_log">
								<?php
									if(isset($_SESSION['e_nick'])) {
										echo $_SESSION['e_nick'];
										unset($_SESSION['e_nick']);
									}
								?>
								</div>
						</div>	
						
						<div class="col-12">
							<input type="password" name="pass1" placeholder="Hasło"/>
								<div class="err_log">
									<?php
										if(isset($_SESSION['e_pass'])) {
											echo $_SESSION['e_pass'];
											unset($_SESSION['e_pass']);
										}
									?>
								</div>
						</div>
						
						<div class="col-12">
							<input type="password" name="pass2" placeholder="Powtórz hasło"/>
								<div class="err_log">
									<?php
										if(isset($_SESSION['e_pass2'])) {
											echo $_SESSION['e_pass2'];
											unset($_SESSION['e_pass2']);
										}
									?>
								</div>
						</div>
					</div>
					
					<div class="row1">
						<div class="col-12">
							<input type="submit" value="Zarejestruj się!">
						</div>
					</div>
					
					<div class='reg'>
					<a href="index.php?=showLoginForm">Powrót do strony logowania.</a>
				</div>
					
				</div>
				
			</form>