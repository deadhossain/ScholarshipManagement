<?php 
	/**
	 * 
	 */
	class DonorTable 
	{
		
		public static function donorData($pdata)
		{

			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = $value['NAME'];
					$row [] = $value['PHONE'];
					$row [] = $value['EMAIL'];					

					$editUrl = '/controllers/Donor.php?editDonor='.$value['DONOR_ID'];
					$deleteUrl = '/controllers/Donor.php?deleteDonor='.$value['DONOR_ID'];

					$row[] = '<i action="" modalUrl="'.$editUrl.'" data-modal-size="modal-lg" title="Update Donor" class="modalLink green ace-icon fa fa-pencil bigger-180 editItem"></i>
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