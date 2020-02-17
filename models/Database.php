<?php 
	class Database 
	{
		private static $userName;
  		private static $password;
  		private static $dbName;
  		private static $dbHost;
		
		/*public function __construct()
		{
			$config = include '/../config.php';
			self::$dbHost = $config->host;
			self::$dbName = $config->database;
			self::$userName = $config->userName;
			self::$password = $config->password;	
		}*/

		public static function databaseConnection()
		{
			$config = include '../config.php';
			$dbHost = $config->host;
			$dbName = $config->database;
			$userName = $config->userName;
			$password = $config->password;
			return mysqli_connect($dbHost,$userName,$password,$dbName);	
		}

		public static function insertData($tableName,$data)
		{
			$conn = self::databaseConnection();
			/*$sql = "INSERT into ". $tableName ." (";*/
			$key = array_keys($data);
		    $val = array_values($data);

		    $sql = "INSERT INTO $tableName (" . implode(', ', $key) . ") "
		         . "VALUES ('" . implode("', '", $val) . "')";

		    if($conn->query($sql) === true){
			    return true;
			} else{
			    echo "ERROR: Could not able to execute $sql. " . $conn->error;
			}     
		}

		public static function updateData($tableName,$data,$condition)
		{
			$conn = self::databaseConnection();
		    $cols = array();
		    $whereCols = array();
		    foreach($data as $key=>$val) {
		        $cols[] = "$key = '$val'";
		    }

		    foreach($condition as $key=>$val) {
		        $whereCols[] = "$key = '$val'";
		    }
		    $sql = "UPDATE $tableName SET " . implode(', ', $cols) . " WHERE ". implode(', ', $whereCols)  ;
		    if($conn->query($sql) === true){
			    return true;
			} else{
			    echo "ERROR: Could not able to execute $sql. " . $conn->error;
			}
		}

		public static function getDataWithConditionM($tableName,$select,$condition)
		{
		    $col = array_values($select);
			$conn = Database::databaseConnection();

			$whereCols = array();
			foreach($condition as $key=>$val) {
		        $whereCols[] = "$key = '$val'";
		    }

			$sql = "SELECT ". implode(', ', $col) ." FROM $tableName WHERE ".implode(', ', $whereCols);
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

		public static function getDataWithRawQueryM($query)
		{
			$conn = Database::databaseConnection();
			$sql = $query;
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

		public static function deleteData($tableName,$condition)
		{
			$conn = self::databaseConnection();
		    $whereCols = array();
		    

		    foreach($condition as $key=>$val) {
		        $whereCols[] = "$key = '$val'";
		    }
		    $sql = "DELETE FROM $tableName WHERE ". implode(', ', $whereCols);
		    if($conn->query($sql) === true){
			    return true;
			} else{
			    echo "ERROR: Could not able to execute $sql. " . $conn->error;
			}
		}

		public static function checkAuthentication($data)
		{
			$conn = self::databaseConnection();

			$userName =  mysqli_real_escape_string($conn, $data['USERNAME']);
			$password =  mysqli_real_escape_string($conn, $data['PASSWORD']);

			$sql = "SELECT * FROM USER_TB where USERNAME = '$userName' and  PASSWORD = '$password'";

			$result = $conn->query($sql);
			/*var_dump($conn->error);*/
			if ($result->num_rows > 0) {
			    return true;
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function getTableColM($tableName,$select)
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

		public static function getNextPrimaryKeyM($tableName)
		{
			$conn = Database::databaseConnection();
			$sql = 'SELECT AUTO_INCREMENT as PRIMARY_KEY
						FROM information_schema.TABLES
						WHERE TABLE_SCHEMA = "scholarship_db"
						AND TABLE_NAME = "'.$tableName.'"';
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
	}

	
?>