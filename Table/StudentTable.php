<?php 
	require_once '../controllers/Student.php';
	class StudentTable 
	{
		public static function studentData($pdata)
		{
			$sl = 0;
			
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					/*$style = "label label-success";*/
					$row =  array();
					$row [] = ++$sl;
					$row [] = $value['CARDNO'];
					$row [] = $value['STNAME'];
					$row [] = $value['PHONE'];
					$row [] = $value['ALLOWANCE'];
					if ($value['STATUS']=== '4') {
						$style = 'label label-danger';
					}
					else if ($value['STATUS']=== '3') {
						$style = 'label label-warning';
					}
					else if ($value['STATUS']=== '5') {
						$style = 'label label-info';
					}
					else if ($value['STATUS']=== '9') {
						$style = 'label label-success';
					}
					else if ($value['STATUS']=== '6') {
						$style = 'label label-primary';
					}
					$row [] = '<span class="'.$style.'">'.$value['CLUNAME'].'</span>';
					$editUrl = '/controllers/Student.php?editStudent='.$value['STUDENT_ID'];
					$deleteUrl = '/controllers/Student.php?deleteStudent='.$value['STUDENT_ID'];

					$row[] = '<i action="" modalUrl="'.$editUrl.'" data-modal-size="modal-bg" title="Update Student"  class="modalLink green ace-icon fa fa-pencil bigger-180 editItem"></i>
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