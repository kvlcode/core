<?php
Ccc::loadClass('Block_Core_Template');
class Block_Customer_Grid extends Block_Core_Template
{
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
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('customerId') as totalCount FROM `customer`");
		$this->getPager()->execute($totalRecord['totalCount'], $current);
		$customerModel = Ccc::getModel('Customer');
		$customers = $customerModel->fetchAll("SELECT c.*,a.* FROM customer c JOIN customer_address a ON a.customerId = c.customerId LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $customers;
	}

}