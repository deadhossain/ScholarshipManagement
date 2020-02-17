<?php

	/**
	  * 
	  */
	class GlobalFunctions 
	{
	 	
	 	public function dayOfWeek()
		{
			return $dowMap = array('Sat','Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri');
		}

		public static function ordinalWeek($num)
		{
			$dowMap = array('First','Second', 'Third', 'Fourth', 'Fifth');
			return $dowMap[$num];
		}

		public static function ordinal($number) {
		    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
		    if ((($number % 100) >= 11) && (($number%100) <= 13))
		        return $number. 'th';
		    else
		        return $number. $ends[$number % 10];
		}
	} 
	
?>