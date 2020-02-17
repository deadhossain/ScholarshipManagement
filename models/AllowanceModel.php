<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class AllowanceModel
	{
		function __construct()
		{
			
		}

		public static function checkTotalAllowanceM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT SUM(A.ALLOWANCE) AS TOTAL_ALLOWANCE
					FROM  ALLOWANCE_TB A WHERE A.STATUS = 15
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

		public static function getAllAllowanceM($id, $sdate, $edate)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM ALLOWANCE_TB A 
					left join STUDENT_TB S ON A.STUDENT_ID = S.STUDENT_ID
					left join GROUP_TB G ON S.GROUP_ID = G.GROUP_ID
					LEFT JOIN CHILD_LOOKUP_TB CLT ON A.STATUS = CLT.CLU_ID
					WHERE S.STUDENT_ID>0";

			if (!empty($id)) {
				$sql = $sql." AND S.GROUP_ID = ".$id;
			}
			if (!empty($sdate)) {
				$sql = $sql." AND A.RECEIVED_DT BETWEEN '".date('Y-m-d', strtotime($sdate))."' AND '".date('Y-m-d', strtotime($edate))."'";
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


		public static function showGroupWiseStudentM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM STUDENT_TB S WHERE S.GROUP_ID = ".$id." AND S.STATUS = 3 AND S.STUDENT_ID NOT IN 
						(SELECT A.STUDENT_ID FROM ALLOWANCE_TB A WHERE MONTH(A.RECEIVED_DT) = ".date("m").")";
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

		public static function getAllowanceByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM ALLOWANCE_TB WHERE ALLOWANCE_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function getAllowanceColM($select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM ALLOWANCE_TB";
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

		public static function getAllowanceDataWithConditionM($select,$condition)
		{
			return Database::getDataWithConditionM("ALLOWANCE_TB",$select,$condition);
		}

		public static function createAllowanceM($data)
		{
			$data =  array(
				'AMOUNT' => $_POST['AMOUNT'], 
				'DONOR_ID' => $_POST['DONOR_ID'], 
				'DATE' => date('Y-m-d', strtotime($_POST['DATE'])), 
				'PAYMENTTYPE' => $_POST['PAYMENTTYPE'], 
			);

			$result =  Database::insertData("ALLOWANCE_TB",$data);

			if($result)
			{
				$msg=array(
				    'TITLE'=>'Allowance',
				    'TYPE'=>'added'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Allowance',
				    'TYPE'=>'Not added'
			    );
			}
			echo json_encode($msg);
			exit();	
		}

		public static function updateAllowanceM($data,$id)
		{
			$data =  array(
				'AMOUNT' => $_POST['AMOUNT'], 
				'DONOR_ID' => $_POST['DONOR_ID'], 
				'DATE' => date('Y-m-d', strtotime($_POST['DATE'])), 
				'PAYMENTTYPE' => $_POST['PAYMENTTYPE'], 
			);

			$condition =  array(
				'ALLOWANCE_ID' => $id, 
			);

			$result = Database::updateData("ALLOWANCE_TB",$data,$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'Allowance',
				    'TYPE'=>'added'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Allowance',
				    'TYPE'=>'Not added'
			    );
			}
			echo json_encode($msg);
			exit();
		}


		public static function deleteAllowanceM($id)
		{
			$condition =  array(
				'ALLOWANCE_ID' => $id, 
			);

			$result = Database::deleteData("ALLOWANCE_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'ALLOWANCE',
				    'TYPE'=>'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'ALLOWANCE',
				    'TYPE'=>'not deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}


		public static function payAllowanceM($id)
		{
			$data =  array(
				'STUDENT_ID' => $id, 
				'RECEIVED_DT' => date('Y-m-d')
			);

			$result =  Database::insertData("ALLOWANCE_TB",$data);

			if($result)
			{
				$msg=array(
				    'TITLE'=>'Allowance',
				    'TYPE'=>'paid'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Allowance',
				    'TYPE'=>'Not paid'
			    );
			}
			echo json_encode($msg);
			exit();	
		}


		public static function notPaidSinglePersonUrlM($data,$id)
		{
			$data =  array(
				'STUDENT_ID' => $id, 
				'RECEIVED_DT' => date('Y-m-d'),
				'REMARKS' => $_POST['REMARKS'],
				'STATUS' => $_POST['STATUS']
			);

			$result =  Database::insertData("ALLOWANCE_TB",$data);

			if($result)
			{
				$msg=array(
				    'TITLE'=>'Allowance',
				    'TYPE'=>'paid'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Allowance',
				    'TYPE'=>'Not paid'
			    );
			}
			echo json_encode($msg);
			exit();	
		}


	}
?>
