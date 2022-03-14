<?php
Ccc::loadClass('Block_Core_Template');
class Block_Config_Grid extends Block_Core_Template
{
	public $pager = null;

	public function __construct()
	{
		$this->setTemplate('view/config/grid.php');
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

	public function getConfigs()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('p',1);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('configId') as totalCount FROM `config`");
		$this->getPager()->execute($totalRecord['totalCount'], $current);
		$configs = Ccc::getModel('Config')->fetchAll("SELECT * FROM `config` LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $configs;
	}
}