<?php 
Ccc::loadClass('Block_Core_Template');
class Block_Vendor_Edit_Tabs_Address extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/edit/tabs/address.php');
	}

	public function getVendor()
	{
		return Ccc::getRegistry('vendor');
	}
}