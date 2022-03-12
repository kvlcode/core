<?php
 Ccc::loadClass('Model_Core_Row');
class Model_Admin extends Model_Core_Row{

	protected $login = [];

	public function setLogin($login)
	{
		$this->login = $login;
		return $this;
	}

	public function getLogin()
	{
		return $this->login;	
	}

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DISABLED_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';

	public function __construct()
	{	
		$this->setResourceClassName('Admin_Resource');
	}

	public function getStatus($key = NULL)
	{
		$status = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
		];
		if(!$key){
			return $status;
		}
		if(array_key_exists($key, $status)){
			return $status[$key];
		}
		return self::STATUS_DISABLED_DEFAULT;
	}


	public function login($email, $password)
	{
	
		$adminModel = Ccc::getModel('Admin');
		$admin = $adminModel->fetchRow("SELECT * FROM `admin` WHERE `email` = '{$email}' AND `password` = '{$password}'");
		
		if (!$admin) {
			return false;
		}
		Ccc::getModel('Admin_Message')->login = $admin;
		return true;
	}

	public function logout()
	{
		unset(Ccc::getModel('Admin_Message')->login);
	}

}