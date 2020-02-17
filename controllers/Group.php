<?php 
require_once '../controllers/Authentication.php';
require_once '../models/GroupModel.php';
require_once '../Table/GroupTable.php';

$group = new Group();
if (isset($_GET['addGroup'])) {
	$group->createGroup();
}

if (isset($_GET['allGroup'])) {
	$group->getAllGroupData();
}

if (isset($_GET['groupTable'])) {
	$group->groupTable();
}

if (isset($_GET['editGroup'])) {
	$group->editGroup($_GET['editGroup']);
}

if (isset($_GET['deleteGroup'])) {
	$group->deleteGroup($_GET['deleteGroup']);
}



class Group 
{  
	function __construct()
	{
		Authentication::isLoggedIn();
	}

	// public function dayOfWeek()
	// {
	// 	return $dowMap = array('Saturday','Sunday', 'Monday', 'Tueday', 'Wednesday', 'Thursday', 'Friday');
	// }

	public function groupTable()
	{
	    $heading=array(
	      'title'=>'Group',
	      'pageTitle'=>'Group List',
	      'modal'=>'/controllers/Group.php?addGroup',
	      'modal_size'=>'modal-sm',
	      'button_name'=>'Add Group'
	    );
	  	require_once '../view/accesscontrol/allGroup.php';
	}

	public function createGroup()
	{
		if (!empty($_POST)) {
			GroupModel::createGroupM($_POST);
		}
		
		require_once '../view/accesscontrol/modals/createGroup.php';
	}

	public function getAllGroupData()
	{
		$data = GroupModel::getAllGroupM();
		$allGroup = GroupTable::groupData($data);
		echo json_encode($allGroup);
	}

	public function editGroup($id)
	{
		if (!empty($_POST)) {
			GroupModel::updateGroupM($_POST,$id);
		}
		$editGroup = GroupModel::getGroupByIdM($id);
		require_once '../view/accesscontrol/modals/createGroup.php';
	}

	public function deleteGroup($id)
	{
		if (!empty($id)) {
			GroupModel::deleteGroupM($id);
		}
	}

}
?>