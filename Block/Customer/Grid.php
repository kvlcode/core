<?php
Ccc::loadClass('Block_Core_Template');
class Block_Customer_Grid extends Block_Core_Template
{
	protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
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

	public function getCustomers()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('p',1);
		$count = $request->getRequest('count',20);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('customerId') as totalCount FROM `customer`");
		$this->getPager()->execute($totalRecord['totalCount'], $current, $count);
		$customers = Ccc::getModel('Customer')->fetchAll("SELECT * FROM `customer` LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $customers;
	}

}