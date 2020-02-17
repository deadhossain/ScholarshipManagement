<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class StudentModel
	{
		function __construct()
		{
			
		}


		public static function createStudentM($data)
		{
			$dataGuardian =  array(
				'GNAME' => $_POST['GNAME'],
			    'GRELATION' => $_POST['GRELATION'],
			    'GPHONE' => $_POST['GPHONE'],
			    'GEMAIL' => $_POST['GEMAIL'],
			    'GNATIONALID' => $_POST['GNATIONALID'],
			    /*'GGENDER' => $_POST['GGENDER'],*/
			);
			$result = Database::insertData("GUARDIAN_TB",$dataGuardian);

			$selectGuardian = array("MAX(GUARDIAN_ID)");
			$maxGId = Database::getTableColM("GUARDIAN_TB",$selectGuardian);

			$imgFile = $_FILES['IMAGE']['name'];

			$dataStudent =  array(
				'STNAME' => $_POST['STNAME'],
			    'CARDNO' => $_POST['CARDNO'],
			    'PHONE' => $_POST['PHONE'],
			    'EMAIL' => $_POST['EMAIL'],
			    'NATIONALID' => $_POST['NATIONALID'],
			    /*'STARTDT' => date('Y-m-d', strtotime($_POST['STARTDT'])),*/
			    'GENDER' => $_POST['GENDER'],
			    'REF_ID' => $_POST['REF_ID'],
			    'GROUP_ID' => $_POST['GROUP_ID'],
			    'GUARDIAN_ID' => $maxGId[0]['MAX(GUARDIAN_ID)'],
			    'STATUS' => $_POST['STATUS'],
			    'PRSNTDIV_ID' => $_POST['PRSNTDIV_ID'],
			    'PRSNTDIS_ID' => $_POST['PRSNTDIS_ID'],
			    'PRSNTADDR' => $_POST['PRSNTADDR'],
			    'PRMNTDIV_ID' => $_POST['PRMNTDIV_ID'],
			    'PRMNTDIS_ID' => $_POST['PRMNTDIS_ID'],
			    'PRMNTADDR' => $_POST['PRMNTADDR'],
			    'ALLOWANCE' => $_POST['ALLOWANCE'],
			);

			if (!empty($imgFile)) {

		    	$tmp_dir = $_FILES['IMAGE']['tmp_name'];
	    		$upload_dir = '../assets/images/student/';

	    		$selectStudent = array("MAX(STUDENT_ID)");
				$maxStudentId = Database::getNextPrimaryKeyM("STUDENT_TB");
				$saveImg = "student_".$maxStudentId[0]['PRIMARY_KEY'].".".strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));

	    		move_uploaded_file($tmp_dir,$upload_dir.$saveImg);
	    		$dataStudent["IMAGE"] = $saveImg;
		    }



			$result = Database::insertData("STUDENT_TB",$dataStudent);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>$_POST['STNAME'],
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

		public static function updateStudentM($data,$id)
		{
			$dataGuardian =  array(
				'GNAME' => $_POST['GNAME'],
			    'GRELATION' => $_POST['GRELATION'],
			    'GPHONE' => $_POST['GPHONE'],
			    'GEMAIL' => $_POST['GEMAIL'],
			    'GNATIONALID' => $_POST['GNATIONALID'],
			    /*'GGENDER' => $_POST['GGENDER'],*/
			);

			$condition =  array(
				'GUARDIAN_ID' => $_POST['GUARDIAN_ID'], 
			);

			$result = Database::updateData("GUARDIAN_TB",$dataGuardian,$condition);
			$imgFile = $_FILES['IMAGE']['name'];
			$dataStudent =  array(
				'STNAME' => $_POST['STNAME'],
			    'CARDNO' => $_POST['CARDNO'],
			    'PHONE' => $_POST['PHONE'],
			    'EMAIL' => $_POST['EMAIL'],
			    'NATIONALID' => $_POST['NATIONALID'],
			    /*'STARTDT' => date('Y-m-d', strtotime($_POST['STARTDT'])),*/
			    'GENDER' => $_POST['GENDER'],
			    'REF_ID' => $_POST['REF_ID'],
			    'GROUP_ID' => $_POST['GROUP_ID'],
			    'STATUS' => $_POST['STATUS'],
			    'PRSNTDIV_ID' => $_POST['PRSNTDIV_ID'],
			    'PRSNTDIS_ID' => $_POST['PRSNTDIS_ID'],
			    'PRSNTADDR' => $_POST['PRSNTADDR'],
			    'PRMNTDIV_ID' => $_POST['PRMNTDIV_ID'],
			    'PRMNTDIS_ID' => $_POST['PRMNTDIS_ID'],
			    'PRMNTADDR' => $_POST['PRMNTADDR'],
			    'ALLOWANCE' => $_POST['ALLOWANCE'],
			);

			if (!empty($imgFile)) {

		    	$tmp_dir = $_FILES['IMAGE']['tmp_name'];
	    		$upload_dir = '../assets/images/student/';
				$saveImg = "student_".$id.".".strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));

	    		move_uploaded_file($tmp_dir,$upload_dir.$saveImg);

	    		$dataStudent["IMAGE"] = $saveImg;
		    }

			$condition =  array(
				'STUDENT_ID' => $id, 
			);

			$result = Database::updateData("STUDENT_TB",$dataStudent,$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>$_POST['STNAME'],
				    'TYPE'=>'updated'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>$_POST['STNAME'],
				    'TYPE'=>'Not updated'
			    );
			}
			echo json_encode($msg);
			exit();
		}

		public static function getAllStudentM()
		{
			/*$db = new Database();*/
			$conn = Database::databaseConnection();

			
			$sql = "SELECT * FROM STUDENT_TB S LEFT JOIN CHILD_LOOKUP_TB CLT ON S.STATUS = CLT.CLU_ID";
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

		public static function getAllActiveStudentM()
		{
			/*$db = new Database();*/
			$conn = Database::databaseConnection();

			
			$sql = "SELECT * FROM STUDENT_TB WHERE STATUS = 3";
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


		public static function countStudentM($id)
		{
			/*$db = new Database();*/
			$conn = Database::databaseConnection();

			
			$sql = "SELECT count(STUDENT_ID) AS COUNT_STUDENT FROM STUDENT_TB WHERE STATUS = ".$id;
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

		public static function getStudentByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM STUDENT_TB S LEFT JOIN GUARDIAN_TB G ON S.GUARDIAN_ID = G.GUARDIAN_ID WHERE S.STUDENT_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function getStudentColM($select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM STUDENT_TB";
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

		public static function getStudentDataWithConditionM($select,$condition)
		{
			return Database::getDataWithConditionM("STUDENT_TB",$select,$condition);
		}

		public static function getNotAssignedStudentM($id)
		{
			if (empty($id)) {
				$id = 0;
			}
			$query = "SELECT * from student_tb where student_id not in (select student_id from academic_tb where academic_id !=".$id.") and status = 3";
			return Database::getDataWithRawQueryM($query);
		}

		public static function deleteStudentM($id)
		{
			$condition =  array(
				'STUDENT_ID' => $id, 
			);

			$result = Database::deleteData("STUDENT_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'Student',
				    'TYPE'=>'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Student',
				    'TYPE'=>'not deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}


	}
?>

