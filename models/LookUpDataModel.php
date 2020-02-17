<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class LookUpDataModel
	{
		function __construct()
		{
			
		}		

		public static function getAllLookUpDataM()
		{
			/*$db = new Database();*/
			$conn = Database::databaseConnection();
			
			$sql = "SELECT * FROM PARENT_LOOKUP_TB PL LEFT JOIN CHILD_LOOKUP_TB CL ON PL.PLU_ID = CL.PLU_ID";
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


		public static function getLookUpDataByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM PARENT_LOOKUP_TB PL LEFT JOIN CHILD_LOOKUP_TB CL ON PL.PLU_ID = CL.PLU_ID WHERE CL.PLU_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}


		public static function getLookUpDataWithConditionM($select,$condition)
		{
			return Database::getDataWithConditionM("CHILD_LOOKUP_TB",$select,$condition);
		}

		


	}
?>

