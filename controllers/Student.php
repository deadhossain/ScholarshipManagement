<?php 
require_once '../controllers/Authentication.php';
require_once '../models/StudentModel.php';
require_once '../Table/StudentTable.php';
require_once '../models/GroupModel.php';
require_once '../models/ReferenceModel.php';
require_once '../models/AreaModel.php';
require_once '../models/LookUpDataModel.php';
$student = new Student();

if (isset($_GET['allStudent'])) {
	$student->getAllStudentData();
}

if (isset($_GET['studentTable'])) {
	$student->studentTable();
}

if (isset($_GET['editStudent'])) {
	$student->editStudent($_GET['editStudent']);
}

if (isset($_GET['addStudent'])) {
	$student->createStudent();
}

if (isset($_GET['deleteStudent'])) {
	$student->deleteStudent($_GET['deleteStudent']);
}

class Student 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

    public function checkTotalActiveStudent()
    {
    	# code...countStudentM COUNT_STUDENT
    	return StudentModel::countStudentM(3);
    }

    public function checkTotalOnHoldStudent()
    {
    	# code...countStudentM COUNT_STUDENT
    	return StudentModel::countStudentM(6);
    }

    public function checkWaitingStudent()
    {
    	# code...countStudentM COUNT_STUDENT
    	return StudentModel::countStudentM(5);
    }

    public function checkCompletedStudent()
    {
    	# code...countStudentM COUNT_STUDENT
    	return StudentModel::countStudentM(9);
    }

	public function studentTable()
	{
	    $heading=array(
	      'title'=>'Student',
	      'pageTitle'=>'Student List',
	      'modal'=>'/controllers/Student.php?addStudent',
	      'modal_size'=>'modal-bg',
	      'button_name'=>'Add Student'
	    );
	  	require_once '../view/student/allStudent.php';
	}

	public function createStudent()
	{
		if (!empty($_POST)) {
			$result =  StudentModel::createStudentM($_POST);
		}

		$selectGender = array("CLU_ID", "CLUNAME");
		$conditionGender =  array(
				'PLU_ID' => 1, 
		);
		$allGender = LookUpDataModel::getLookUpDataWithConditionM($selectGender,$conditionGender);

		$selectStatus = array("CLU_ID", "CLUNAME");
		$conditionStatus =  array(
				'PLU_ID' => 2, 
		);
		$allStatus = LookUpDataModel::getLookUpDataWithConditionM($selectStatus,$conditionStatus);

		$selectGroup = array("GROUP_ID", "NAME");
		$allGroup = GroupModel::getGroupColM($selectGroup);

		$selectReference = array("REF_ID", "NAME");
		$allReference = ReferenceModel::getReferenceColM($selectReference);

		$selectDivision = array("ID", "NAME");
		$allDivision = AreaModel::getAreaColM("DIVISIONS",$selectDivision);

		$selectDistrict = array("ID", "NAME");
		$allDistrict = AreaModel::getAreaColM("DISTRICTS",$selectDistrict);

		require_once '../view/student/modals/createStudent.php';	
		
	}

	public function editStudent($id)
	{
		if (!empty($_POST)) {
			StudentModel::updateStudentM($_POST,$id);
		}

		$editStudent = StudentModel::getStudentByIdM($id);

		$selectGender = array("CLU_ID", "CLUNAME");
		$condition =  array(
				'PLU_ID' => 1, 
		);
		$allGender = LookUpDataModel::getLookUpDataWithConditionM($selectGender,$condition);

		$selectStatus = array("CLU_ID", "CLUNAME");
		$conditionStatus =  array(
				'PLU_ID' => 2, 
		);
		$allStatus = LookUpDataModel::getLookUpDataWithConditionM($selectStatus,$conditionStatus);

		$selectGroup = array("GROUP_ID", "NAME");
		$allGroup = GroupModel::getGroupColM($selectGroup);

		$selectReference = array("REF_ID", "NAME");
		$allReference = ReferenceModel::getReferenceColM($selectReference);

		$selectDivision = array("ID", "NAME");
		$allDivision = AreaModel::getAreaColM("DIVISIONS",$selectDivision);

		$selectDistrict = array("ID", "NAME");
		$allDistrict = AreaModel::getAreaColM("DISTRICTS",$selectDistrict);
		require_once '../view/student/modals/createStudent.php';
	}

	public function getAllStudentData()
	{
		$data = StudentModel::getAllStudentM();
		$allStudent = StudentTable::studentData($data);
		echo json_encode($allStudent);
	}

	public function deleteStudent($id)
	{
		if (!empty($id)) {
			StudentModel::deleteStudentM($id);
		}
	}

}
?>