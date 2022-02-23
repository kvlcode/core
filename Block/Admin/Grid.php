<?php
Ccc::loadClass('Block_Core_Template');
class Block_Admin_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/admin/grid.php');
		
	}

	public function getAdmin()
	{
		$adminTable = Ccc::getModel('Admin_Resource');
		$admin = $adminTable->fetchAll("SELECT * FROM `admin`");
		return $admin;
	}

}