<?php 
if(!isset($portal)) die();

if(!isset($_SESSION['zalogowany'])){
	header('Location:index.php?action=showLoginForm');
}
?>
		<link rel="stylesheet" href="main.css" type="text/css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
		<header>

			<nav class="page-navigation clearfix">
			
				<label class="navigation-toggle" for="input-toggle">
					<span></span>
					<span></span>
					<span></span>
				</label>
			
				<input type="checkbox" id="input-toggle">
				
				<ul class="menu">
					<li><a href='index.php?action=showIncomes'>Dodaj przychód</a></li>
					<li><a href='index.php?action=showExpenses'>Dodaj wydatek</a></li>
					<li><a href='index.php?action=tableView'>Przegląd bilansu</a></li>
					<li><a href='index.php?action=settingsView'>Ustawienia</a></li>
					<li><a href='index.php?action=logout' class="logout">Wyloguj się</a></li>	
				</ul>
					
			</nav>
		
		</header>

		<div class="D-menu">
				
			<div id="buttonSticky">
			
				<button id="item">Okres</button>	
				
				<div id="submenu">
					<a href="index.php?action=tableView">Bieżący miesiąc</a>
					<a href="index.php?action=tableViewPreviousMonth">Poprzedni miesiąc</a>
					<a href="index.php?action=tableViewCurrentYear">Bieżący rok</a>
					<a href="index.php?action=customView">Niestandardowy</a>
				</div>		
					
			</div>
									
		</div>
				
		<div style="clear: both;"></div>
		
		<div class="container">
		
			<div class="row">
			
					<div class="col-lg-7 col-md-12">
			
					<div id="table">
					
						<div class="table-responsive">
						
							<table class="tb">

								<thead>
								
								<tr>
									<th colspan="4" class="tableTitle">Przychody
									<?php 
									if(isset($_SESSION['score'])){
										echo " ".$_SESSION['score'];
									}
									?>
									</th>
								</tr>
								
								<tr>
									<th class="date3">Data</th>
									<th class="category1">Kategoria</th>
									<th class="amount2">Kwota (PLN)</th>
									<th class="comment4">Komentarz</th>
									
								</tr>
								</thead>
								
								<tbody>

		<?php
		$sumIncomes = 0;
		$arrayImplode = $_SESSION['arrayIncomes'];
		
		if($arrayImplode > 0){
			for($i = 0; $i < count($arrayImplode); $i++){
				$arrayExplode = explode(',', $arrayImplode[$i]);
				
				echo "<tr id='line'>";
				echo "<td class='position'>$arrayExplode[0]</td>";
				echo "<td class='position'>$arrayExplode[1]</td>";
				echo "<td class='position'>$arrayExplode[2]</td>";
				echo "<td class='position'>$arrayExplode[3]</td></tr>";
					
				$sumIncomes += $arrayExplode[2];
			}
		}
		?>

								<tr>
									<th class="sum">Suma</th>
									<td style="background-color: #db8534" class="position"></td>
									<th style="font-size:17px" class="position"><?php echo number_format($sumIncomes, 2);?></th>
									<td style="background-color: #db8534" class="position"></td>
								</tr>
								
								</tbody>
								
							</table>
							
						</div>
						
					</div>
					
					</div>
					
					<div class="col-lg-5 col-md-12">
					
						<div class="diagram">
							
							<canvas id="ChartIncomes" width="300" height="250"></canvas>
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
					
					<div style="clear: both;"></div>
				
					<div class="col-lg-7 col-md-12">
					
					<div id="table">
					
						<div class="table-responsive">
						
							<table class="tb">

								<thead>
								
									<tr>
										<th colspan="4" class="tableTitle">Wydatki
										<?php 
										if(isset($_SESSION['score'])){
											echo " ".$_SESSION['score'];
											unset($_SESSION['score']);
										}
										?>
										</th>
									</tr>
									
									<tr>
										<th class="date3">Data</th>
										<th class="category1">Kategoria</th>
										<th class="amount2">Kwota (PLN)</th>
										<th class="comment4">Komentarz</th>
									</tr>
									
								</thead>
								
								<tbody>
								
	<?php 
		$sumExpenses = 0;
		$arrayImplode = $_SESSION['arrayExpenses'];
		
		if($arrayImplode > 0){
			for($i = 0; $i < count($arrayImplode); $i++){
				$arrayExplode = explode(',', $arrayImplode[$i]);
				
				echo "<tr id='line'>";
				echo "<td class='position'>$arrayExplode[0]</td>";
				echo "<td class='position'>$arrayExplode[1]</td>";
				echo "<td class='position'>$arrayExplode[2]</td>";
				echo "<td class='position'>$arrayExplode[3]</td></tr>";
				
				$sumExpenses += $arrayExplode[2];
			}
		}
		unset($_SESSION['a']);
		unset($_SESSION['b']);
		unset($_SESSION['c']);
		?>							
	
									<tr>
									<th class="sum">Suma</th>
									<td style="background-color: #db8534" class="position"></td>
									<th style="font-size:17px" class="position"><?php echo number_format($sumExpenses, 2);?></th>
									<td style="background-color:#db8534" class="position"></td>
								</tr>
								
								</tbody>
								
							</table>
							
						</div>
						
					</div>
					
					</div>
					
					<div class="col-lg-5 col-md-12">
			
						<div class="diagram">
						
							<canvas id="ChartExpenses" width="300" height="250"></canvas>
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
			</div>
		</div>