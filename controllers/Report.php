<?php 
require_once '../controllers/Authentication.php';
require_once '../models/AllowanceModel.php';
require_once '../models/SalaryModel.php';
require_once '../models/BalanceModel.php';
require_once '../models/GroupModel.php';
require_once '../models/LookUpDataModel.php';
require_once '../Table/AllowanceReportTable.php';
require_once '../Table/SalaryReportTable.php';

$report = new Report();

if (isset($_GET['searchAllowanceReport'])) {
	$report->searchAllowanceReport();
}

if (isset($_GET['searchSalaryReport'])) {
	$report->searchSalaryReport();
}

if (isset($_GET['GROUP_ID']) && isset($_GET['START_DT'])  && isset($_GET['END_DT']) ) {
	
	$report->showAllowanceReport($_GET['GROUP_ID'], $_GET['START_DT'], $_GET['END_DT']);
}

if (isset($_GET['SALSTART_DT'])  && isset($_GET['SALEND_DT']) ) {
	
	$report->showSalaryReport($_GET['SALSTART_DT'], $_GET['SALEND_DT']);
}

if (isset($_GET['allowanceReportTable'])) {
	$report->allowanceReportTable();
}

if (isset($_GET['salaryReportTable'])) {
	$report->salaryReportTable();
}

if (isset($_GET['allBalanceReport'])) {
	$report->balanceReportTable();
}




class Report 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function searchAllowanceReport()
	{
	    $heading=array(
	      'title'=>'Allowance Report',
	      'pageTitle'=>'Allowance Report',
	      /*'modal'=>'/controllers/Allowance.php?specialCase',
	      'modal_size'=>'modal-md',
	      'button_name'=>'Special Case'*/
	    );
	    $selectGroup = array("GROUP_ID", "NAME");
		$allGroup = GroupModel::getGroupColM($selectGroup);
	  	require_once '../view/report/searchAllowanceReport.php';
	}

	public function searchSalaryReport()
	{
	    $heading=array(
	      'title'=>'Salary Report',
	      'pageTitle'=>'Salary Report',
	      /*'modal'=>'/controllers/Allowance.php?specialCase',
	      'modal_size'=>'modal-md',
	      'button_name'=>'Special Case'*/
	    );
	  	require_once '../view/report/searchSalaryReport.php';
	}

	public function allowanceReportTable()
	{ 
		/*$id = $_POST['GROUP_ID'];  
		$startDate = $_POST['START_DT'];  
		$endDate = $_POST['END_DT'];*/

		$reportParameter =  
			array(
				'GROUP_ID' => $_POST['GROUP_ID'], 
				'START_DT' => $_POST['START_DT'], 
				'END_DT' => $_POST['END_DT'], 
			);  
	  	require_once '../view/report/allAllowanceReport.php';
	}

	public function balanceReportTable()
	{	
		$heading=array(
	      'title'=>'Balance Report',
	      'pageTitle'=>'Balance Report',
	      /*'modal'=>'/controllers/Allowance.php?specialCase',
	      'modal_size'=>'modal-md',
	      'button_name'=>'Special Case'*/
	    );   
	  	require_once '../view/report/allBalanceReport.php';
	}


	public function salaryReportTable()
	{ 
		$reportParameter =  
			array( 
				'SALSTART_DT' => $_POST['SALSTART_DT'], 
				'SALEND_DT' => $_POST['SALEND_DT'], 
			);  
	  	require_once '../view/report/allSalaryReport.php';
	}


	public function showAllowanceReport($id, $sdate, $edate)
	{
		$data = AllowanceModel::getAllAllowanceM($id, $sdate, $edate);
		$allAllowance = AllowanceReportTable::allowanceReportTableData($data);
		echo json_encode($allAllowance);
	}


	public function showSalaryReport($sdate, $edate)
	{
		$data = SalaryModel::getAllSalaryUsingDateRangeM($sdate, $edate);
		$allSalary = SalaryReportTable::salaryReportTableData($data);
		echo json_encode($allSalary);
	}

}
?>