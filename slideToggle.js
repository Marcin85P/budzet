$(function(){

	$("[name = 'one']").click(function(){
		$("[name = 'incomes']").slideToggle('fast');
		$("[name = 'expenses']").slideUp('fast');
		$("[name = 'payment']").slideUp('fast');
		
		$("[name = 'two']").css("background-color","#2e303d");
		$("[name = 'three']").css("background-color","#2e303d");
		
		var color = $(this).css("background-color");
		
		if(color == 'rgb(178, 34, 34)'){
			$(this).css("background-color","#2e303d");
		}
		else
			$(this).css("background-color","#b22222");
	});

	$("[name = 'two']").click(function(){
		$("[name = 'expenses']").slideToggle('fast');
		$("[name = 'incomes']").slideUp('fast');
		$("[name = 'payment']").slideUp('fast');
		
		$("[name = 'one']").css("background-color","#2e303d");
		$("[name = 'three']").css("background-color","#2e303d");
		
		var color = $(this).css("background-color");
		
		if(color == 'rgb(178, 34, 34)'){
			$(this).css("background-color","#2e303d");
		}
		else
			$(this).css("background-color","#b22222");
	});

	$("[name = 'three']").click(function(){
		$("[name = 'payment']").slideToggle('fast');
		$("[name = 'incomes']").slideUp('fast');
		$("[name = 'expenses']").slideUp('fast');
		
		$("[name = 'one']").css("background-color","#2e303d");
		$("[name = 'two']").css("background-color","#2e303d");
		
		var color = $(this).css("background-color");
		
		if(color == 'rgb(178, 34, 34)'){
			$(this).css("background-color","#2e303d");
		}
		else
			$(this).css("background-color","#b22222");
	});
	
	$("[name = 'four']").click(function(){
		$("[name = 'payment']").slideUp('fast');
		$("[name = 'incomes']").slideUp('fast');
		$("[name = 'expenses']").slideUp('fast');
		
		$("[name = 'one']").css("background-color","#2e303d");
		$("[name = 'two']").css("background-color","#2e303d");
		$("[name = 'three']").css("background-color","#2e303d");
	});
});