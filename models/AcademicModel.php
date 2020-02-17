<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class AcademicModel
	{
		function __construct()
		{
			
		}

		public static function getAllAcademicM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM ACADEMIC_TB A 
					LEFT JOIN STUDENT_TB S ON A.STUDENT_ID = S.STUDENT_ID
					LEFT JOIN DURATION_TB D ON A.DURATION_ID = D.DURATION_ID";
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

		public static function getAcademicColM($select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM ACADEMIC_TB G";
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


		public static function getAcademicByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM ACADEMIC_TB WHERE ACADEMIC_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function createAcademicM($data)
		{
			$dataAcademic =  array(
				'STUDENT_ID' => $_POST['STUDENT_ID'], 
				'DURATION_ID' => $_POST['DURATION_ID'], 
				'INSTITUTENAME' => $_POST['INSTITUTENAME'],
				'START_DT' => date('Y-m-d', strtotime($_POST['START_DT'])),
				'END_DT' => date('Y-m-d', strtotime($_POST['END_DT']))		
			);

			$result =  Database::insertData("ACADEMIC_TB",$dataAcademic);

			if($result)
			{
				$msg=array(
				    'TITLE'=> 'Information',
				    'TYPE'=> 'inserted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Information',
				    'TYPE'=>'inserted'
			    );
			}
			echo json_encode($msg);
			exit();
		}

		public static function updateAcademicM($data,$id)
		{
			$dataAcademic =  array(
				'STUDENT_ID' => $_POST['STUDENT_ID'], 
				'DURATION_ID' => $_POST['DURATION_ID'], 
				'INSTITUTENAME' => $_POST['INSTITUTENAME'],
				'START_DT' => date('Y-m-d', strtotime($_POST['START_DT'])),
				'END_DT' => date('Y-m-d', strtotime($_POST['END_DT']))		
			);

			$condition =  array(
				'ACADEMIC_ID' => $id, 
			);

			$result = Database::updateData("ACADEMIC_TB",$dataAcademic,$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=> 'Information',
				    'TYPE'=> 'inserted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Information',
				    'TYPE'=>'inserted'
			    );
			}
			echo json_encode($msg);
			exit();
		}

		public static function deleteAcademicM($id)
		{
			$condition =  array(
				'ACADEMIC_ID' => $id, 
			);

			$result = Database::deleteData("ACADEMIC_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=> 'Information',
				    'TYPE'=> 'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Information',
				    'TYPE'=>'deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}
	}
?>
