<?php 
	require_once '../controllers/User.php';
	class UserTable 
	{
		public static function userData($pdata)
		{
			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = $value['USERNAME'];
					$row [] = $value['ROLENAME'];
					$editUrl = '/controllers/User.php?editUser='.$value['USER_ID'];
					$deleteUrl = '/controllers/User.php?deleteUser='.$value['USER_ID'];

					$row[] = '<i action="" modalUrl="'.$editUrl.'" data-modal-size="modal-md" title="Update User"  class="modalLink green ace-icon fa fa-pencil bigger-180 editItem"></i>
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