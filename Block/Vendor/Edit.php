<?php
Ccc::loadClass('Block_Core_Template');
class Block_Vendor_Edit extends Block_Core_Template
{

	protected $vendor = null;

	public function __construct()
	{
		$this->setTemplate('view/vendor/edit.php');
	}

	public function getVendor()
	{
		return $this->vendor;
	}

	public function setVendor($vendor)
	{
		$this->vendor = $vendor;
		return $this;
	}
	
}