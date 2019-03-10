<!-- Modal Change Password -->	
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Modal Add Income Category -->
<div class="modal fade" id="addIncomeCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Modal Edit Income Category -->
<div class="modal fade" id="modalEditIncome" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
			<input type="text" style="min-width:250px; float:left;" id="inputIncomes" value="" name="checkAddIncome"/></br>
		<input type="submit" style="float:left; margin-left:15px; width:285px" data-dismiss="modal" id="inc" class="submitSetEdit" value="Edytuj"/>
	  </div>
	</div>
  </div>
</div>

<!-- Modal Add Expense Category -->
<div class="modal fade" id="addExpenseCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div style="width:350px; margin-left:auto; margin-right:auto" class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Dodaj kategorię wydatku</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
		<form method="post" action='index.php?action=addExpensesCategory'>						
			<div class="fontel"><i class="icon-edit"></i></div>										 
				<input type="text" style="min-width:250px; float:left;" placeholder="Wpisz nową kategorię wydatku" name="checkAddExpenses"/>
			<input type="submit" style="float:left; margin-left:15px; width:285px" class="submitSet" value="Dodaj"/>
		</form>
	  </div>
	</div>
  </div>
</div>

<!-- Modal Edit Expense Category -->
<div class="modal fade" id="editExpenses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div style="width:350px; margin-left:auto; margin-right:auto" class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Edycja kategorii wydatku</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
		<form method="post">
			<div class="fontel"><i class="icon-edit"></i></div>
				<input type="text" style="min-width:250px; float:left;" id="inputExp" value="" name="checkAddExpense"/></br>
				<label style="font-size:12px; float:left; margin:2px; margin-top:28px; margin-left:15px;"><input type="checkbox" id="box" name="checkboxInput" onclick="this.form.elements['limit'].disabled = !this.checked"> Ustaw limit dla tej kategorii:</label>
				<input type="number" id="idLimit" style="width:170px; height:25px; font-size:12px; float:left; margin:0; margin-left:15px; border:1px solid lightgrey; border-radius:3px;" name="limit" disabled>
			<input type="submit" style="float:left; margin-left:15px; width:285px" data-dismiss="modal" id="exp" class="submitSetEdit" value="Edytuj"/>
		</form>
	  </div>
	</div>
  </div>
</div>

<!-- Modal Add Payment Method -->
<div class="modal fade" id="addPaymentMet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Edit Payment Method -->
<div class="modal fade" id="editPaymentMet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
			<input type="text" style="min-width:250px; float:left;" id="inputPay" value="" name="checkAddPaymentMet"/></br>				
		<input type="submit" style="float:left; margin-left:15px; width:285px" data-dismiss="modal" id="pay" class="submitSetEdit" value="Edytuj"/>
	  </div>
	</div>
  </div>
</div>

<!-- Modal Alert Success -->
<div class="modal fade" id="alertModalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-body" style="font-size: 15px;">
		<?php echo 'Zmiany zostały wprowadzone.';?>
	  </div>
	  <div class="modal-footer">
		<button type="button" style="height:25px; width:80px; background:#2f4f4f; border:none; font-size:12px; padding:0;" class="btn btn-primary" data-dismiss="modal">OK</button>
	  </div>
	</div>
  </div>
</div>