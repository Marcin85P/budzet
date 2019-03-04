<?php
	$arrayImplode = $_SESSION['arrayPay'];
	
	if($arrayImplode > 0){
		for($i = 0; $i < count($arrayImplode); $i++){
			$arrayExplode = explode(',', $arrayImplode[$i]);
			
			if($arrayImplode[$i] != 'gotówka'){
				echo "
					<div class='incomesList'>
						<label class='radio'>
							<input type='radio' name='inPay' class='hidden' value='$arrayImplode[$i]'/>
								<span class='label'></span>
								$arrayImplode[$i]
								<span class='optionSetDelete' style='font-size:9px;'><i title='Usuń' class='icon-trash-1'></i></span>
								<span class='optionSetEdit' id='payButton' data-toggle='modal' data-target='#exampleModal9' style='font-size:9px;'><i title='Edytuj' class='icon-pencil'></i></span>
						</label>
					</div>";
			}
		}
	}
?>

<button class="settingButtonAddAndDelete" data-toggle="modal" data-target="#exampleModal6">Dodaj formę płatności</button>

<script>	
$('.optionSetDelete').click(function() {
	var selValue = $('input[name=inPay]:checked').val();
	
	if(selValue == undefined){
		$('#alertModalEmptyPay').modal('toggle');
	}
	else{
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
	}
});
</script>

<div class="modal fade" id="alertModalEmptyPay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-body" style="font-size: 15px;">
		<?php echo  'Aby usunąć formę płatności, musisz ją najpierw zaznaczyć.';?>
	  </div>
	  <div class="modal-footer">
		<button type="button" style="height:25px; width:80px; background:#2f4f4f; border:none; font-size:12px; padding:0;" class="btn btn-primary" data-dismiss="modal">OK</button>
	  </div>
	</div>
  </div>
</div>