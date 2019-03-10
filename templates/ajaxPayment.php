<?php
	$arrayImplodePay = $_SESSION['arrayPay'];
	
	if($arrayImplodePay > 0){
		for($i = 0; $i < count($arrayImplodePay); $i++){
			$arrayExplodePay = explode(',', $arrayImplodePay[$i]);
			
			if($arrayImplodePay[$i] != 'gotówka'){
				echo "
					<div class='incomesList'>
						<label class='radio'>
							<input type='radio' name='inPay' class='hidden' value='$arrayImplodePay[$i]'/>
								<span class='label'></span>
								$arrayImplodePay[$i]
								<span class='optionSetDelete' id='$i' style='font-size:9px;'><i title='Usuń' class='icon-trash-1'></i></span>
								<span class='optionSetEdit' id='payButton' data-toggle='modal' data-target='#editPaymentMet' style='font-size:9px;'><i title='Edytuj' class='icon-pencil'></i></span>
						</label>
					</div>";
			}
		}
	}
?>

<button class="settingButtonAddAndDelete" data-toggle="modal" data-target="#addPaymentMet">Dodaj formę płatności</button>

<script>	
	$('.optionSetDelete').click(function() {
		var selValue = $('input[name=inPay]:checked').val();
		
		$.ajax({
			method:"post", 
			url:'index.php?action=deletePaymentMethod', 
			data: {
				valueKey : selValue,
			},
			success: function(data){
					$('#setPay').html(data);
			  }
		});
	});
</script>

<!-- Set Values PayMet -->
<script>
	$(document).ready(function(){
		$('input[name=inPay]').on("click", function(){
			var values = $('input[name=inPay]:checked').val();
			$('#inputPay').val(values);
		});
	});
</script>