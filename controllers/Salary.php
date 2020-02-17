<?php 
require_once '../controllers/Authentication.php';
require_once '../models/SalaryModel.php';
require_once '../models/BalanceModel.php';
require_once '../models/EmployeeModel.php';
require_once '../models/LookUpDataModel.php';
require_once '../Table/SalaryTable.php';

$salary = new Salary();

if (isset($_GET['allSalary'])) {
	$salary->getAllSalaryData();
}

if (isset($_GET['salaryTable'])) {
	$salary->salaryTable();
}

if (isset($_GET['editSalary'])) {
	$salary->editSalary($_GET['editSalary']);
}

if (isset($_GET['addSalary'])) {
	$salary->createSalary();
}

if (isset($_GET['deleteSalary'])) {
	$salary->deleteSalary($_GET['deleteSalary']);
}


class Salary 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function checkTotalSalary()
	{
		return SalaryModel::checkTotalSalaryM();
	}

	public function salaryTable()
	{
	    $heading=array(
	      'title'=>'Salary',
	      'pageTitle'=>'Salary List',
	      'modal'=>'/controllers/Salary.php?addSalary',
	      'modal_size'=>'modal-md',
	      'button_name'=>'Give Salary'
	    );
	  	require_once '../view/accounts/allSalary.php';
	}

	public function createSalary()
	{
		if(!empty($_POST))
		{
			SalaryModel::createSalaryM($_POST);
		}

		$selectEmployee = array("EMPLOYEE_ID", "NAME");
		$allEmployee = EmployeeModel::getEmployeeColM($selectEmployee);

		$selectEmployeePaymentStatus = array("CLU_ID", "CLUNAME");
		$conditionEmployeePaymentStatus =  array(
				'PLU_ID' => 5, 
		);
		$allPaymentStatus = LookUpDataModel::getLookUpDataWithConditionM($selectEmployeePaymentStatus,$conditionEmployeePaymentStatus);
		require_once '../view/accounts/modals/createSalary.php';	
	}

	public function getAllSalaryData()
	{
		$data = SalaryModel::getAllSalaryM();
		$allSalary = SalaryTable::salaryData($data);
		echo json_encode($allSalary);
	}

	public function editSalary($id)
	{
		if (!empty($_POST)) {
			SalaryModel::updateSalaryM($_POST,$id);
		}

		$selectEmployee = array("EMPLOYEE_ID", "NAME");
		$allEmployee = EmployeeModel::getEmployeeColM($selectEmployee);

		$selectEmployeePaymentStatus = array("CLU_ID", "CLUNAME");
		$conditionEmployeePaymentStatus =  array(
				'PLU_ID' => 5, 
		);
		$allPaymentStatus = LookUpDataModel::getLookUpDataWithConditionM($selectEmployeePaymentStatus,$conditionEmployeePaymentStatus);

		$editSalary = SalaryModel::getSalaryByIdM($id);
		require_once '../view/accounts/modals/createSalary.php';
	}

	public function deleteSalary($id)
	{
		if (!empty($id)) {
			SalaryModel::deleteSalaryM($id);
		}
	}


}
?>