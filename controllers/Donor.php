<?php 
require_once '../controllers/Authentication.php';
require_once '../models/DonorModel.php';
require_once '../Table/DonorTable.php';
require_once '../models/AreaModel.php';

$donor = new Donor();

if (isset($_GET['allDonor'])) {
	$donor->getAllDonorData();
}

if (isset($_GET['donorTable'])) {
	$donor->donorTable();
}

if (isset($_GET['editDonor'])) {
	$donor->editDonor($_GET['editDonor']);
}

if (isset($_GET['addDonor'])) {
	$donor->createDonor();
}

if (isset($_GET['deleteDonor'])) {
	$donor->deleteDonor($_GET['deleteDonor']);
}


class Donor 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function donorTable()
	{
	    $heading=array(
	      'title'=>'Donor',
	      'pageTitle'=>'Donor List',
	      'modal'=>'/controllers/Donor.php?addDonor',
	      'modal_size'=>'modal-lg',
	      'button_name'=>'Add Donor'
	    );
	  	require_once '../view/accounts/allDonor.php';
	}

	public function createDonor()
	{
		if(!empty($_POST))
		{
			DonorModel::createDonorM($_POST);
		}

		$selectDivision = array("ID", "NAME");
		$allDivision = AreaModel::getAreaColM("DIVISIONS",$selectDivision);

		$selectDistrict = array("ID", "NAME");
		$allDistrict = AreaModel::getAreaColM("DISTRICTS",$selectDistrict);
		require_once '../view/accounts/modals/createDonor.php';	
	}



	public function getAllDonorData()
	{
		$data = DonorModel::getAllDonorM();
		$allDonor = DonorTable::donorData($data);
		echo json_encode($allDonor);
	}

	public function editDonor($id)
	{
		if (!empty($_POST)) {
			DonorModel::updateDonorM($_POST,$id);
		}

		$selectDivision = array("ID", "NAME");
		$allDivision = AreaModel::getAreaColM("DIVISIONS",$selectDivision);

		$selectDistrict = array("ID", "NAME");
		$allDistrict = AreaModel::getAreaColM("DISTRICTS",$selectDistrict);

		$editDonor = DonorModel::getDonorByIdM($id);
		require_once '../view/accounts/modals/createDonor.php';
	}

	public function deleteDonor($id)
	{
		if (!empty($id)) {
			DonorModel::deleteDonorM($id);
		}
	}


}
?>