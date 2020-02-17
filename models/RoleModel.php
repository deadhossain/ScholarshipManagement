<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class RoleModel
	{
		function __construct()
		{
			
		}

		public static function getAllRoleM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM ROLE_TB";
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

		public static function getRoleByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM ROLE_TB D WHERE D.ROLE_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function getRoleColM($select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM ROLE_TB";
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

		public static function getRoleDataWithConditionM($select,$condition)
		{
			return Database::getDataWithConditionM("ROLE_TB",$select,$condition);
		}

		public static function createRoleM($data)
		{
			$data =  array(
				'ROLENAME' => $_POST['ROLENAME'], 
				'DESCRIPTION' => $_POST['DESCRIPTION'], 
			);

			$result =  Database::insertData("ROLE_TB",$data);

			if($result)
			{
				$msg=array(
				    'TITLE'=>$_POST['ROLENAME'],
				    'TYPE'=>'Created'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>$_POST['ROLENAME'],
				    'TYPE'=>'Not Created'
			    );
			}
			echo json_encode($msg);
			exit();	
		}

		public static function updateRoleM($data,$id)
		{
			$data =  array(
				'ROLENAME' => $_POST['ROLENAME'], 
				'DESCRIPTION' => $_POST['DESCRIPTION'], 
			);

			$condition =  array(
				'ROLE_ID' => $id, 
			);

			$result = Database::updateData("ROLE_TB",$data,$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>$_POST['ROLENAME'],
				    'TYPE'=>'updated'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>$_POST['ROLENAME'],
				    'TYPE'=>'Not updated'
			    );
			}
			echo json_encode($msg);
			exit();
		}


		public static function deleteRoleM($id)
		{
			$condition =  array(
				'ROLE_ID' => $id, 
			);

			$result = Database::deleteData("ROLE_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'ROLE',
				    'TYPE'=>'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'ROLE',
				    'TYPE'=>'not deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}
	}
?>

