<?php 
	class SalaryTable 
	{
		public static function salaryData($pdata)
		{
			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = $value['DATE'];
					$row [] = $value['NAME'];
					$row [] = $value['AMOUNT']+$value['BONUS'];
					$row [] = $value['CLUNAME'];
					$editUrl = '/controllers/Salary.php?editSalary='.$value['SAL_ID'];
					$deleteUrl = '/controllers/Salary.php?deleteSalary='.$value['SAL_ID'];

					$row[] = '<i action="" modalUrl="'.$editUrl.'" title="Update Salary"  data-modal-size="modal-md" class="modalLink green ace-icon fa fa-pencil bigger-180 editItem"></i>
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