<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class UserModel
	{
		function __construct()
		{
			
		}

		public static function getAllUserM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT U.USER_ID, U.USERNAME, R.ROLENAME FROM USER_TB U LEFT JOIN ROLE_TB R ON U.ROLE_ID = R.ROLE_ID";
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

		public static function getUserByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM USER_TB U WHERE U.USER_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function createUserM($data)
		{
			$data =  array(
				'USERNAME' => $_POST['USERNAME'], 
				'PASSWORD' => $_POST['PASSWORD'], 
				'ROLE_ID' => $_POST['ROLE_ID'], 
			);
			$result = Database::insertData("USER_TB",$data);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>$_POST['USERNAME'],
				    'TYPE'=>'Created'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>$_POST['USERNAME'],
				    'TYPE'=>'Not Created'
			    );
			}
			echo json_encode($msg);
			exit();
		}

		public static function updateUserM($data,$id)
		{
			$data =  array(
				'USERNAME' => $_POST['USERNAME'], 
				'PASSWORD' => $_POST['PASSWORD'], 
				'ROLE_ID' => $_POST['ROLE_ID'], 
			);

			$condition =  array(
				'USER_ID' => $id, 
			);

			$result = Database::updateData("USER_TB",$data,$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>$_POST['USERNAME'],
				    'TYPE'=>'updated'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>$_POST['USERNAME'],
				    'TYPE'=>'Not updated'
			    );
			}
			echo json_encode($msg);
			exit();
		}

		public static function deleteUserM($id)
		{
			$condition =  array(
				'USER_ID' => $id, 
			);

			$result = Database::deleteData("USER_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'user',
				    'TYPE'=>'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'user',
				    'TYPE'=>'not deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}
	}
?>
