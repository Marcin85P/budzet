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
			<h6 class="modal-title" id="exampleModalLabel">Zmiana hasła</h6>
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
		
		<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div style="width:350px; margin-left:auto; margin-right:auto" class="modal-content">
			  <div class="modal-header">
				<h6 class="modal-title" id="exampleModalLabel">Dodaj kategorię przychodu</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<form method="post" action='index.php?action=addIncomesCategory'>
						<div class="fontel"><i class="icon-edit"></i></div>
							<input type="text" style="min-width:250px; float:left;" placeholder="Wpisz nową kategorię przychodu" name="checkAddIncomes"/>
						<input type="submit" style="float:left; margin-left:15px; width:285px" class="submitSet" value="Dodaj"/>
				</form>
			  </div>
			</div>
		  </div>
		</div>

		<div class="modal fade" id="exampleModal10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div style="width:350px; margin-left:auto; margin-right:auto" class="modal-content">
			  <div class="modal-header">
				<h6 class="modal-title" id="exampleModalLabel">Edycja kategorii przychodu</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
					<div class="fontel"><i class="icon-edit"></i></div>
						<input type="text" style="min-width:250px; float:left;" value="" name="checkAddPayment"/></br>
					<input type="submit" style="float:left; margin-left:15px; width:285px" data-dismiss="modal" id="inc" class="submitSetEdit" value="Edytuj"/>
			  </div>
			</div>
		  </div>
		</div>
			
		<script>	
			$('#inc').click(function() {
				var selValueCat = $('input[name=inInc]:checked').val();
				var val = $('input[name=checkAddPayment]').val();
				
				$.ajax({
					method:"post", 
					url:'index.php?action=editIncomesCategory', 
					data: {
						valueKey : selValueCat,
						cos: val,
					},
					success: function(data){
							$('#setInc').html(data);
							$('#alertModalSuccess').modal('show');
					  }
				});
			});
		</script>
			
		<div class="modal fade" id="alertModalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-body" style="font-size: 15px;">
				<?php echo 'Kategoria została zaktualizowana.';?>
			  </div>
			  <div class="modal-footer">
				<button type="button" style="height:25px; width:80px; background:#2f4f4f; border:none; font-size:12px; padding:0;" class="btn btn-primary" data-dismiss="modal">OK</button>
			  </div>
			</div>
		  </div>
		</div>
	
	<button class="settingButton" name="two">Kategoria wydatku</button>
	<div id="setExp" name = "expenses">
		<?php include 'templates/ajaxExpenses.php'; ?>
	</div>
	
	<button class="settingButton" name="three">Forma płatności</button>
	<div id="setPay" name = "payment">
		<?php include 'templates/ajaxPayment.php'; ?>
	</div>
	
	<div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div style="width:350px; margin-left:auto; margin-right:auto" class="modal-content">
		  <div class="modal-header">
			<h6 class="modal-title" id="exampleModalLabel">Dodaj formę płatności</h6>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form method="post" action='index.php?action=addPaymentMethod'>
					<div class="fontel"><i class="icon-edit"></i></div>
						<input type="text" style="min-width:250px; float:left;" placeholder="Wpisz nową formę płatności" name="checkAddPayment"/>
					<input type="submit" style="float:left; margin-left:15px; width:285px" class="submitSet" value="Dodaj"/>
			</form>
		  </div>
		</div>
	  </div>
	</div>

	<div class="modal fade" id="exampleModal9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div style="width:350px; margin-left:auto; margin-right:auto" class="modal-content">
		  <div class="modal-header">
			<h6 class="modal-title" id="exampleModalLabel">Edycja formy płatności</h6>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="fontel"><i class="icon-edit"></i></div>
				<input type="text" style="min-width:250px; float:left;" value="" name="checkAddPaymentMet"/></br>				
			<input type="submit" style="float:left; margin-left:15px; width:285px" data-dismiss="modal" id="pay" class="submitSetEdit" value="Edytuj"/>
		  </div>
		</div>
	  </div>
	</div>
	
	<script>
		$('#pay').click(function() {
			var selValuePay = $('input[name=inPay]:checked').val();
			var val2 = $('input[name=checkAddPaymentMet]').val();
			
			$.ajax({
				method:"post", 
				url:'index.php?action=editPaymentMethods', 
				data: {
					valueKeyPay : selValuePay,
					cos2: val2,
				},
				success: function(data){
						$('#setPay').html(data);
						$('#alertModalSuccess').modal('show');
				  }
			});
		});
	</script>
	
</div>