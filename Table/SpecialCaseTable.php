<?php 
	class SpecialCaseTable 
	{
		public static function specialCaseData($pdata)
		{
			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = $value['CARDNO'];
					$row [] = $value['STNAME'];
					$row [] = $value['ALLOWANCE'];
					$row [] = $value['CLUNAME'];
					$paySpecialCase = '/controllers/SpecialCase.php?paySpecialCase='.$value['ALLOWANCE_ID'];

					$row[] = '<a class="green confirm" href="#" action="'.$paySpecialCase.'">
								<i class="ace-icon fa fa-check-square-o bigger-180"></i>
							  </a>';
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