<?php 
require_once '../controllers/Authentication.php';
require_once '../models/RoleModel.php';
require_once '../Table/RoleTable.php';

$role = new Role();
if (isset($_GET['addRole'])) {
	$role->createRole();
}

if (isset($_GET['allRole'])) {
	$role->getAllRoleData();
}

if (isset($_GET['roleTable'])) {
	$role->roleTable();
}

if (isset($_GET['editRole'])) {
	$role->editRole($_GET['editRole']);
}

if (isset($_GET['getRole'])) {
	$role->getRole($_GET['getRole']);
}

if (isset($_GET['deleteRole'])) {
	$role->deleteRole($_GET['deleteRole']);
}

class Role 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function roleTable()
	{
	    $heading=array(
	      'title'=>'Role',
	      'pageTitle'=>'Role List',
	      'modal'=>'/controllers/Role.php?addRole',
	      'modal_size'=>'modal-sm',
	      'button_name'=>'Add Role'
	    );
	  	require_once '../view/accesscontrol/allRole.php';
	}

	public function createRole()
	{
		if (!empty($_POST)) {
			RoleModel::createRoleM($_POST);
		}
		
		require_once '../view/accesscontrol/modals/createRole.php';
	}

	public function getAllRoleData()
	{
		Authentication::isLoggedIn();
		$data = RoleModel::getAllRoleM();
		$allRole = RoleTable::RoleData($data);
		echo json_encode($allRole);
	}

	public function editRole($id)
	{
		if (!empty($_POST)) {
			RoleModel::updateRoleM($_POST,$id);
		}
		$editRole = RoleModel::getRoleByIdM($id);
		require_once '../view/accesscontrol/modals/createRole.php';
	}

	public function getRole($id)
	{
		$selectRole = array("ROLENAME");
		$condition =  array(
				'ROLE_ID' => $id, 
		);

		$role = RoleModel::getRoleDataWithConditionM($selectRole,$condition);
		echo json_encode($role);
	}

	public function deleteRole($id)
	{
		if (!empty($id)) {
			RoleModel::deleteRoleM($id);
		}
	}


}
?>