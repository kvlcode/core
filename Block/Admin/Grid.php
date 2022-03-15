<?php
Ccc::loadClass('Block_Core_Template');
class Block_Admin_Grid extends Block_Core_Template
{
	protected $pager = null;

	public function __construct()
	{
		$this->setTemplate('view/admin/grid.php');
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

	public function getAdmins()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('p',1);
		$count = $request->getRequest('count',20);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('adminId') as totalCount FROM `admin`");
		$this->getPager()->execute($totalRecord['totalCount'], $current, $count);
		$admins = Ccc::getModel('Admin')->fetchAll("SELECT * FROM `admin` LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $admins;
	}

}