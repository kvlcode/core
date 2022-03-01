<?php
Ccc::loadClass('Block_Core_Template');
class Block_Vendor_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}

	public function getVendors()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$vendors = $vendorModel->fetchAll("SELECT v.*,a.*
					                            FROM vendor v
					                            JOIN vendor_address a
					                            ON a.vendorId = v.vendorId");
		return $vendors;
	}

}