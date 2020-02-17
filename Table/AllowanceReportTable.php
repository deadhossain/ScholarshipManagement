<?php 
	class AllowanceReportTable 
	{
		public static function allowanceReportTableData($pdata)
		{
			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = date('d-m-Y', strtotime($value['RECEIVED_DT']));
					$row [] = $value['CARDNO'];
					$row [] = $value['STNAME'];
					
					
					$row [] = $value['CLUNAME'];
					$row [] = $value['ALLOWANCE'];
					/*$payAllowance = '/controllers/Allowance.php?payAllowance='.$value['STUDENT_ID'];
					$absentUrl = '/controllers/Allowance.php?notPaidSinglePersonUrl='.$value['STUDENT_ID'];*/

					/*$row[] = '<a class="green confirm" href="#" action="'.$payAllowance.'">
								<i class="ace-icon fa fa-check-square-o bigger-180"></i>
							  </a>
							  <i action="" modalUrl="'.$absentUrl.'" title="Allowance"  data-modal-size="modal-md" class="modalLink  red ace-icon fa fa-times bigger-180 editItem"></i>';*/
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