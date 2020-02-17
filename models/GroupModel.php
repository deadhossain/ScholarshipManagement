<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class GroupModel
	{
		function __construct()
		{
			
		}

		public static function getAllGroupM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT G.GROUP_ID,G.NAME, G.WEEKNO, G.DAYOFWEEK FROM GROUP_TB G";
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

		public static function getGroupColM($select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM GROUP_TB G";
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


		public static function getGroupByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM GROUP_TB G WHERE G.GROUP_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function createGroupM($data)
		{
			$data =  array(
				'NAME' => $_POST['NAME'], 
				'WEEKNO' => $_POST['WEEKNO'], 
				'DAYOFWEEK' => $_POST['DAYOFWEEK']			
			);

			$result =  Database::insertData("GROUP_TB",$data);

			if($result)
			{
				$msg=array(
				    'TITLE'=>$_POST['NAME'],
				    'TYPE'=>'Created'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>$_POST['NAME'],
				    'TYPE'=>'Not Created'
			    );
			}
			echo json_encode($msg);
			exit();
		}

		public static function updateGroupM($data,$id)
		{
			$data =  array(
				'NAME' => $_POST['NAME'], 
				'WEEKNO' => $_POST['WEEKNO'], 
				'DAYOFWEEK' => $_POST['DAYOFWEEK']			
			);

			$condition =  array(
				'GROUP_ID' => $id, 
			);

			$result = Database::updateData("GROUP_TB",$data,$condition);
			
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

		public static function deleteGroupM($id)
		{
			$condition =  array(
				'GROUP_ID' => $id, 
			);

			$result = Database::deleteData("GROUP_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'Group',
				    'TYPE'=>'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Group',
				    'TYPE'=>'not deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}
	}
?>
