<?php 
require_once '../controllers/Authentication.php';
require_once '../models/SpecialCaseModel.php';
require_once '../models/BalanceModel.php';
require_once '../models/LookUpDataModel.php';
require_once '../models/StudentModel.php';
require_once '../Table/SpecialCaseTable.php';

$specialCase = new SpecialCase();

if (isset($_GET['specialCaseTable'])) {
	$specialCase->getAllSpecialCaseData();
}

if (isset($_GET['allSpecialCase'])) {
	$specialCase->specialCaseTable();
}


if (isset($_GET['specialCase'])) {
	$specialCase->specialCase();
}

if (isset($_GET['paySpecialCase'])) {
	$specialCase->paySpecialCase($_GET['paySpecialCase']);
}

class SpecialCase 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function specialCaseTable()
	{
	    $heading=array(
	      'title'=>'Special Case',
	      'pageTitle'=>'Special Case',
	      /*'modal'=>'/controllers/SpecialCase.php?specialCase',
	      'modal_size'=>'modal-md',
	      'button_name'=>'Special Case'*/
	    );	    
	  	require_once '../view/accounts/allSpecialCase.php';
	}

	/*public function specialCaseTable()
	{ 
		$id = $_POST['GROUP_ID'];  
	  	require_once '../view/accounts/allSpecialCase.php';
	}*/

	public function getAllSpecialCaseData()
	{
		$data = SpecialCaseModel::getAllSpecialCaseM();
		$allSpecialCase = SpecialCaseTable::specialCaseData($data);
		echo json_encode($allSpecialCase);
	}

	public function paySpecialCase($id)
	{
		if (!empty($id)) {
			SpecialCaseModel::paySpecialCaseM($id);
		}
	}


}
?>