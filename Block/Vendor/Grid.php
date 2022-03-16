<?php
Ccc::loadClass('Block_Core_Template');
class Block_Vendor_Grid extends Block_Core_Template
{
	public $pager = null;

	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this;
	}

	public function getPager()
	{
		if(!$this->pager)
		{
			$this->setPager(Ccc::getModel('Core_Pager'));
		}
		return $this->pager;
	}

	public function getVendors()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('p',1);
		$count = $request->getRequest('count',20);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('vendorId') as totalCount FROM `vendor`");
		$this->getPager()->execute($totalRecord['totalCount'], $current, $count);
		$vendors = Ccc::getModel('Vendor')->fetchAll("SELECT * FROM `vendor` LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $vendors;
	}

}