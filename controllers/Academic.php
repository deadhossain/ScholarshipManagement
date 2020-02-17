<?php 
require_once '../controllers/Authentication.php';
require_once '../models/AcademicModel.php';
require_once '../models/DurationModel.php';
require_once '../models/StudentModel.php';
require_once '../Table/AcademicTable.php';

$academic = new Academic();

if (isset($_GET['allAcademic'])) {
	$academic->getAllAcademicData();
}

if (isset($_GET['academicTable'])) {
	$academic->academicTable();
}

if (isset($_GET['editAcademic'])) {
	$academic->editAcademic($_GET['editAcademic']);
}

if (isset($_GET['addAcademic'])) {
	$academic->createAcademic();
}

if (isset($_GET['deleteAcademic'])) {
	$academic->deleteAcademic($_GET['deleteAcademic']);
}

class Academic 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function academicTable()
	{
	    $heading=array(
	      'title'=>'Academic Info',
	      'pageTitle'=>'Academic Info List',
	      'modal'=>'/controllers/Academic.php?addAcademic',
	      'modal_size'=>'modal-md',
	      'button_name'=>'Add Academic Info'
	    );
	  	require_once '../view/student/allAcademic.php';
	}

	public function createAcademic()
	{
		if (!empty($_POST)) {
			$result =  AcademicModel::createAcademicM($_POST);
		}

		/*$selectStudent = array("STUDENT_ID", "STNAME");
		$condition =  array(
				'STATUS' => 'Active', 
		);
		$allStudent = StudentModel::getStudentDataWithConditionM($selectStudent,$condition);*/
		$selectStudent = array("STUDENT_ID", "STNAME");
		$condition =  array(
				'STATUS' => 3, 
		);
		$allStudent = StudentModel::getNotAssignedStudentM('');

		$selectDuration = array("DURATION_ID", "CLASSNAME");
		$allDuration = DurationModel::getDurationColM($selectDuration);

		require_once '../view/student/modals/createAcademic.php';	
		
	}

	public function editAcademic($id)
	{
		if (!empty($_POST)) {
			AcademicModel::updateAcademicM($_POST,$id);
		}

		$editAcademic = AcademicModel::getAcademicByIdM($id);

		$selectStudent = array("STUDENT_ID", "STNAME");
		$condition =  array(
				'STATUS' => 'Active', 
		);
		$allStudent = StudentModel::getNotAssignedStudentM($id);

		$selectDuration = array("DURATION_ID", "CLASSNAME");
		$allDuration = DurationModel::getDurationColM($selectDuration);

		require_once '../view/student/modals/createAcademic.php';
	}

	public function getAllAcademicData()
	{
		$data = AcademicModel::getAllAcademicM();
		$allAcademic = AcademicTable::academicData($data);
		echo json_encode($allAcademic);
	}

	public function deleteAcademic($id)
	{
		if (!empty($id)) {
			AcademicModel::deleteAcademicM($id);
		}
	}

}
?>