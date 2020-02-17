<?php 
	require_once '../controllers/Result.php';
	class ResultTable 
	{
		public static function resultData($pdata)
		{
			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = date('d-m-Y', strtotime($value['DATE']));
					$row [] = $value['STNAME'];
					$row [] = $value['CLASSNAME'];
					$row [] = $value['EXAMTYPE'];
					$row [] = $value['SCALE'];
					$row [] = $value['GPA'];
					$row [] = ($value['GPA']/$value['SCALE'])*100;
					/*$row [] = '<button class="btn btn-app btn-grey btn-xs radius-4"><i class="glyphicon glyphicon-file"></i></button>';*/
					$editUrl = '/controllers/Result.php?editResult='.$value['RESULT_ID'];
					$deleteUrl = '/controllers/Result.php?deleteResult='.$value['RESULT_ID'];

					$row[] = '<i action="" modalUrl="'.$editUrl.'" data-modal-size="modal-md" title="Update Result"  class="modalLink green ace-icon fa fa-pencil bigger-180 editItem"></i>
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