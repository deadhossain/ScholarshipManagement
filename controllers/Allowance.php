<?php 
require_once '../controllers/Authentication.php';
require_once '../models/AllowanceModel.php';
require_once '../models/BalanceModel.php';
require_once '../models/GroupModel.php';
require_once '../models/LookUpDataModel.php';
require_once '../models/StudentModel.php';
require_once '../Table/AllowanceTable.php';

$allowance = new Allowance();

if (isset($_GET['allowanceTable'])) {
	$allowance->allowanceTable();
}

if (isset($_GET['selectGroup'])) {
	$allowance->selectGroupToGenerateList();
}

if (isset($_GET['notPaidAllowance'])) {
	$allowance->notPaidAllowance($_GET['notPaidAllowance']);
}

if (isset($_GET['specialCase'])) {
	$allowance->specialCase();
}

if (isset($_GET['generateList'])) {
	$allowance->showGroupWiseStudent($_GET['generateList']);
}

if (isset($_GET['payAllowance'])) {
	$allowance->payAllowance($_GET['payAllowance']);
}

if (isset($_GET['notPaidSinglePersonUrl'])) {
	$allowance->notPaidSinglePersonUrl($_GET['notPaidSinglePersonUrl']);
}


class Allowance 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function checkTotalAllowance()
	{
		return AllowanceModel::checkTotalAllowanceM();
	}

	public function selectGroupToGenerateList()
	{
	    $heading=array(
	      'title'=>'Special Case',
	      'pageTitle'=>'Allowance Distribution',
	      /*'modal'=>'/controllers/Allowance.php?specialCase',
	      'modal_size'=>'modal-md',
	      'button_name'=>'Special Case'*/
	    );

	    $selectGroup = array("GROUP_ID", "NAME");
		$allGroup = GroupModel::getGroupColM($selectGroup);
	  	require_once '../view/accounts/selectGroupForAllowance.php';
	}

	public function allowanceTable()
	{ 
		$id = $_POST['GROUP_ID'];  
	  	require_once '../view/accounts/allAllowance.php';
	}

	public function specialCase()
	{
		if(!empty($_POST))
		{
			AllowanceModel::createAllowanceM($_POST);
		}

		$selectStudentPaymentStatus = array("STUDENT_ID", "STNAME");
		$conditionStudentPaymentStatus =  array(
				'STATUS' => 3, 
		);
		$allStudent = StudentModel::getStudentDataWithConditionM($selectStudentPaymentStatus,$conditionStudentPaymentStatus);

		require_once '../view/accounts/modals/specialCase.php';	
	}

	public function showGroupWiseStudent($id)
	{
		/*var_dump($_POST);exit();*/
		$data = AllowanceModel::showGroupWiseStudentM($id);
		$allAllowance = AllowanceTable::groupWiseStudentWithAllowanceTable($data);
		echo json_encode($allAllowance);
	}

	public function editAllowance($id)
	{
		if (!empty($_POST)) {
			AllowanceModel::updateAllowanceM($_POST,$id);
		}

		$selectEmployee = array("EMPLOYEE_ID", "NAME");
		$allEmployee = EmployeeModel::getEmployeeColM($selectEmployee);

		$selectEmployeePaymentStatus = array("CLU_ID", "CLUNAME");
		$conditionEmployeePaymentStatus =  array(
				'PLU_ID' => 5, 
		);
		$allPaymentStatus = LookUpDataModel::getLookUpDataWithConditionM($selectEmployeePaymentStatus,$conditionEmployeePaymentStatus);

		$editAllowance = AllowanceModel::getAllowanceByIdM($id);
		require_once '../view/accounts/modals/createAllowance.php';
	}


	public function notPaidSinglePersonUrl($id)
	{

		if (!empty($_POST)) {
			AllowanceModel::notPaidSinglePersonUrlM($_POST,$id);
		}

		$studentId = $id;

		$selectAllowancePaymentStatus = array("CLU_ID", "CLUNAME");
		$conditionAllowancePaymentStatus =  array(
				'PLU_ID' => 6, 
		);
		$allPaymentStatus = LookUpDataModel::getLookUpDataWithConditionM($selectAllowancePaymentStatus,$conditionAllowancePaymentStatus);
		
		require_once '../view/accounts/modals/notPaidSinglePersonUrl.php';
	}

	public function deleteAllowance($id)
	{
		if (!empty($id)) {
			AllowanceModel::deleteAllowanceM($id);
		}
	}

	public function payAllowance($id)
	{
		if (!empty($id)) {
			AllowanceModel::payAllowanceM($id);
		}
	}


}
?>