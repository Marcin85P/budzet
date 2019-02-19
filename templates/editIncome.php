<?php 
	if(!isset($portal)) die();

	if(!isset($_SESSION['zalogowany'])){
		header('Location:index.php?action=showLoginForm');
	}
?>
<div class="container">
	<div class="row">
		<div class="windowAdd">
			<h2 class="word" style="font-size:14px;">EDYTUJ PRZYCHÓD</h2>
			
			<form action="<?php echo "index.php?action=editIncomeAction&idIncome=$_GET[idIncome]" ?>" method="post">
			
				<div class="fontel"><i class="icon-dollar"></i></div>
				<input type="text" name="amount" placeholder="Kwota"
				value=
				"<?php
					echo $_GET['amountIncome'];
				 ?>"/>					
						
				<div class="fontel"><i class="icon-calendar"></i></div>
				<input type="date" name="date"
				value=
				"<?php
						echo $_GET['dateIncome'];
				 ?>"/>

				<div class="fontel"><i class="icon-edit"></i></div>										 
				<select class="category" name="choiceIncomes"> 
				<?php 
					$arrayCategory = $_SESSION['arrayCategoryIncomes'];

					$category = mb_strtolower($_GET['categoryIncome'], 'UTF-8');
					echo "<option>$category</option>";

					for($i = 0; $i < count($arrayCategory); $i++){
						if($arrayCategory[$i] != $category)
							echo "<option>$arrayCategory[$i]</option>";
					}
					unset($_SESSION['arrayCategoryIncomes']);
				?>
				</select>
				
				<div class="fontel"><i class="icon-commenting"></i></div>
				<textarea name="comment" placeholder="Wprowadź komentarz..."><?php echo $_GET['commentIncome']; ?></textarea>	

				<div class="col-12">
					<input type="submit" value="&#xe804; ZMIEŃ" style="font-family:fontello;"/>
				</div>

				<div class="button">
					<a class="tilelink" href="index.php?action=showBalance"><i class="icon-cancel"></i>ANULUJ</a>
				</div>
			</form>
		</div>
	</div>
</div>