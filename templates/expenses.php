<?php 
	if(!isset($portal)) die();

	if(!isset($_SESSION['zalogowany'])){
		header('Location:index.php?action=showLoginForm');
	}
?>
<div class="container">
	<div class="row">
		<div class="windowAdd">
			<h2 class="word" style="font-size:14px;">DODAJ WYDATEK</h2>

			<form action="index.php?action=addExpenses" method="post">
			
				<div class="fontel"><i class="icon-dollar"></i></div>
				<input type="text" name="amount" placeholder="Kwota" 
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

				<div class="fontel"><i class="icon-calendar"></i></div>
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
				
				<div class="fontel"><i class="icon-credit-card"></i></div>
				<select class="payment" name="payment_methods">								 
					<option value='empty' disabled selected hidden>Sposób płatności</option>
					<option value="Gotówka">Gotówka</option>
					<option value="Karta debetowa">Karta debetowa</option>
					<option value="Karta kredytowa">Karta kredytowa</option>
				</select>
					 
				<div class="err_log">
				<?php
					if(isset($_SESSION['e_payment_methods'])) {
						echo $_SESSION['e_payment_methods'];
						unset($_SESSION['e_payment_methods']);
					}
				?>
				</div>

				<div class="fontel"><i class="icon-edit"></i></div>
				<select class="category" name="choiceExpenses"> 
					<?php 
					$arrayCategory = $_SESSION['arrayCategoryExpenses'];
					
					echo "<option value='empty' disabled selected hidden>Kategoria</option>";
					
					for($i = 0; $i < count($arrayCategory); $i++){
						echo "<option value='$arrayCategory[$i]'>$arrayCategory[$i]</option>";
					}
					unset($_SESSION['arrayCategoryExpenses']);
					?>
				</select>
				 
				 <div class="err_log">
				<?php
					if(isset($_SESSION['e_category'])) {
						echo $_SESSION['e_category'];
						unset($_SESSION['e_category']);
					}
				?>
				</div>
							 

				<div class="fontel"><i class="icon-commenting"></i></div>
				<textarea name="comment" placeholder="Wprowadź komentarz..."></textarea>	

				<div class="col-12">
					<input type="submit" value="&#xe804; DODAJ" style="font-family:fontello;"/>
				</div>
				
				<div class="button">
					<a class="tilelink" href="index.php?action=showMain" style="font-family:fontello;"><i class="icon-cancel"></i>ANULUJ</a>
				</div>
			</form>

		</div>
	</div>
</div>