<?php 
require_once '../controllers/Authentication.php';
require_once '../models/ReferenceModel.php';
require_once '../Table/ReferenceTable.php';
require_once '../models/AreaModel.php';

$reference = new Reference();

if (isset($_GET['allReference'])) {
	$reference->getAllReferenceData();
}

if (isset($_GET['referenceTable'])) {
	$reference->referenceTable();
}

if (isset($_GET['editReference'])) {
	$reference->editReference($_GET['editReference']);
}

if (isset($_GET['addReference'])) {
	$reference->createReference();
}

if (isset($_GET['deleteReference'])) {
	$reference->deleteReference($_GET['deleteReference']);
}


class Reference 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function checkLimitReference()
	{
		return ReferenceModel::checkLimitReferenceM("Y");
	}

	public function checkNoLimitReference()
	{
		return ReferenceModel::checkLimitReferenceM("N");
	}

	public function referenceTable()
	{
	    $heading=array(
	      'title'=>'Reference',
	      'pageTitle'=>'Reference List',
	      'modal'=>'/controllers/Reference.php?addReference',
	      'modal_size'=>'modal-lg',
	      'button_name'=>'Add Reference'
	    );
	  	require_once '../view/accesscontrol/allReferences.php';
	}

	public function createReference()
	{
		if(!empty($_POST))
		{
			ReferenceModel::createReferenceM($_POST);
		}

		$selectDivision = array("ID", "NAME");
		$allDivision = AreaModel::getAreaColM("DIVISIONS",$selectDivision);

		$selectDistrict = array("ID", "NAME");
		$allDistrict = AreaModel::getAreaColM("DISTRICTS",$selectDistrict);
		require_once '../view/accesscontrol/modals/createReference.php';	
		
	}



	public function getAllReferenceData()
	{
		$data = ReferenceModel::getAllReferenceM();
		$allReference = ReferenceTable::referenceData($data);
		echo json_encode($allReference);
	}

	public function editReference($id)
	{
		if (!empty($_POST)) {
			ReferenceModel::updateReferenceM($_POST,$id);
		}

		$selectDivision = array("ID", "NAME");
		$allDivision = AreaModel::getAreaColM("DIVISIONS",$selectDivision);

		$selectDistrict = array("ID", "NAME");
		$allDistrict = AreaModel::getAreaColM("DISTRICTS",$selectDistrict);

		$editReference = ReferenceModel::getReferenceByIdM($id);
		require_once '../view/accesscontrol/modals/createReference.php';
	}

	public function deleteReference($id)
	{
		if (!empty($id)) {
			ReferenceModel::deleteReferenceM($id);
		}
	}


}
?>