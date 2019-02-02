<?php 
	if(!isset($portal)) die();

	if(!isset($_SESSION['zalogowany'])){
		header('Location:index.php?action=showLoginForm');
	}
?>

<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="infowin" style="width: 100%;">
				<h3>Budżet</h3>
				<p>Nadzór nad budżetem to podstawowe działanie, które powinien podjąć każdy, aby rozsądnie rozporządzać zasobami finansowymi.
				Dzięki prowadzeniu ewidencji dochodów i wydatków można dokładnie określić miesięczne koszty związane ze stylem i jakością życia.
				Wiedza, dotycząca rozchodu zarobionych pieniędzy, daje poczucie stabilizacji i bezpieczeństwa.</br>
				Człowiek wzbogaca się w momencie, kiedy wydaje mniej pieniędzy niż zarabia. Warto o tym pamiętać, ponieważ jest to złota zasada ludzi osiągających sukces finansowy.</p>
			</div>
		</div>
		
		<div class="col-12">
			<div class="infowin" style="width: 100%; text-align: center; padding: 0; ">
				<img style="opacity:0.7;" src="img/piggy-bank-with-coin.png" width="130"></img>
			</div>
		</div>	
	</div>	
</div>