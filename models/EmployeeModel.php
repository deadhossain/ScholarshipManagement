<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class EmployeeModel
	{
		function __construct()
		{
			
		}

		public static function getAllEmployeeM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM EMPLOYEE_TB";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    while ($row = $result->fetch_assoc()) {
			    	$rows[] = $row;
			    }
			    return $rows;
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function getEmployeeColM($select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM EMPLOYEE_TB";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				/*$sl = 0;*/
			    while ($row = $result->fetch_assoc()) {
			    	/*array_unshift($row , ++$sl);*/
			    	$rows[] = $row;
			    }
			    return $rows;
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function getEmployeeDataWithConditionM($select,$condition)
		{
			return Database::getDataWithConditionM("EMPLOYEE_TB",$select,$condition);
		}

		public static function createEmployeeM($post)
		{
			$msg=array(
			    'TITLE'=>$_POST['NAME'],
			    'TYPE'=>'Not Created'
		    );

			$imgFile = $_FILES['IMAGE']['name'];

		    $dataEmployee =  array(
				'NAME' => $_POST['NAME'], 
				'PHONE' => $_POST['PHONE'], 
				'EMAIL' => $_POST['EMAIL'], 
				'SALARY' => $_POST['SALARY'], 
				'HIRE_DT' => date('Y-m-d', strtotime($_POST['HIRE_DT'])), 
				'ADDRESS' => $_POST['ADDRESS'], 
				'DISTRICT_ID' => $_POST['DISTRICT_ID'], 
				'DIVISION_ID' => $_POST['DIVISION_ID'],
				'STATUS' => $_POST['STATUS']
			);

			if (!empty($imgFile)) {

		    	$tmp_dir = $_FILES['IMAGE']['tmp_name'];
	    		$upload_dir = '../assets/images/employee/';

	    		$selectEmployee = array("MAX(EMPLOYEE_ID)");
				$maxEmployeeId = Database::getNextPrimaryKeyM("EMPLOYEE_TB");
				$saveImg = "emp_".$maxEmployeeId[0]['PRIMARY_KEY'].".".strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));

	    		move_uploaded_file($tmp_dir,$upload_dir.$saveImg);
	    		$dataEmployee["IMAGE"] = $saveImg;
		    }

			$result =  Database::insertData("EMPLOYEE_TB",$dataEmployee);

			if($result)
			{
				$msg=array(
				    'TITLE'=>$_POST['NAME'],
				    'TYPE'=>'Created'
			    );	
			}
			echo json_encode($msg);
			exit();
		}

		public static function getEmployeeByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM EMPLOYEE_TB WHERE EMPLOYEE_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function updateEmployeeM($data,$id)
		{
			$imgFile = $_FILES['IMAGE']['name'];

		    $dataEmployee =  array(
				'NAME' => $_POST['NAME'], 
				'PHONE' => $_POST['PHONE'], 
				'EMAIL' => $_POST['EMAIL'], 
				'SALARY' => $_POST['SALARY'], 
				'HIRE_DT' => date('Y-m-d', strtotime($_POST['HIRE_DT'])),
				'ADDRESS' => $_POST['ADDRESS'], 
				'DISTRICT_ID' => $_POST['DISTRICT_ID'], 
				'DIVISION_ID' => $_POST['DIVISION_ID'],
				'STATUS' => $_POST['STATUS']
			);

			if (!empty($imgFile)) {

		    	$tmp_dir = $_FILES['IMAGE']['tmp_name'];
	    		$upload_dir = '../assets/images/employee/';
				$saveImg = "emp_".$id.".".strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));

	    		move_uploaded_file($tmp_dir,$upload_dir.$saveImg);
	    		$dataEmployee["IMAGE"] = $saveImg;
		    }

			$condition =  array(
				'EMPLOYEE_ID' => $id, 
			);

			$result = Database::updateData("EMPLOYEE_TB",$dataEmployee,$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>$_POST['NAME'],
				    'TYPE'=>'updated'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>$_POST['NAME'],
				    'TYPE'=>'Not updated'
			    );
			}
			echo json_encode($msg);
			exit();
		}

		public static function deleteEmployeeM($id)
		{
			$condition =  array(
				'EMPLOYEE_ID' => $id, 
			);

			$result = Database::deleteData("EMPLOYEE_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'Employee',
				    'TYPE'=>'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Employee',
				    'TYPE'=>'not deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}
	}
?>
