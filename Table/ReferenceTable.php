<?php 
	/*require_once '/controllers/User.php';*/
	/*$data = new User();
	$allUser = $data->getAllUserData();
	var_dump($allUser);*/

	/**
	 * 
	 */
	class ReferenceTable 
	{
		
		public static function referenceData($pdata)
		{

			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = $value['NAME'];
					$row [] = $value['UPPERLIMIT'];
					$row [] = $value['PHONE'];
					$row [] = $value['EMAIL'];
					$row [] = ($value['LIMIT_FLAG']=='Y')?"Average":"High";

					$editUrl = '/controllers/Reference.php?editReference='.$value['REF_ID'];
					$deleteUrl = '/controllers/Reference.php?deleteReference='.$value['REF_ID'];

					$row[] = '<i action="" modalUrl="'.$editUrl.'" data-modal-size="modal-lg" title="Update Reference"  class="modalLink green ace-icon fa fa-pencil bigger-180 editItem"></i>
							  <a class="red confirm" href="#" action="'.$deleteUrl.'">
								<i class="ace-icon fa fa-trash-o bigger-180"></i>
							  </a>';
					$data[] = $row;
				}
			}
					
			
			$output =  array(
				'data' => $data 
			);
			return $output;
		}
	}
?>