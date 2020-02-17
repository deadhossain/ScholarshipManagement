<?php 
require_once '../models/StudentModel.php';
require_once '../models/DurationModel.php';
require_once '../controllers/Authentication.php';
require_once '../models/ResultModel.php';
require_once '../Table/ResultTable.php';

$result = new Result();

if (isset($_GET['allResult'])) {
	$result->getAllResultData();
}

if (isset($_GET['resultTable'])) {
	$result->resultTable();
}

if (isset($_GET['editResult'])) {
	$result->editResult($_GET['editResult']);
}

if (isset($_GET['addResult'])) {
	$result->createResult();
}

if (isset($_GET['deleteResult'])) {
	$result->deleteResult($_GET['deleteResult']);
}


class Result 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function resultTable()
	{
	    $heading=array(
	      'title'=>'Result',
	      'pageTitle'=>'Result List',
	      'modal'=>'/controllers/Result.php?addResult',
	      'modal_size'=>'modal-md',
	      'button_name'=>'Add Result'
	    );
	  	require_once '../view/student/allResult.php';
	}

	public function createResult()
	{
		if(!empty($_POST))
		{
			ResultModel::createResultM($_POST);
		}

		$selectStudent = array("STUDENT_ID", "STNAME");
		$condition =  array(
				'STATUS' => '3', 
		);
		$allStudent = StudentModel::getStudentDataWithConditionM($selectStudent,$condition);

		$selectDuration = array("DURATION_ID", "CLASSNAME");
		$allDuration = DurationModel::getDurationColM($selectDuration);

		require_once '../view/student/modals/createResult.php';
	}



	public function getAllResultData()
	{
		$data = ResultModel::getAllResultM();
		$allResult = ResultTable::resultData($data);
		echo json_encode($allResult);
	}

	public function editResult($id)
	{
		if (!empty($_POST)) {
			ResultModel::updateResultM($_POST,$id);
		}

		$selectStudent = array("STUDENT_ID", "STNAME");
		$condition =  array(
				'STATUS' => '3', 
		);
		$allStudent = StudentModel::getStudentDataWithConditionM($selectStudent,$condition);

		$selectDuration = array("DURATION_ID", "CLASSNAME");
		$allDuration = DurationModel::getDurationColM($selectDuration);

		$editResult = ResultModel::getResultByIdM($id);
		require_once '../view/student/modals/createResult.php';
	}

	public function deleteResult($id)
	{
		if (!empty($id)) {
			ResultModel::deleteResultM($id);
		}
	}


}
?>