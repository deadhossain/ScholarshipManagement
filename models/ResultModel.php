<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class ResultModel
	{
		function __construct()
		{
			
		}

		public static function getAllResultM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM RESULT_TB R
					LEFT JOIN STUDENT_TB S ON R.STUDENT_ID = S.STUDENT_ID
					LEFT JOIN DURATION_TB D ON R.DURATION_ID = D.DURATION_ID";
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

		public static function getResultColM($select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM RESULT_TB R";
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

		public static function createResultM($post)
		{
			$msg=array(
			    'TITLE'=>'Result',
			    'TYPE'=>'Not Created'
		    );
			$markSheetfile = $_FILES['MARKSHEET']['name'];

		    $dataResult =  array(
				'STUDENT_ID' => $_POST['STUDENT_ID'], 
				'DURATION_ID' => $_POST['DURATION_ID'], 
				'SCALE' => $_POST['SCALE'], 
				'GPA' => $_POST['GPA'], 
				'DATE' => date('Y-m-d', strtotime($_POST['DATE'])),
				'EXAMTYPE' => $_POST['EXAMTYPE']
			);

			if (!empty($markSheetfile)) {

		    	$tmp_dir = $_FILES['MARKSHEET']['tmp_name'];
	    		$upload_dir = '../assets/marksheets/';

	    		$selectResult = array("MAX(RESULT_ID)");
				$maxResultId = Database::getNextPrimaryKeyM("RESULT_TB");
				$saveMS = "marksheet_".$maxResultId[0]['PRIMARY_KEY'].".".strtolower(pathinfo($markSheetfile,PATHINFO_EXTENSION));

	    		move_uploaded_file($tmp_dir,$upload_dir.$saveMS);
	    		$dataResult["MARKSHEET"] = $saveMS;
		    }

			$result =  Database::insertData("RESULT_TB",$dataResult);

			if($result)
			{
				$msg=array(
				    'TITLE'=>'Result',
				    'TYPE'=>'inserted'
			    );	
			}
			echo json_encode($msg);
			exit();
		}

		public static function getResultByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM RESULT_TB R WHERE R.RESULT_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function updateResultM($data,$id)
		{
			$markSheetfile = $_FILES['MARKSHEET']['name'];

			$dataResult =  array(
				'STUDENT_ID' => $_POST['STUDENT_ID'], 
				'DURATION_ID' => $_POST['DURATION_ID'], 
				'SCALE' => $_POST['SCALE'], 
				'GPA' => $_POST['GPA'], 
				'DATE' => date('Y-m-d', strtotime($_POST['DATE'])),
				'EXAMTYPE' => $_POST['EXAMTYPE']
			);

			if (!empty($markSheetfile)) {

		    	$tmp_dir = $_FILES['MARKSHEET']['tmp_name'];
	    		$upload_dir = '../assets/MARKSHEETs/result/';
				$saveMS = "ref_".$id.".".strtolower(pathinfo($markSheetfile,PATHINFO_EXTENSION));

	    		move_uploaded_file($tmp_dir,$upload_dir.$saveMS);
	    		$dataResult["MARKSHEET"] = $saveMS;
		    }

			$condition =  array(
				'RESULT_ID' => $id, 
			);

			$result = Database::updateData("RESULT_TB",$dataResult,$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'Result',
				    'TYPE'=>'updated'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Result',
				    'TYPE'=>'Not updated'
			    );
			}
			echo json_encode($msg);
			exit();
		}

		public static function deleteResultM($id)
		{
			$condition =  array(
				'RESULT_ID' => $id, 
			);

			$result = Database::deleteData("RESULT_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'Result',
				    'TYPE'=>'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Result',
				    'TYPE'=>'not deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}
	}
?>
