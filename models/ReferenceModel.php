<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class ReferenceModel
	{
		function __construct()
		{
			
		}

		public static function getAllReferenceM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT R.REF_ID, R.NAME, R.UPPERLIMIT,R.PHONE,R.EMAIL,R.LIMIT_FLAG FROM REFERENCE_TB R";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// $sl = 0;
			    while ($row = $result->fetch_assoc()) {
			    	// array_unshift($row , ++$sl);
			    	$rows[] = $row;
			    }
			    return $rows;
			} else {
			    return false;
			}
			$conn->close();	
		}


		public static function checkLimitReferenceM($id)
		{
			
			$conn = Database::databaseConnection();
			$sql = "SELECT count(*) as COUNT_REF FROM REFERENCE_TB R where R.LIMIT_FLAG ='".$id."'"; 
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// $sl = 0;
			    while ($row = $result->fetch_assoc()) {
			    	// array_unshift($row , ++$sl);
			    	$rows[] = $row;
			    }
			    return $rows;
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function getReferenceColM($select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM REFERENCE_TB R";
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

		public static function createReferenceM($post)
		{
			$msg=array(
			    'TITLE'=>$_POST['NAME'],
			    'TYPE'=>'Not Created'
		    );

			$imgFile = $_FILES['IMAGE']['name'];

		    $data =  array(
				'NAME' => $_POST['NAME'], 
				'PHONE' => $_POST['PHONE'], 
				'EMAIL' => $_POST['EMAIL'], 
				'ADDRESS' => $_POST['ADDRESS'], 
				'DISTRICT_ID' => $_POST['DISTRICT_ID'], 
				'DIVISION_ID' => $_POST['DIVISION_ID']
			);

			if (!empty($imgFile)) {

		    	$tmp_dir = $_FILES['IMAGE']['tmp_name'];
	    		$upload_dir = '../assets/images/reference/';

	    		$selectReference = array("MAX(REF_ID)");
				$maxReferenceId = Database::getNextPrimaryKeyM("REFERENCE_TB");
				$saveImg = "ref_".$maxReferenceId[0]['PRIMARY_KEY'].".".strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));

	    		move_uploaded_file($tmp_dir,$upload_dir.$saveImg);
	    		$data["IMAGE"] = $saveImg;
		    }

			if (!empty($_POST['UPPERLIMIT'])) {
		    	$data['UPPERLIMIT'] = $_POST['UPPERLIMIT'] ;
		    }

		    if (!empty($_POST['LIMIT_FLAG'])) {
		    	$data['LIMIT_FLAG'] = $_POST['LIMIT_FLAG'] ;
		    }

			$result =  Database::insertData("REFERENCE_TB",$data);

			if($result)
			{
				$msg=array(
				    'TITLE'=>$_POST['NAME'],
				    'TYPE'=>'Created'
			    );	
			}
			echo json_encode($msg);
			exit();
		}

		public static function getReferenceByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM REFERENCE_TB R WHERE R.REF_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function updateReferenceM($data,$id)
		{
			$imgFile = $_FILES['IMAGE']['name'];

		    $dataReference =  array(
				'NAME' => $_POST['NAME'], 
				'PHONE' => $_POST['PHONE'], 
				'EMAIL' => $_POST['EMAIL'], 
				'ADDRESS' => $_POST['ADDRESS'], 
				'DISTRICT_ID' => $_POST['DISTRICT_ID'], 
				'DIVISION_ID' => $_POST['DIVISION_ID']
			);

			if (!empty($imgFile)) {

		    	$tmp_dir = $_FILES['IMAGE']['tmp_name'];
	    		$upload_dir = '../assets/images/reference/';
				$saveImg = "ref_".$id.".".strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));

	    		move_uploaded_file($tmp_dir,$upload_dir.$saveImg);
	    		$dataReference["IMAGE"] = $saveImg;
		    }

			if (!empty($_POST['UPPERLIMIT'])) {
		    	$dataReference['UPPERLIMIT'] = $_POST['UPPERLIMIT'] ;
		    }

		    if (!empty($_POST['LIMIT_FLAG'])) {
		    	$dataReference['LIMIT_FLAG'] = $_POST['LIMIT_FLAG'] ;
		    }

			$condition =  array(
				'REF_ID' => $id, 
			);

			$result = Database::updateData("REFERENCE_TB",$dataReference,$condition);
			
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

		public static function deleteReferenceM($id)
		{
			$condition =  array(
				'REF_ID' => $id, 
			);

			$result = Database::deleteData("REFERENCE_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'Reference',
				    'TYPE'=>'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Reference',
				    'TYPE'=>'not deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}
	}
?>
