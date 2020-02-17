<?php 
require_once '../controllers/Authentication.php';
require_once '../models/EmployeeModel.php';
require_once '../Table/EmployeeTable.php';
require_once '../models/AreaModel.php';
require_once '../models/LookUpDataModel.php';

$employee = new Employee();

if (isset($_GET['allEmployee'])) {
	$employee->getAllEmployeeData();
}

if (isset($_GET['employeeTable'])) {
	$employee->employeeTable();
}

if (isset($_GET['editEmployee'])) {
	$employee->editEmployee($_GET['editEmployee']);
}

if (isset($_GET['getEmployeeSalary'])) {
	$employee->getEmployeeSalary($_GET['getEmployeeSalary']);
}


if (isset($_GET['addEmployee'])) {
	$employee->createEmployee();
}

if (isset($_GET['deleteEmployee'])) {
	$employee->deleteEmployee($_GET['deleteEmployee']);
}


class Employee 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function employeeTable()
	{
	    $heading=array(
	      'title'=>'Employee',
	      'pageTitle'=>'Employee List',
	      'modal'=>'/controllers/Employee.php?addEmployee',
	      'modal_size'=>'modal-lg',
	      'button_name'=>'Add Employee'
	    );
	  	require_once '../view/employee/allEmployee.php';
	}

	public function createEmployee()
	{
		if(!empty($_POST))
		{
			EmployeeModel::createEmployeeM($_POST);
		}

		$selectStatus = array("CLU_ID", "CLUNAME");
		$conditionStatus =  array(
				'PLU_ID' => 3, 
		);
		$allStatus = LookUpDataModel::getLookUpDataWithConditionM($selectStatus,$conditionStatus);

		$selectDivision = array("ID", "NAME");
		$allDivision = AreaModel::getAreaColM("DIVISIONS",$selectDivision);

		$selectDistrict = array("ID", "NAME");
		$allDistrict = AreaModel::getAreaColM("DISTRICTS",$selectDistrict);
		require_once '../view/employee/modals/createEmployee.php';	
		
	}



	public function getAllEmployeeData()
	{
		$data = EmployeeModel::getAllEmployeeM();
		$allEmployee = EmployeeTable::employeeData($data);
		echo json_encode($allEmployee);
	}

	public function editEmployee($id)
	{
		if (!empty($_POST)) {
			EmployeeModel::updateEmployeeM($_POST,$id);
		}

		$selectStatus = array("CLU_ID", "CLUNAME");
		$conditionStatus =  array(
				'PLU_ID' => 3, 
		);
		$allStatus = LookUpDataModel::getLookUpDataWithConditionM($selectStatus,$conditionStatus);

		$selectDivision = array("ID", "NAME");
		$allDivision = AreaModel::getAreaColM("DIVISIONS",$selectDivision);

		$selectDistrict = array("ID", "NAME");
		$allDistrict = AreaModel::getAreaColM("DISTRICTS",$selectDistrict);

		$editEmployee = EmployeeModel::getEmployeeByIdM($id);
		require_once '../view/employee/modals/createEmployee.php';
	}


	public function getEmployeeSalary($id)
	{
		$selectSalary = array("SALARY");
		$conditionSalary =  array(
				'EMPLOYEE_ID' => $id, 
		);

		$salary = EmployeeModel::getEmployeeDataWithConditionM($selectSalary,$conditionSalary);
		echo json_encode($salary);
	}

	public function deleteEmployee($id)
	{
		if (!empty($id)) {
			EmployeeModel::deleteEmployeeM($id);
		}
	}


}
?>