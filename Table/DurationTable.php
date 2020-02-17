<?php 
	class DurationTable 
	{
		public static function durationData($pdata)
		{
			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = $value['CLASSNAME'];
					$row [] = $value['DURATION'];
					$editUrl = '/controllers/Duration.php?editDuration='.$value['DURATION_ID'];
					$deleteUrl = '/controllers/Duration.php?deleteDuration='.$value['DURATION_ID'];

					$row[] = '<i action="" modalUrl="'.$editUrl.'" title="Update Duration"  data-modal-size="modal-sm" class="modalLink green ace-icon fa fa-pencil bigger-180 editItem"></i>
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