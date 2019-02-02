<?php 
	if(!isset($portal)) die();

	if(!isset($_SESSION['zalogowany'])){
		header('Location:index.php?action=showLoginForm');
	}
?>
<div class="container">
	<div class="row">
		<div class="windowAdd">
			<?php 
				if(isset($komunikat)){
					echo "<div class='statement'>$komunikat</div>";
				}
			?>
			
			<h2 class="word" style="font-size:14px;">DODAJ PRZYCHÓD</h2>
			
			<form action="index.php?action=addIncomes" method="post">
			
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
				?></div>					
						
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

				<div class="fontel"><i class="icon-edit"></i></div>										 
				<select class="category" name="choiceIncomes"> 
				<?php 
					$arrayCategory = $_SESSION['arrayCategoryIncomes'];

					echo "<option value='empty' disabled selected hidden>Kategoria</option>";

					for($i = 0; $i < count($arrayCategory); $i++){
						echo "<option value='$arrayCategory[$i]'>$arrayCategory[$i]</option>";
					}
					unset($_SESSION['arrayCategoryIncomes']);
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
					<a class="tilelink" href="index.php?action=showMain"><i class="icon-cancel"></i>ANULUJ</a>
				</div>
			</form>
		</div>
	</div>
</div>