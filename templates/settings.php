<?php 
	if(!isset($portal)) die();

	if(!isset($_SESSION['zalogowany'])){
		header('Location:index.php?action=showLoginForm');
	}
	
	include 'templates/modalWindow.php';
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
	
	<button class="settingButton" name="four" data-toggle="modal" data-target="#changePasswordModal">Zmiana hasła</button>
	
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

<!-- Edit Income JS -->
<script>	
	$('#inc').click(function() {
		var selValueCat = $('input[name=inInc]:checked').val();
		var val = $('input[name=checkAddIncome]').val();
		
		$.ajax({
			method:"post", 
			url:'index.php?action=editIncomesCategory', 
			data: {
				valueKey : selValueCat,
				inInc: val,
			},
			success: function(data){
					$('#setInc').html(data);
					$('#alertModalSuccess').modal('show');
			  }
		});
	});
</script>

<!-- Edit Expense JS -->
<script>
	$('#exp').click(function() {
		var selValueExp = $('input[name=inExp]:checked').val();
		var val3 = $('input[name=checkAddExpense]').val();
		var val3Replace = val3.replace(/_/g, " ");
		
		var setValLimit = $('input[name=limit]').val();
		var checkbox = this.form.elements['limit'].disabled;

		if(checkbox == true){
			setValLimit = 0;
		}
		
		$.ajax({
			method:"post", 
			url:'index.php?action=editExpensesCategory', 
			data: {
				valueKeyExp : selValueExp,
				inExp: val3Replace,
				valLimit : setValLimit,
			},
			success: function(data){
					$('#setExp').html(data);
					$('#alertModalSuccess').modal('show');
			  }
		});
	});
</script>

<!-- Edit Payment Methods JS -->
<script>
	$('#pay').click(function() {
		var selValuePay = $('input[name=inPay]:checked').val();
		var val2 = $('input[name=checkAddPaymentMet]').val();
	
		$.ajax({
			method:"post", 
			url:'index.php?action=editPaymentMethods', 
			data: {
				valueKeyPay : selValuePay,
				inPay: val2,
			},
			success: function(data){
					$('#setPay').html(data);
					$('#alertModalSuccess').modal('show');
			  }
		});
	});
</script>