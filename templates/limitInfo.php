<?php
	$upperLimit = $_SESSION['limit'] - $_SESSION['sumAll'];
	if($upperLimit < 0){
		echo 
			"<div class='limitInfo' style='background-color:#b22222'>
				<div class='infoLimitCategoryLeft'>Limit: $_SESSION[limit]</div>
				<div class='infoLimitCategoryRight'>Dotychczas wydano: $_SESSION[howMuchWasSpent]</div><div style='clear:both'></div>
				<div class='infoLimitCategoryLeft'>Pozostało: $_SESSION[howMuchWasLeft]</div>
				<div class='infoLimitCategoryRight'>Wydano + kwota: $_SESSION[sumAll]</div><div style='clear:both'></div>
			</div>";
	}else{
		echo 
			"<div class='limitInfo' style='background-color:#446b43'>
				<div class='infoLimitCategoryLeft'>Limit: $_SESSION[limit]</div>
				<div class='infoLimitCategoryRight'>Dotychczas wydano: $_SESSION[howMuchWasSpent]</div><div style='clear:both'></div>
				<div class='infoLimitCategoryLeft'>Pozostało: $_SESSION[howMuchWasLeft]</div>
				<div class='infoLimitCategoryRight'>Wydano + kwota: $_SESSION[sumAll]</div><div style='clear:both'></div>
			</div>";
	}
?>