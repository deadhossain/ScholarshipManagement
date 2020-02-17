<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class DurationModel
	{
		function __construct()
		{
			
		}

		public static function getAllDurationM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM DURATION_TB D";
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

		public static function getDurationByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM DURATION_TB D WHERE D.DURATION_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function getDurationColM($select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM DURATION_TB";
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

		public static function getDurationDataWithConditionM($select,$condition)
		{
			return Database::getDataWithConditionM("DURATION_TB",$select,$condition);
		}

		public static function createDurationM($data)
		{
			$data =  array(
				'CLASSNAME' => $_POST['CLASSNAME'], 
				'DURATION' => $_POST['DURATION'], 
			);

			$result =  Database::insertData("DURATION_TB",$data);

			if($result)
			{
				$msg=array(
				    'TITLE'=>$_POST['CLASSNAME'],
				    'TYPE'=>'Created'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>$_POST['CLASSNAME'],
				    'TYPE'=>'Not Created'
			    );
			}
			echo json_encode($msg);
			exit();	
		}

		public static function updateDurationM($data,$id)
		{
			$data =  array(
				'CLASSNAME' => $_POST['CLASSNAME'], 
				'DURATION' => $_POST['DURATION'], 
			);

			$condition =  array(
				'DURATION_ID' => $id, 
			);

			$result = Database::updateData("DURATION_TB",$data,$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>$_POST['CLASSNAME'],
				    'TYPE'=>'updated'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>$_POST['CLASSNAME'],
				    'TYPE'=>'Not updated'
			    );
			}
			echo json_encode($msg);
			exit();
		}


		public static function deleteDurationM($id)
		{
			$condition =  array(
				'DURATION_ID' => $id, 
			);

			$result = Database::deleteData("DURATION_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'DURATION',
				    'TYPE'=>'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'DURATION',
				    'TYPE'=>'not deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}


	}
?>
