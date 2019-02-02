<?php

	class BalanceData{
		public $b_date;
		public $category;
		public $amount;
		public $comment;
		public $payment_method;
		
		function __construct($b_date, $category, $amount, $comment,$payment_method){
			$this->b_date = $b_date;
			$this->category = $category;
			$this->amount = $amount;
			$this->comment = $comment;
			$this->payment_method = $payment_method;
		}
	}