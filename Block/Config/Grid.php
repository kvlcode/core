<?php
Ccc::loadClass('Block_Core_Grid');
class Block_Config_Grid extends Block_Core_Grid
{
	public $pager = null;

	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($config)
	{
		return $this->getUrl('edit', null, ['id' => $config->configId]);
	}

	public function getDeleteUrl($config)
	{
		return $this->getUrl('delete', null, ['id' => $config->configId]);
	}

	public function prepareCollections()
	{
		$this->setCollection($this->getConfigs());
	}

	public function prepareColumns()
	{
		$this->addColumn([
			'title' => 'Config Id',
			'type' => 'int'
		], 'configId');
		$this->addColumn([
			'title' => ' Name',
			'type' => 'varchar'
		], 'name');
		$this->addColumn([
			'title' => 'Code',
			'type' => 'varchar'
		], 'code');
		$this->addColumn([
			'title' => 'Value',
			'type' => 'varchar'
		], 'value');
		$this->addColumn([
			'title' => 'Status',
			'type' => 'tinyint'
		], 'status');
		$this->addColumn([
			'title' => 'Created Date',
			'type' => 'datetime'
		], 'createdDate');
		$this->addColumn([
			'title' => 'Updated Date',
			'type' => 'datetime'
		], 'updatedDate');
		return $this;
	}

	public function prepareActions()
	{
		$this->addAction([
			'title' => 'Edit',
			'method' => 'getEditUrl'
		], 'edit');
		$this->addAction([
			'title' => 'Delete',
			'method' => 'getDeleteUrl'
		], 'delete');
		return $this;
	}

	public function getConfigs()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('p',1);
		$count = $request->getRequest('ppr',20);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('configId') as totalCount FROM `config`");
		$this->getPager()->execute($totalRecord['totalCount'], $current, $count);
		$configs = Ccc::getModel('Config')->fetchAll("SELECT * FROM `config` LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $configs;
	}
}