<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class SalaryModel
	{
		function __construct()
		{
			
		}

		public static function checkTotalSalaryM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT SUM(S.AMOUNT) AS TOTAL_SALARY
					FROM  SALARY_TB S WHERE S.PAYMENTSTATUS = 12 
					";
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

		public static function getAllSalaryM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM SALARY_TB S 
					LEFT JOIN EMPLOYEE_TB E ON S.EMPLOYEE_ID = E.EMPLOYEE_ID
					LEFT JOIN CHILD_LOOKUP_TB CLT ON S.PAYMENTSTATUS = CLT.CLU_ID ORDER BY S.SAL_ID";
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

		public static function getSalaryByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM SALARY_TB WHERE SAL_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function getSalaryColM($select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM SALARY_TB";
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

		public static function getAllSalaryUsingDateRangeM($sdate, $edate)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM SALARY_TB S 
					left join EMPLOYEE_TB E ON S.EMPLOYEE_ID = E.EMPLOYEE_ID
					LEFT JOIN CHILD_LOOKUP_TB CLT ON S.PAYMENTSTATUS = CLT.CLU_ID
					WHERE S.SAL_ID>0";

			if (!empty($sdate)) {
				$sql = $sql." AND S.DATE BETWEEN '".date('Y-m-d', strtotime($sdate))."' AND '".date('Y-m-d', strtotime($edate))."'";
			}
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

		public static function getSalaryDataWithConditionM($select,$condition)
		{
			return Database::getDataWithConditionM("SALARY_TB",$select,$condition);
		}

		public static function createSalaryM($data)
		{
			$data =  array(
				'AMOUNT' => $_POST['AMOUNT'], 
				'EMPLOYEE_ID' => $_POST['EMPLOYEE_ID'], 
				'DATE' => date('Y-m-d', strtotime($_POST['DATE'])), 
				'PAYMENTSTATUS' => $_POST['PAYMENTSTATUS'], 
				'REMARKS' => $_POST['REMARKS'], 
				'BONUS' => $_POST['BONUS'], 
			);

			$result =  Database::insertData("SALARY_TB",$data);

			if($result)
			{
				$msg=array(
				    'TITLE'=>'Salary',
				    'TYPE'=>'added'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Salary',
				    'TYPE'=>'Not added'
			    );
			}
			echo json_encode($msg);
			exit();	
		}

		public static function updateSalaryM($data,$id)
		{
			$data =  array(
				'AMOUNT' => $_POST['AMOUNT'], 
				'EMPLOYEE_ID' => $_POST['EMPLOYEE_ID'], 
				'DATE' => date('Y-m-d', strtotime($_POST['DATE'])), 
				'PAYMENTSTATUS' => $_POST['PAYMENTSTATUS'], 
				'REMARKS' => $_POST['REMARKS'], 
				'BONUS' => $_POST['BONUS'], 
			);

			$condition =  array(
				'SAL_ID' => $id, 
			);

			$result = Database::updateData("SALARY_TB",$data,$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'Salary',
				    'TYPE'=>'PAID'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Salary',
				    'TYPE'=>'Not PAID'
			    );
			}
			echo json_encode($msg);
			exit();
		}


		public static function deleteSalaryM($id)
		{
			$condition =  array(
				'SAL_ID' => $id, 
			);

			$result = Database::deleteData("SALARY_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'INFOMATION',
				    'TYPE'=>'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'INFOMATION',
				    'TYPE'=>'not deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}


	}
?>
