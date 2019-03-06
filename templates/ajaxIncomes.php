<?php
	$arrayImplodeInc = $_SESSION['arrayCategoryIncomes'];
	
	if($arrayImplodeInc > 0){
		for($i = 0; $i < count($arrayImplodeInc); $i++){
			$arrayExplodeInc = explode(',', $arrayImplodeInc[$i]);
			
			if($arrayImplodeInc[$i] != 'inne'){
				echo "
					<div class='incomesList'>
						<label class='radio'>
							<input type='radio' name='inInc' class='hidden' value='$arrayImplodeInc[$i]'/>
								<span class='label'></span>
								$arrayImplodeInc[$i]
								<span class='optionSetDelete' style='font-size:9px;'><i title='Usuń' class='icon-trash-1'></i></span>
								<span class='optionSetEdit' data-toggle='modal' data-target='#modalEditIncome' style='font-size:9px;'><i title='Edytuj' class='icon-pencil'></i></span>
						</label>
					</div>";
			}
		}
	}
?>	

<button class="settingButtonAddAndDelete" data-toggle="modal" data-target="#addIncomeCategory">Dodaj kategorię przychodu</button>

<script>
	$('.optionSetDelete').click(function() {
		var selValue = $('input[name=inInc]:checked').val();

		$.ajax({
			method:"post", 
			url:'index.php?action=deleteCategory', 
			data: {
				valueKey : selValue,
			},
			success: function(data){
					$('#setInc').html(data);
			  }
		});
	});
</script>

<!-- Set Values Income -->
<script>
	$('.optionSetEdit').click(function(){
		var values = $('input[name=inInc]:checked').val();
		$('#inputIncomes').val(values);
	});
</script>