<?php 
	/**
	 * 
	 */
	class EmployeeTable 
	{
		
		public static function employeeData($pdata)
		{

			$sl = 0;
			$data   = array();
			if ($pdata) {
				foreach ($pdata as $key => $value) {
					$row =  array();
					$row [] = ++$sl;
					$row [] = $value['NAME'];
					$row [] = date('d/m/Y', strtotime($value['HIRE_DT']));
					$row [] = $value['PHONE'];
					$row [] = $value['EMAIL'];
					$row [] = $value['SALARY'];
					

					$editUrl = '/controllers/Employee.php?editEmployee='.$value['EMPLOYEE_ID'];
					$deleteUrl = '/controllers/Employee.php?deleteEmployee='.$value['EMPLOYEE_ID'];

					$row[] = '<i action="" modalUrl="'.$editUrl.'" data-modal-size="modal-lg" title="Update Employee" class="modalLink green ace-icon fa fa-pencil bigger-180 editItem"></i>
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