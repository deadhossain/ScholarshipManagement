<?php 
	class RoleTable 
	{
		public static function roleData($pdata)
		{
			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = $value['ROLENAME'];
					$row [] = $value['DESCRIPTION'];
					$editUrl = '/controllers/Role.php?editRole='.$value['ROLE_ID'];
					$deleteUrl = '/controllers/Role.php?deleteRole='.$value['ROLE_ID'];

					$row[] = '<i action="" modalUrl="'.$editUrl.'" title="Update Role"  data-modal-size="modal-sm" class="modalLink green ace-icon fa fa-pencil bigger-180 editItem"></i>
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