<?php 
	if(!isset($portal)) die();

	if(!isset($_SESSION['zalogowany'])){
		header('Location:index.php?action=showLoginForm');
	}
?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="slideToggle.js"></script>

<div class="container" style="text-align:center; padding:40px">

	<?php
		if(isset($komunikat) && isset($_SESSION['passChange'])){
			echo "<div class='err_log' style='color: #335a32; font-size:16px;'>$komunikat</div>";
			unset($_SESSION['passChange']);
		}
		else{
			echo "<div class='err_log' style='font-size:16px;'>$komunikat</div>";
		}
	?>
	<!-- Modal -->
	<button class="settingButton" name="four" data-toggle="modal" data-target="#exampleModal1">Zmiana hasła</button>
	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div style="width:350px; margin-left:auto; margin-right:auto" class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Zmiana hasła</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
				<form method='post' action='index.php?action=settings'>		
						<div class="fontel"><i class="icon-key"></i></div>
						<input type="password" style="width:250px; float:left;" name="pass_o" placeholder="Podaj stare hasło"/><div style="clear:both;"></div>
						
						<div class="fontel"><i class="icon-key"></i></div>
						<input type="password" style="width:250px; float:left;" name="pass_n" placeholder="Podaj nowe hasło"/><div style="clear:both;"></div>

						<input type="submit" style="float:left; margin-left:15px; width:285px" class="submitSet" value="Zmień"/>
				</form>
		  </div>
		</div>
	  </div>
	</div>
	
	<button class="settingButton" style="margin-top: 45px" name="one">Kategoria przychodu</button>
	<div id="setInc" name = "incomes">
		<?php include 'templates/ajaxIncomes.php'; ?>
	</div>
	
	<button class="settingButton" name="two">Kategoria wydatku</button>
	<div id="setExp" name = "expenses">
		<?php include 'templates/ajaxExpenses.php'; ?>
	</div>
	
	<button class="settingButton" name="three">Forma płatności</button>
	<div id="setPay" name = "payment">
		<?php include 'templates/ajaxPayment.php'; ?>
	</div>
	
</div>