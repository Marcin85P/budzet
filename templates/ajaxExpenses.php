<?php
	$arrayImplode = $_SESSION['arrayCategoryExpenses'];
	
	if($arrayImplode > 0){
		for($i = 0; $i < count($arrayImplode); $i++){
			$arrayExplode = explode(',', $arrayImplode[$i]);
			
			if($arrayImplode[$i] != 'inne'){
				echo "
					<div class='incomesList'>
						<label class='radio'>
							<input type='radio' name='inExp' class='hidden' value='$arrayImplode[$i]'/>
								<span class='label'></span>
								$arrayImplode[$i]
								<span class='optionSetDelete' style='font-size:9px;'><i title='Usuń' class='icon-trash-1'></i></span>
								<button class='optionSetEdit' style='font-size:9px;'><i title='Edytuj' class='icon-pencil'></i></button>
						</label>
					</div>";
			}
		}
	}
?>

<button class="settingButtonAddAndDelete" data-toggle="modal" data-target="#exampleModal4">Dodaj kategorię wydatku</button>
<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<script>	
$('.optionSetDelete').click(function() {
	var selValue = $('input[name=inExp]:checked').val();
	
	$.ajax({
		method:"post", 
		url:'index.php?action=deleteCategoryExp', 
		data: {
			valueKey : selValue,
		},
		success: function(data){
				$('#setExp').html(data);
		  }
	});
});
</script>	