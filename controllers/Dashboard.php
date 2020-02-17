<?php 
require_once '../controllers/Authentication.php';
require_once '../controllers/Student.php'; 
require_once '../controllers/Balance.php'; 
require_once '../controllers/Allowance.php'; 
require_once '../controllers/Salary.php';
require_once '../controllers/Reference.php';
$dashboard = new Dashboard();

if (isset($_GET['dashboard'])) {
	$dashboard->dashboardTable();
}



class Dashboard 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function dashboardTable()
	{	    
	    // $remainingBalance = Balance::checkTotalBalance();
	    // $totalSal = Salary::checkTotalSalary();
	    // $totalAllowance = Allowance::checkTotalAllowance();
	    // $totalBalance = Balance::checkTotalBalance();
	    // $totalCost = $totalAllowance[0]['TOTAL_ALLOWANCE'] + $totalSal[0]['TOTAL_SALARY'];
	    // $remainingBalance = $totalBalance[0]['TOTAL_BALANCE'] - $totalCost;
	    // $activeStudent = Student::checkTotalActiveStudent();
	    // $onHoldStudent = Student::checkTotalOnHoldStudent();
	    // $waitingStudent = Student::checkWaitingStudent();
	    // $comStudent = Student::checkCompletedStudent();
	  	require_once '../view/dashboard/dashboard.php';
	}

}
?>