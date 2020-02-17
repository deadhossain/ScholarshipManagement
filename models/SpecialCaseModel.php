<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class SpecialCaseModel
	{
		function __construct()
		{
			
		}

		public static function getAllSpecialCaseM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM ALLOWANCE_TB A 
					LEFT JOIN STUDENT_TB S ON A.STUDENT_ID = S.STUDENT_ID  
					LEFT JOIN CHILD_LOOKUP_TB CLT ON A.STATUS = CLT.CLU_ID  
					WHERE A.STATUS <> 15";
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

		

		

		public static function updateSpecialCaseM($data,$id)
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
				    'TITLE'=>'SpecialCase',
				    'TYPE'=>'added'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'SpecialCase',
				    'TYPE'=>'Not added'
			    );
			}
			echo json_encode($msg);
			exit();
		}

		public static function paySpecialCaseM($id)
		{
			$data =  array(
				'STATUS' => 15, 
			);

			$condition =  array(
				'ALLOWANCE_ID' => $id, 
			);

			$result = Database::updateData("ALLOWANCE_TB",$data,$condition);

			if($result)
			{
				$msg=array(
				    'TITLE'=>'SpecialCase',
				    'TYPE'=>'paid'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'SpecialCase',
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
				    'TITLE'=>'SpecialCase',
				    'TYPE'=>'paid'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'SpecialCase',
				    'TYPE'=>'Not paid'
			    );
			}
			echo json_encode($msg);
			exit();	
		}


	}
?>
