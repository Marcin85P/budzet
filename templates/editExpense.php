<?php 
	if(!isset($portal)) die();

	if(!isset($_SESSION['zalogowany'])){
		header('Location:index.php?action=showLoginForm');
	}
?>
<div class="container">
	<div class="row">
		<div class="windowAdd">
			<h2 class="word" style="font-size:14px;">EDYTUJ WYDATEK</h2>
			
			<form action="<?php echo "index.php?action=editExpenseAction&idExpense=$_GET[idExpense]" ?>" method="post">
			
				<div class="fontel"><i class="icon-dollar"></i></div>
				<input type="text" name="amount" placeholder="Kwota"
				value=
				"<?php
					echo $_GET['amountExpense'];
				 ?>"/>					
						
				<div class="fontel"><i class="icon-calendar"></i></div>
				<input type="date" name="date"
				value=
				"<?php
						echo $_GET['dateExpense'];
				 ?>"/>
				
				<div class="fontel"><i class="icon-credit-card"></i></div>
				<select class="payment" name="payment_methods">
					<?php
					$arrayPay = $_SESSION['arrayPay'];
					
					$payment = mb_strtolower($_GET['paymentExpense'], 'UTF-8');
					echo "<option>$payment</option>";
					
					for($i = 0; $i < count($arrayPay); $i++){
						if($arrayPay[$i] != $payment)
							echo "<option value='$arrayPay[$i]'>$arrayPay[$i]</option>";
					}
					unset($_SESSION['arrayPay']);
					?>
				</select>

				<div class="fontel"><i class="icon-edit"></i></div>										 
				<select class="category" name="choiceExpenses"> 
				<?php 
					$arrayCategory = $_SESSION['arrayCategoryExpenses'];

					$category = mb_strtolower($_GET['categoryExpense'], 'UTF-8');
					echo "<option>$category</option>";

					for($i = 0; $i < count($arrayCategory); $i++){
						if($arrayCategory[$i] != $category)
							echo "<option>$arrayCategory[$i]</option>";
					}
					unset($_SESSION['arrayCategoryExpenses']);
				?>
				</select>
				
				<div class="fontel"><i class="icon-commenting"></i></div>
				<textarea name="comment" placeholder="Wprowadź komentarz..."><?php echo $_GET['commentExpense']; ?></textarea>	

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