<?php

Ccc::loadClass('Block_Core_Template');

class Block_Salesman_Grid extends Block_Core_Template{

	protected $pager;

	public function __construct()
	{
		$this->setTemplate('view/salesman/grid.php');
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

	public function getSalesman()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('p',1);
		$count = $request->getRequest('count',20);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('salesmanId') as totalCount FROM `salesman`");
		$this->getPager()->execute($totalRecord['totalCount'], $current, $count);
		$salesmanModel = Ccc::getModel('Salesman');
		$salesman = $salesmanModel->fetchAll("SELECT * FROM `salesman` LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $salesman;
	}
}