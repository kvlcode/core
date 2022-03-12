<?php
Ccc::loadClass('Block_Core_Template');
class Block_Admin_Login extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/admin/login.php');
	}

}
