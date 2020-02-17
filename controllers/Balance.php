<?php 
require_once '../controllers/Authentication.php';
require_once '../models/BalanceModel.php';
require_once '../models/DonorModel.php';
require_once '../models/LookUpDataModel.php';
require_once '../Table/BalanceTable.php';

$balance = new Balance();
if (isset($_GET['addBalance'])) {
	$balance->createBalance();
}

if (isset($_GET['allBalance'])) {
	$balance->getAllBalanceData();
}

if (isset($_GET['balanceTable'])) {
	$balance->balanceTable();
}

if (isset($_GET['editBalance'])) {
	$balance->editBalance($_GET['editBalance']);
}

if (isset($_GET['getBalance'])) {
	$balance->getBalance($_GET['getBalance']);
}

if (isset($_GET['deleteBalance'])) {
	$balance->deleteBalance($_GET['deleteBalance']);
}

class Balance 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function checkTotalBalance()
	{
		return BalanceModel::checkTotalBalanceM();
	}

	public function balanceTable()
	{
	    $heading=array(
	      'title'=>'Balance',
	      'pageTitle'=>'Balance List',
	      'modal'=>'/controllers/Balance.php?addBalance',
	      'modal_size'=>'modal-md',
	      'button_name'=>'Add Balance'
	    );
	  	require_once '../view/accounts/allBalance.php';
	}

	public function createBalance()
	{
		if (!empty($_POST)) {
			BalanceModel::createBalanceM($_POST);
		}

		$selectDonor = array("DONOR_ID", "NAME");
		$allDonor = DonorModel::getDonorColM($selectDonor);

		$selectPaymentType = array("CLU_ID", "CLUNAME");
		$conditionPaymentType =  array(
				'PLU_ID' => 4, 
		);
		$allPaymentType = LookUpDataModel::getLookUpDataWithConditionM($selectPaymentType,$conditionPaymentType);
		
		require_once '../view/accounts/modals/createBalance.php';
	}

	public function getAllBalanceData()
	{
		Authentication::isLoggedIn();
		$data = BalanceModel::getAllBalanceM();
		$allBalance = BalanceTable::BalanceData($data);
		echo json_encode($allBalance);
	}

	public function editBalance($id)
	{
		if (!empty($_POST)) {
			BalanceModel::updateBalanceM($_POST,$id);
		}

		$selectDonor = array("DONOR_ID", "NAME");
		$allDonor = DonorModel::getDonorColM($selectDonor);

		$selectPaymentType = array("CLU_ID", "CLUNAME");
		$conditionPaymentType =  array(
				'PLU_ID' => 4, 
		);
		$allPaymentType = LookUpDataModel::getLookUpDataWithConditionM($selectPaymentType,$conditionPaymentType);
		$editBalance = BalanceModel::getBalanceByIdM($id);
		require_once '../view/accounts/modals/createBalance.php';
	}

	public function getBalance($id)
	{
		$selectBalance = array("DURATION");
		$condition =  array(
			'DURATION_ID' => $id, 
		);

		$balance = BalanceModel::getBalanceDataWithConditionM($selectBalance,$condition);
		echo json_encode($balance);
	}

	public function deleteBalance($id)
	{
		if (!empty($id)) {
			BalanceModel::deleteBalanceM($id);
		}
	}


}
?>