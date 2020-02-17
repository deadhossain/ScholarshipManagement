<?php 
require_once '../controllers/Authentication.php';
require_once '../models/DurationModel.php';
require_once '../Table/DurationTable.php';

$duration = new Duration();
if (isset($_GET['addDuration'])) {
	$duration->createDuration();
}

if (isset($_GET['allDuration'])) {
	$duration->getAllDurationData();
}

if (isset($_GET['durationTable'])) {
	$duration->durationTable();
}

if (isset($_GET['editDuration'])) {
	$duration->editDuration($_GET['editDuration']);
}

if (isset($_GET['getDuration'])) {
	$duration->getDuration($_GET['getDuration']);
}

if (isset($_GET['deleteDuration'])) {
	$duration->deleteDuration($_GET['deleteDuration']);
}

class Duration 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function durationTable()
	{
	    $heading=array(
	      'title'=>'Duration',
	      'pageTitle'=>'Duration List',
	      'modal'=>'/controllers/Duration.php?addDuration',
	      'modal_size'=>'modal-sm',
	      'button_name'=>'Add Duration'
	    );
	  	require_once '../view/accesscontrol/allDuration.php';
	}




	public function createDuration()
	{
		if (!empty($_POST)) {
			DurationModel::createDurationM($_POST);
		}
		
		require_once '../view/accesscontrol/modals/createDuration.php';
	}

	public function getAllDurationData()
	{
		Authentication::isLoggedIn();
		$data = DurationModel::getAllDurationM();
		$allDuration = DurationTable::DurationData($data);
		echo json_encode($allDuration);
	}

	public function editDuration($id)
	{
		if (!empty($_POST)) {
			DurationModel::updateDurationM($_POST,$id);
		}
		$editDuration = DurationModel::getDurationByIdM($id);
		require_once '../view/accesscontrol/modals/createDuration.php';
	}

	public function getDuration($id)
	{
		$selectDuration = array("DURATION");
		$condition =  array(
				'DURATION_ID' => $id, 
		);

		$duration = DurationModel::getDurationDataWithConditionM($selectDuration,$condition);
		echo json_encode($duration);
	}

	public function deleteDuration($id)
	{
		if (!empty($id)) {
			DurationModel::deleteDurationM($id);
		}
	}


}
?>