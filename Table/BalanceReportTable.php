<?php 
	class BalanceReportTable 
	{
		public static function balanceReportData($pdata)
		{
			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = date('M-Y', strtotime($value['DATE']));;
					$row [] = $value['OPENING_BALANCE'];
					$row [] = $value['DONATION'];
					$row [] = $value['DONATION'] + $value['OPENING_BALANCE'];
					$row [] = $value['TOTAL_COST'];
					$row [] = $value['DONATION'] + $value['OPENING_BALANCE'] - $value['TOTAL_COST'];
					$data[] = $row;
				}
			}
			
			$output=array(
	            "data" => $data
	        );
			return $output;
		}
	}
?>