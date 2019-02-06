<?php 
	if(!isset($portal)) die();

	if(!isset($_SESSION['zalogowany'])){
		header('Location:index.php?action=showLoginForm');
	}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
  $("[name = 'one']").click(function(){
    $("[name = 'changePass']").toggle();
  });
});

$(document).ready(function(){
  $("[name = 'two']").click(function(){
    $("[name = 'addInc']").toggle();
	
  });
});

$(document).ready(function(){
  $("[name = 'three']").click(function(){
    $("[name = 'addExp']").toggle();
  });
});

$(document).ready(function(){
  $("[name = 'four']").click(function(){
    $("[name = 'delInc']").toggle();
  });
});

$(document).ready(function(){
  $("[name = 'five']").click(function(){
    $("[name = 'delExp']").toggle();
  });
});

$(document).ready(function(){
  $("[name = 'six']").click(function(){
    $("[name = 'addPay']").toggle();
  });
});

$(document).ready(function(){
  $("[name = 'seven']").click(function(){
    $("[name = 'delPay']").toggle();
  });
});
</script>

<div class="container" style="text-align:center; padding:40px">

	<?php
		if(isset($komunikat) && isset($_SESSION['passChange'])){
			echo "<div class='err_log' style='color: green; font-size:16px;'>$komunikat</div>";
			unset($_SESSION['passChange']);
		}
		else{
			echo "<div class='err_log' style='font-size:16px;'>$komunikat</div>";
		}
	?>
	<button class="settingButton" name="one">Zmiana hasła</button>
	<form method='post' action='index.php?action=settings'>		
		<div class='windowSetting' name="changePass">	
			<div class="fontel"><i class="icon-key"></i></div>
			<input type="password" style="width:285px; float:left;" name="pass_o" placeholder="Podaj stare hasło"/><div style="clear:both;"></div>
			
			<div class="fontel"><i class="icon-key"></i></div>
			<input type="password" style="width:285px; float:left;" name="pass_n" placeholder="Podaj nowe hasło"/><div style="clear:both;"></div>

			<input type="submit" class="submitSet" value="Zmień"/>
		</div>
	</form>
	
	<button class="settingButton" style="margin-top: 45px;" name="two">Dodaj kategorię przychodu</button>
	<form method="post" action='index.php?action=addIncomesCategory'>
		<div class="windowSetting" name="addInc">
			<div class="fontel"><i class="icon-edit"></i></div>
				<input type="text" style="width:285px; float:left;" placeholder="Wpisz nową kategorię przychodu" name="checkAddIncomes"/>
			<input type="submit" class="submitSet" value="Dodaj"/>
		</div>
	</form>
	
	<button class="settingButton" name="three">Dodaj kategorię wydatku</button>
	<form method="post" action='index.php?action=addExpensesCategory'>
		<div class="windowSetting" name="addExp">						
			<div class="fontel"><i class="icon-edit"></i></div>										 
				<input type="text" style="width:285px; float:left;" placeholder="Wpisz nową kategorię wydatku" name="checkAddExpenses"/>
			<input type="submit" class="submitSet" value="Dodaj"/>
		</div>
	</form>
	
	<button class="settingButton" name="six">Dodaj formę płatności</button>
	<form method="post" action='index.php?action=addPaymentMethod'>
		<div class="windowSetting" name="addPay">
			<div class="fontel"><i class="icon-edit"></i></div>
				<input type="text" style="width:285px; float:left;" placeholder="Wpisz nową formę płatności" name="checkAddPayment"/>
			<input type="submit" class="submitSet" value="Dodaj"/>
		</div>
	</form>
	
	<button class="settingButton" style="margin-top: 45px;" name="four">Usuń kategorię przychodu</button>
	<form method="post" action='index.php?action=deleteCategory'>
		<div class="windowSetting" name="delInc">						
			<div class="fontel"><i class="icon-edit"></i></div>										 
				<select class="category" style="width:285px; float:left;" name="deleteIncomesCategory"> 
				<?php 
					$arrayCategory = $_SESSION['arrayCategoryIncomes'];
					echo "<option value='empty' disabled selected hidden>Wybierz kategorię</option>";

					for($i = 0; $i < count($arrayCategory); $i++){
						if($arrayCategory[$i] != 'inne')
							echo "<option value='$arrayCategory[$i]'>$arrayCategory[$i]</option>";
					}
					unset($_SESSION['arrayCategoryIncomes']);
				?>
				</select>
			<input type="submit" class="submitSet" value="Usuń"/>
		</div>
	</form>
	
	<button class="settingButton" name="five">Usuń kategorię wydatku</button>
	<form method="post" action='index.php?action=deleteCategoryExp'>
		<div class="windowSetting" name="delExp">
			<div class="fontel"><i class="icon-edit"></i></div>
				<select class="category" style="width:285px; float:left;" name="deleteExpensesCategory">
					<?php 
					$arrayCategory = $_SESSION['arrayCategoryExpenses'];
					echo "<option value='empty' disabled selected hidden>Wybierz kategorię</option>";
					
					for($i = 0; $i < count($arrayCategory); $i++){
						if($arrayCategory[$i] != 'inne')
							echo "<option value='$arrayCategory[$i]'>$arrayCategory[$i]</option>";
					}
					unset($_SESSION['arrayCategoryExpenses']);
					?>
				</select>
			<input type="submit" class="submitSet" value="Usuń">						
		</div>
	</form>
	
	<button class="settingButton" name="seven">Usuń formę płatności</button>
	<form method="post" action='index.php?action=deletePaymentMethod'>
		<div class="windowSetting" name="delPay">
			<div class="fontel"><i class="icon-edit"></i></div>
				<select class="category" style="width:285px; float:left;" name="deletePayment">
					<?php
					$arrayPay = $_SESSION['arrayPay'];
					
					echo "<option value='empty' disabled selected hidden>Wybierz formę płatności</option>";
					
					for($i = 0; $i < count($arrayPay); $i++){
						if($arrayPay[$i] != 'gotówka')
							echo "<option value='$arrayPay[$i]'>$arrayPay[$i]</option>";
					}
					unset($_SESSION['arrayPay']);
					?>
				</select>
			<input type="submit" class="submitSet" value="Usuń">						
		</div>
	</form>
</div>