<?php
	$arrayImplode = $_SESSION['arrayCategoryIncomes'];
	
	if($arrayImplode > 0){
		for($i = 0; $i < count($arrayImplode); $i++){
			$arrayExplode = explode(',', $arrayImplode[$i]);
			
			if($arrayImplode[$i] != 'inne'){
				echo "
					<div class='incomesList'>
						<label class='radio'>
							<input type='radio' name='inInc' class='hidden' value='$arrayImplode[$i]'/>
								<span class='label'></span>
								$arrayImplode[$i]
								<span class='optionSetDelete' style='font-size:9px;'><i title='Usuń' class='icon-trash-1'></i></span>
								<span class='optionSetEdit' data-toggle='modal' data-target='#exampleModal10' style='font-size:9px;'><i title='Edytuj' class='icon-pencil'></i></span>
						</label>
					</div>";
			}
		}
	}
?>	

<button class="settingButtonAddAndDelete" data-toggle="modal" data-target="#exampleModal2">Dodaj kategorię przychodu</button>

<script>	
	$('.optionSetDelete').click(function() {
		var selValue = $('input[name=inInc]:checked').val();
		
		if(selValue == undefined){
			$('#alertModalEmpty').modal('toggle');
		}
		else{
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
		}
	});
</script>

<div class="modal fade" id="alertModalEmpty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-body" style="font-size: 15px;">
		<?php echo  'Aby usunąć kategorię, musisz ją najpierw zaznaczyć.';?>
	  </div>
	  <div class="modal-footer">
		<button type="button" style="height:25px; width:80px; background:#2f4f4f; border:none; font-size:12px; padding:0;" class="btn btn-primary" data-dismiss="modal">OK</button>
	  </div>
	</div>
  </div>
</div>