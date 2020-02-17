<?php 
//session_start();
require_once '../models/Database.php';

class Authentication
{
	public Static function isLoggedIn()
	{
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		if (!isset($_SESSION) && $_SESSION['isLoggedIn'] != true) {
			Authentication::logOut();
		}
	}

	public static function authenticate()
	{
		self::isLoggedIn();
		$data =  Database::checkAuthentication($_POST);
		if($data)
		{
			$_SESSION['UserName'] = $_POST['USERNAME'];
			$_SESSION['isLoggedIn'] = true;
			header('Location: mainPage.php');
		}
		else
		{
			return $msg = "Invalid Username and Password";
		}
	}

	public static function logOut()
	{
		unset($_SESSION['UserName']); 
		unset($_SESSION['isLoggedIn']); 
		session_destroy();
		header('Location: ../view/login.php');
	}		
}

?>