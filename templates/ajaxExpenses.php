<?php
	$arrayImplodeExp = $_SESSION['arrayCategoryExpenses'];
	
	if($arrayImplodeExp > 0){
		for($i = 0; $i < count($arrayImplodeExp); $i++){
			$arrayExplodeExp = explode(',', $arrayImplodeExp[$i]);
			
			if($arrayImplodeExp[$i] != 'inne'){
				echo "
					<div class='incomesList'>
						<label class='radio'>
							<input type='radio' name='inExp' class='hidden' value='$arrayImplodeExp[$i]'/>
								<span class='label'></span>
								$arrayImplodeExp[$i]
								<span class='optionSetDelete' style='font-size:9px;'><i title='Usuń' class='icon-trash-1'></i></span>
								<span class='optionSetEdit' data-toggle='modal' data-target='#editExpenses' style='font-size:9px;'><i title='Edytuj' class='icon-pencil'></i></span>
						</label>
					</div>";
			}
		}
	}
?>

<button class="settingButtonAddAndDelete" data-toggle="modal" data-target="#addExpenseCategory">Dodaj kategorię wydatku</button>

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

<!-- Set Values Expense -->
<script>
	$('.optionSetEdit').click(function(){
		var values = $('input[name=inExp]:checked').val();
		$('#inputExp').val(values);
	});
</script>