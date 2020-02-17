<?php 
	class BalanceTable 
	{
		public static function balanceData($pdata)
		{
			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = $value['DATE'];
					$row [] = $value['NAME'];
					$row [] = $value['CLUNAME'];
					$row [] = $value['AMOUNT'];
					$editUrl = '/controllers/Balance.php?editBalance='.$value['BALANCE_ID'];
					$deleteUrl = '/controllers/Balance.php?deleteBalance='.$value['BALANCE_ID'];

					$row[] = '<i action="" modalUrl="'.$editUrl.'" title="Update Balance"  data-modal-size="modal-md" class="modalLink green ace-icon fa fa-pencil bigger-180 editItem"></i>
							  <a class="red confirm" href="#" action="'.$deleteUrl.'">
								<i class="ace-icon fa fa-trash-o bigger-180"></i>
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