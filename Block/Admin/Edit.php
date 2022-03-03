<?php
Ccc::loadClass('Block_Core_Template');
class Block_Admin_Edit extends Block_Core_Template
{
	protected $admin = null;
	public function __construct()
	{
		$this->setTemplate('view/admin/edit.php');		
	}

	public function setAdmin($admin)
	{
		$this->admin = $admin;
		return $this;
	}

	public function getAdmin()
	{
		return $this->admin;
	}

}