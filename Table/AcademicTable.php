<?php 
	require_once '../controllers/Academic.php';
	class AcademicTable 
	{
		public static function academicData($pdata)
		{
			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = $value['STNAME'];
					$row [] = $value['INSTITUTENAME'];
					$row [] = $value['CLASSNAME'];
					$row [] = date('d-m-Y', strtotime($value['START_DT']));
					$row [] = date('d-m-Y', strtotime($value['END_DT']));
					$editUrl = '/controllers/Academic.php?editAcademic='.$value['ACADEMIC_ID'];
					$deleteUrl = '/controllers/Academic.php?deleteAcademic='.$value['ACADEMIC_ID'];

					$row[] = '<i action="" modalUrl="'.$editUrl.'" data-modal-size="modal-md" title="Update Academic info"  class="modalLink green ace-icon fa fa-pencil bigger-180 editItem"></i>
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