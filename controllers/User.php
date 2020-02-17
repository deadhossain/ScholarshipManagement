<?php 
require_once '../controllers/Authentication.php';
require_once '../models/RoleModel.php';
require_once '../models/UserModel.php';
require_once '../Table/UserTable.php';

$user = new User();
if (isset($_GET['addUser'])) {
	$user->createUser();
}

if (isset($_GET['allUser'])) {
	$user->getAllUserData();
}

if (isset($_GET['userTable'])) {
	$user->userTable();
}

if (isset($_GET['editUser'])) {
	$user->editUser($_GET['editUser']);
}

if (isset($_GET['deleteUser'])) {
	$user->deleteUser($_GET['deleteUser']);
}


class User 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	public function userTable()
	{
	    $heading=array(
	      'title'=>'User',
	      'pageTitle'=>'User List',
	      'modal'=>'/controllers/User.php?addUser',
	      'modal_size'=>'modal-md',
	      'button_name'=>'Add User'
	    );
	  	require_once '../view/accesscontrol/allUser.php';
	}

	public function editUser($id)
	{
		if (!empty($_POST)) {
			UserModel::updateUserM($_POST,$id);
		}
		$allRole = RoleModel::getAllRoleM();
		$editUser = UserModel::getUserByIdM($id);
		require_once '../view/accesscontrol/modals/createUser.php';
	}

	public function deleteUser($id)
	{
		if (!empty($id)) {
			UserModel::deleteUserM($id);
		}
	}

	public function createUser()
	{
		if (!empty($_POST)) {
			UserModel::createUserM($_POST);
		}
		$allRole = RoleModel::getAllRoleM();
		require_once '../view/accesscontrol/modals/createUser.php';
	}

	public function getAllUserData()
	{
		Authentication::isLoggedIn();
		$data = UserModel::getAllUserM();
		$allUser = UserTable::userData($data);
		echo json_encode($allUser);
	}

}
?>