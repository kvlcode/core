<?php 
Ccc::loadClass('Block_Core_Template');
class Block_Customer_Edit_Tabs_Address extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/customer/edit/tabs/address.php');
	}

	public function getCustomer()
	{
		return Ccc::getRegistry('customer');
	}
}