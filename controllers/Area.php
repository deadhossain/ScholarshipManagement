<?php 

	require_once '../controllers/Authentication.php';
	require_once '../models/AreaModel.php';
	if (isset($_GET['getDivisions'])) {
		$division = new Area();
		$division->getAllDivision();
	}

	if (isset($_GET['division'])) {
		$district = new Area();
		$district->getDivisionWiseDistricts($_GET['division']);
	}

	class Area 
	{
		
		function __construct()
		{
			Authentication::isLoggedIn();
		}
		
		public function getAllDivision()
		{
			$divisionData = AreaModel::getAllDivisionM();
			echo json_encode($divisionData) ;
		}

		public function getDivisionWiseDistricts($id)
		{
			$districtData = AreaModel::getDivisionWiseDistrictsM($id);
			echo json_encode($districtData) ;
		}
	}
?>