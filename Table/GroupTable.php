<?php 
	class GroupTable 
	{
		public static function groupData($pdata)
		{
			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = $value['NAME'];
					$row [] = $value['WEEKNO'];
					$row [] = $value['DAYOFWEEK'];
					
					$editUrl = '/controllers/Group.php?editGroup='.$value['GROUP_ID'];
					$deleteUrl = '/controllers/Group.php?deleteGroup='.$value['GROUP_ID'];

					$row[] = '<i action="" modalUrl="'.$editUrl.'" data-modal-size="modal-sm" title="Update Group"  class="modalLink green ace-icon fa fa-pencil bigger-180 editItem"></i>
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