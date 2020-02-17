<?php
	/**
	 * 
	 */
	require_once 'Database.php';
	class DonorModel
	{
		function __construct()
		{
			
		}

		public static function getAllDonorM()
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM DONOR_TB";
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

		public static function getDonorColM($select)
		{
		    $col = array_values($select);

			$conn = Database::databaseConnection();
			$sql = "SELECT ". implode(", ", $col) ." FROM DONOR_TB";
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

		public static function createDonorM($post)
		{
			$msg=array(
			    'TITLE'=>$_POST['NAME'],
			    'TYPE'=>'Not Created'
		    );

			$imgFile = $_FILES['IMAGE']['name'];

		    $dataDonor =  array(
				'NAME' => $_POST['NAME'], 
				'PHONE' => $_POST['PHONE'], 
				'EMAIL' => $_POST['EMAIL'], 
				'ADDRESS' => $_POST['ADDRESS'], 
				'DISTRICT_ID' => $_POST['DISTRICT_ID'], 
				'DIVISION_ID' => $_POST['DIVISION_ID']
			);

			if (!empty($imgFile)) {

		    	$tmp_dir = $_FILES['IMAGE']['tmp_name'];
	    		$upload_dir = '../assets/images/donor/';

	    		$selectDonor = array("MAX(DONOR_ID)");
				$maxDonorId = Database::getNextPrimaryKeyM("DONOR_TB");
				$saveImg = "don_".$maxDonorId[0]['PRIMARY_KEY'].".".strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));

	    		move_uploaded_file($tmp_dir,$upload_dir.$saveImg);
	    		$dataDonor["IMAGE"] = $saveImg;
		    }

			$result =  Database::insertData("DONOR_TB",$dataDonor);

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

		public static function getDonorByIdM($id)
		{
			$conn = Database::databaseConnection();
			$sql = "SELECT * FROM DONOR_TB WHERE DONOR_ID = ".$id;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {		    	
		    	return $row = $result->fetch_assoc();			    
			} else {
			    return false;
			}
			$conn->close();	
		}

		public static function updateDonorM($data,$id)
		{
			$imgFile = $_FILES['IMAGE']['name'];

		    $dataDonor =  array(
				'NAME' => $_POST['NAME'], 
				'PHONE' => $_POST['PHONE'], 
				'EMAIL' => $_POST['EMAIL'], 
				'ADDRESS' => $_POST['ADDRESS'], 
				'DISTRICT_ID' => $_POST['DISTRICT_ID'], 
				'DIVISION_ID' => $_POST['DIVISION_ID']
			);

			if (!empty($imgFile)) {

		    	$tmp_dir = $_FILES['IMAGE']['tmp_name'];
	    		$upload_dir = '../assets/images/donor/';
				$saveImg = "don_".$id.".".strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));

	    		move_uploaded_file($tmp_dir,$upload_dir.$saveImg);
	    		$dataDonor["IMAGE"] = $saveImg;
		    }

			$condition =  array(
				'DONOR_ID' => $id, 
			);

			$result = Database::updateData("DONOR_TB",$dataDonor,$condition);
			
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

		public static function deleteDonorM($id)
		{
			$condition =  array(
				'DONOR_ID' => $id, 
			);

			$result = Database::deleteData("DONOR_TB",$condition);
			
			if($result)
			{
				$msg=array(
				    'TITLE'=>'Donor',
				    'TYPE'=>'deleted'
			    );	
			}
			else {
				$msg=array(
				    'TITLE'=>'Donor',
				    'TYPE'=>'not deleted'
			    );
			}
			echo json_encode($msg);
			exit();
		}
	}
?>
