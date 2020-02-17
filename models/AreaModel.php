<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class AreaModel
	{
		function __construct()
		{
			
		}

		public static function getAllDivisionM()
		{
			
			$conn = Database::databaseConnection();
			
			$sql = "SELECT * FROM DIVISIONS";
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

		public static function getAreaColM($tableName,$select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM ".$tableName;
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

		public static function getDivisionWiseDistrictsM($id)
		{
			
			$conn = Database::databaseConnection();
			
			$sql = "SELECT id,name FROM DISTRICTS WHERE DIVISION_ID = ".$id;
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
	}
?>

