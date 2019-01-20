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
	
		<article>
		
			<div class="article">
			
				<div class="container">
					<h2 class="title">Dodaj wydatek</h2>
				
				<form action="index.php?action=addExpenses" method="post">
					<div id="window">

						<div class="row">
								
							<div class="col-sm-12 col-md-4">
								<label>Kwota (PLN):</label>
							</div>
							
							<div class="col-sm-12 col-md-8">
								<input type="amount" name="amount"
								value=
									"<?php
										if (isset($_SESSION['amount'])) {
											echo $_SESSION['amount'];
											unset($_SESSION['amount']);
										}
									 ?>"/>
							
								<div class="err_log">
									<?php
										if(isset($_SESSION['e_amount'])) {
											echo $_SESSION['e_amount'];
											unset($_SESSION['e_amount']);
										}
									?>
								</div>
							</div>
							
							<div class="col-sm-12 col-md-4">
								<label>Data:</label>
							</div>
							
							<div class="col-sm-12 col-md-8">
								<input type="date" name="date" 
								value=
									"<?php
										if (isset($_SESSION['date'])) {
											echo $_SESSION['date'];
											unset($_SESSION['date']);
										}
									 ?>"/>
								
								<div class="err_log">
								<?php
									if(isset($_SESSION['e_date'])) {
										echo $_SESSION['e_date'];
										unset($_SESSION['e_date']);
									}
								?>
								</div>								
							</div>
								
							<div class="col-sm-12 col-md-4">
								<label>Sposób płatności:</label>
							</div>
							
							<div class="col-sm-12 col-md-8">
								<input type="text" name="payment_methods" list="payment"
								value=
								"<?php
									if (isset($_SESSION['payment_methods'])) {
										echo $_SESSION['payment_methods'];
										unset($_SESSION['payment_methods']);
									}
								 ?>"/>
								 
									 <datalist id="payment">
									 
										<option value="Gotówka">
										<option value="Karta debetowa">
										<option value="Karta kredytowa">
									 </datalist>
									 
								<div class="err_log">
								<?php
									if(isset($_SESSION['e_payment_methods'])) {
										echo $_SESSION['e_payment_methods'];
										unset($_SESSION['e_payment_methods']);
									}
								?>
								</div>
							</div>
								
							<div class="col-sm-12 col-md-4">
									<label>Kategoria:</label>
							</div>
							
							<div class="col-sm-12 col-md-8">
								<input type="text" name="category" list="category"
								value=
								"<?php
									if (isset($_SESSION['category_exp'])) {
										echo $_SESSION['category_exp'];
										unset($_SESSION['category_exp']);
									}
								 ?>"/>
								 
									 <datalist id="category">
										<?php 
											$arrayCategory = $_SESSION['arrayCategoryExpenses'];
											
											for($i = 0; $i < count($arrayCategory); $i++){
												echo "<option value='$arrayCategory[$i]'>";
											}
											unset($_SESSION['arrayCategoryExpenses']);
											?>
									 </datalist>
										 
								<div class="err_log">
									<?php
										if(isset($_SESSION['e_category'])) {
											echo $_SESSION['e_category'];
											unset($_SESSION['e_category']);
										}
									?>
								</div>
							</div>
								 
							<div class="col-sm-12 col-md-4">
									<label>Komentarz:</label>
							</div>
							
							<div class="col-md-12 col-lg-8">
								<textarea name="comment" placeholder="Wprowadź komentarz..."
								><?php
										if (isset($_SESSION['comment'])) {
											echo $_SESSION['comment'];
											unset($_SESSION['comment']);
										}
									 ?></textarea>	
							</div>
							
						</div>
						
					</div>
				
						<input type="submit"value="Dodaj">
						<a href="index.php?action=showMain"><input type="button" value="Anuluj"></a>
				</form>
				
				</div>
			
			</div>
		
		</article>