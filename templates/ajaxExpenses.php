<?php
	$arrayImplodeExp = $_SESSION['arrayCategoryExpenses'];
	$arrayLimit = $_SESSION['limit_exp'];
	
	if($arrayImplodeExp > 0){
		for($i = 0; $i < count($arrayImplodeExp); $i++){
			
			if($arrayImplodeExp[$i] != 'inne'){
				$replaceText = str_replace(" ","_",$arrayImplodeExp[$i]);
				
				if($arrayLimit[$i] > 0){
					echo "
						<div class='incomesList'>
							<label class='radio'>
								<input type='radio' name='inExp' class='hidden' value='$replaceText'/>
									<span class='label'></span>
									$arrayImplodeExp[$i]  
									<span class='optionSetDelete' style='font-size:9px;'><i title='Usuń' class='icon-trash-1'></i></span>
									<span class='optionSetEdit' data-toggle='modal' data-target='#editExpenses' style='font-size:9px;'><i title='Edytuj' class='icon-pencil'></i></span>

									<div style='margin-left:30px; width:110px; color:#b22222'>
										<input value='$arrayLimit[$i]' name='limitVal' id='$replaceText' style='display:none'/>Limit: $arrayLimit[$i] zł
									</div>
							</label>
						</div>";
				}else{
					echo "
						<div class='incomesList'>
							<label class='radio'>
								<input type='radio' name='inExp' class='hidden' value='$replaceText'/>
									<span class='label'></span>
									$arrayImplodeExp[$i]  
									<span class='optionSetDelete' style='font-size:9px;'><i title='Usuń' class='icon-trash-1'></i></span>
									<span class='optionSetEdit' data-toggle='modal' data-target='#editExpenses' style='font-size:9px;'><i title='Edytuj' class='icon-pencil'></i></span>
							</label>
						</div>";
				}
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

<script>
	$(document).ready(function(){
		$('input[name=inExp]').on("click", function(){
			var values = $('input[name=inExp]:checked').val();
			$('#inputExp').val(values);
			
			var valSel = $('#'+values).val();
			
			if(valSel > 0){
				document.getElementById('idLimit').disabled = false;
				document.getElementById('box').checked = true;
				$('#idLimit').val(valSel);
			}else{
				document.getElementById('idLimit').disabled = true;
				document.getElementById('box').checked = false;
				$('#idLimit').val(valSel);
			}
		});
	});
</script>