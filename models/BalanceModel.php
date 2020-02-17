<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class BalanceModel
	{
		function __construct()
		{
			
		}

		public static function getAllBalanceM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM BALANCE_TB B 
					LEFT JOIN DONOR_TB D ON B.DONOR_ID = D.DONOR_ID
					LEFT JOIN CHILD_LOOKUP_TB CLT ON B.PAYMENTTYPE = CLT.CLU_ID";
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


		public static function checkTotalBalanceM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT SUM(B.AMOUNT) AS TOTAL_BALANCE
					FROM  BALANCE_TB B 
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


		public static function monthlyBalanceReport()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT SUM(B.AMOUNT)-SUM(A.ALLOWANCE)-SUM(S.AMOUNT) AS BALANCE
					FROM ALLOWANCE_TB A, BALANCE_TB B , SALARY_TB S
					WHERE A.STATUS = 15 AND S.PAYMENTSTATUS = 12";
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

		public static function getBalanceByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM BALANCE_TB WHERE BALANCE_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function getBalanceColM($select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM BALANCE_TB";
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

		public static function getBalanceDataWithConditionM($select,$condition)
		{
			return Database::getDataWithConditionM("BALANCE_TB",$select,$condition);
		}

		public static function createBalanceM($data)
		{
			$data =  array(
				'AMOUNT' => $_POST['AMOUNT'], 
				'DONOR_ID' => $_POST['DONOR_ID'], 
				'DATE' => date('Y-m-d', strtotime($_POST['DATE'])), 
				'PAYMENTTYPE' => $_POST['PAYMENTTYPE'], 
			);

			$result =  Database::insertData("BALANCE_TB",$data);

			if($result)
			{
				$msg=array(
				    'TITLE'=>'Balance',
				    'TYPE'=>'added'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Balance',
				    'TYPE'=>'Not added'
			    );
			}
			echo json_encode($msg);
			exit();	
		}

		public static function updateBalanceM($data,$id)
		{
			$data =  array(
				'AMOUNT' => $_POST['AMOUNT'], 
				'DONOR_ID' => $_POST['DONOR_ID'], 
				'DATE' => date('Y-m-d', strtotime($_POST['DATE'])), 
				'PAYMENTTYPE' => $_POST['PAYMENTTYPE'], 
			);

			$condition =  array(
				'BALANCE_ID' => $id, 
			);

			$result = Database::updateData("BALANCE_TB",$data,$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'Balance',
				    'TYPE'=>'added'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Balance',
				    'TYPE'=>'Not added'
			    );
			}
			echo json_encode($msg);
			exit();
		}


		public static function deleteBalanceM($id)
		{
			$condition =  array(
				'BALANCE_ID' => $id, 
			);

			$result = Database::deleteData("BALANCE_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'BALANCE',
				    'TYPE'=>'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'BALANCE',
				    'TYPE'=>'not deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}


	}
?>
