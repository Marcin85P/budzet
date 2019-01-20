<?php

	class BalanceData{
		public $b_date;
		public $category;
		public $amount;
		public $comment;
		
		function __construct($b_date, $category, $amount, $comment){
			$this->b_date = $b_date;
			$this->category = $category;
			$this->amount = $amount;
			$this->comment= $comment;
		}
	}