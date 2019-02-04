<?php 
if(!isset($portal)) die();

if(!isset($_SESSION['zalogowany'])){
	header('Location:index.php?action=showLoginForm');
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<div class="container" style="max-width:90%;">
	<div class="row">	
	
		<div class="col-sm-12">
			<div id="buttonSticky">
				<button id="item"><i class="icon-calendar"></i> Wybierz okres</button>	
				
				<div id="submenu">
					<a href="index.php?action=tableView">Bieżący miesiąc</a>
					<a href="index.php?action=tableViewPreviousMonth">Poprzedni miesiąc</a>
					<a href="index.php?action=tableViewCurrentYear">Bieżący rok</a>
					<a style="cursor:pointer" data-toggle="modal" data-target="#exampleModal">Niestandardowy</a>
				</div>		
			</div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="exampleModalLabel">Niestandardowy okres:</h6>
					</div>
					<form action='index.php?action=tableViewCustom' method='post'>
						<div class="modal-body">
							<div class="fontel"><i class="icon-calendar-1"></i></div><input style="opacity:1;" type='date' name='custom_input_1' style='max-width:200px'></br>
							<div class="fontel"><i class="icon-calendar-1"></i></div><input style="opacity:1;" type='date' name='custom_input_2' style='max-width:200px'>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
							<input type="submit" style="width:50px; height:38px; margin:0;" value='OK'>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-12 col-lg-6">
			<div id="table">		
					<table class="tb">	
						<thead>
							<tr>
								<th colspan="4" class="tableTitle" style="background-color:#339878;">Przychody
									<?php 
									if(isset($_SESSION['score'])){
										echo " ".$_SESSION['score'];
									}
									?>
								</th>
							</tr>
							
							<tr>
								<th class="tabWin">Data</th>
								<th class="tabWin">Kategoria</th>
								<th class="tabWin">Kwota (PLN)</th>
								<th class="tabWinCom">Komentarz</th>
							</tr>
						</thead>
						
						<tbody>
							<?php
							$sumIncomes = 0;
							$arrayImplode = $_SESSION['arrayIncomes'];
							
							if($arrayImplode > 0){
								for($i = 0; $i < count($arrayImplode); $i++){
									$arrayExplode = explode(',', $arrayImplode[$i]);
									
									echo "<tr id='lineI'>";
									echo "<td style='min-width: 70px;'>$arrayExplode[0]</td>";
									echo "<td style='min-width: 100px;'>$arrayExplode[1]</td>";
									echo "<td style='min-width: 70px;'>$arrayExplode[2]</td>";
									echo "<td class='end' style='min-width: 110px;'>$arrayExplode[3]</td></tr>";
										
									$sumIncomes += $arrayExplode[2];
								}
							}
							?>

							<tr>
								<th class="tabWinSum" style="border-bottom:none">Suma</th>
								<td class="tabWin"></td>
								<th style="font-size:13px; border-bottom:none;" class="tabWinSum"><?php echo number_format($sumIncomes, 2);?></th>
								<td class="end"></td>
							</tr>
						</tbody>
					</table>					
			</div>
		</div>
		
		<div class="col-12 col-lg-6">
			<div id="table">		
					<table class="tb">
						<thead>
							<tr>
								<th colspan="5" class="tableTitle" style="background-color:#8F3212;">Wydatki
								<?php 
								if(isset($_SESSION['score'])){
									echo " ".$_SESSION['score'];
									unset($_SESSION['score']);
								}
								?>
								</th>
							</tr>
							
							<tr>
								<th class="tabWin">Data</th>
								<th class="tabWin">Kategoria</th>
								<th class="tabWin">Sposób płatności</th>
								<th class="tabWin">Kwota (PLN)</th>
								<th class="tabWinCom">Komentarz</th>
							</tr>
							
						</thead>
						
						<tbody>
						
							<?php 
								$sumExpenses = 0;
								$arrayImplode = $_SESSION['arrayExpenses'];
								
								if($arrayImplode > 0){
									for($i = 0; $i < count($arrayImplode); $i++){
										$arrayExplode = explode(',', $arrayImplode[$i]);
										
										echo "<tr id='lineE'>";
										echo "<td style='min-width: 70px;'>$arrayExplode[0]</td>";
										echo "<td style='min-width: 100px;'>$arrayExplode[1]</td>";
										echo "<td style='min-width: 70px;'>$arrayExplode[4]</td>";
										echo "<td style='min-width: 70px;'>$arrayExplode[2]</td>";
										echo "<td class='end' style='min-width: 110px;'>$arrayExplode[3]</td></tr>";
										
										$sumExpenses += $arrayExplode[2];
									}
								}
								unset($_SESSION['a']);
								unset($_SESSION['b']);
								unset($_SESSION['c']);
								?>							

							<tr>
								<th class="tabWinSum" style="border-bottom:none">Suma</th>
								<td class="tabWin" colspan="2"></td>
								<th style="font-size:13px; border-bottom:none;" class="tabWinSum"><?php echo number_format($sumExpenses, 2);?></th>
								<td class="end"></td>
							</tr>
						</tbody>	
					</table>								
			</div>
		</div>
					

		
		<div style="clear: both;"></div>			
		
		<div class="col-12 col-lg-6">
			<div class="diagram">	
			
				<canvas id="ChartIncomes"></canvas>
				
				<script type="text/javascript">
					var name_category = <?php echo json_encode($_SESSION['category_arrayIncomes']);?>;
					var percentage_result = <?php echo json_encode($_SESSION['percentage_resultIncomes']);?>;
					var title = <?php echo json_encode($_SESSION['chartTitleIncomes']);?>;
				</script>
				<?php 
					if($sumIncomes != 0) {
						echo "<script src='diagramIncomes.js'></script>";
					}
				?>
			</div>
		</div>

					
		<div class="col-12 col-lg-6">
			<div class="diagram">
			
				<canvas id="ChartExpenses"></canvas>
				
				<script type="text/javascript">
					var name_category = <?php echo json_encode($_SESSION['category_arrayExpenses']);?>;
					var percentage_result = <?php echo json_encode($_SESSION['percentage_resultExpenses']);?>;
					var title = <?php echo json_encode($_SESSION['chartTitleExpenses']);?>;
				</script>
				<?php 
					if($sumExpenses != 0) {
						echo "<script src='diagramExpenses.js'></script>";
					}
				?>	
			</div>
		</div>
						
		<div style="clear: both;"></div>
		
		<?php $balance = $sumIncomes - $sumExpenses; ?>
		
			<?php
				$balance = round($balance,2);
				
				if($balance > 0){
					echo "<div class='balance' style='background-color: #339878'>Bilans: <t>$balance</t>; <p style='font-size:17px'>Gratulacje! Świetnie zarządzasz finansami!</p></div>";
				}
				else if($balance < 0){
					echo "<div class='balance' style='background-color: #8F3212'>Bilans: <t>$balance</t>; <p style='font-size:17px'>Niestety Twoje wydatki przekraczają dochody!</p></div>";
				}
				else{
					echo "<div class='balance'>Bilans: <t style='color:#fff'>$balance</t></div>";
				}
			?>
		</div>
	</div>
</div>