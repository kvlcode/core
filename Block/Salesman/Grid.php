<?php
Ccc::loadClass('Block_Core_Grid');

class Block_Salesman_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($salesman)
	{
		return $this->getUrl('edit', null, ['id' => $salesman->salesmanId]);
	}

	public function getDeleteUrl($salesman)
	{
		return $this->getUrl('delete', null, ['id' => $salesman->salesmanId]);
	}

	public function prepareCollections()
	{
		$this->setCollection($this->getSalesman());
	}

	public function prepareColumns()
	{
		$this->addColumn([
			'title' => 'Salesman Id',
			'type' => 'int'
		], 'salesmanId');
		$this->addColumn([
			'title' => 'First Name',
			'type' => 'varchar'
		], 'firstName');
		$this->addColumn([
			'title' => 'Last Name',
			'type' => 'varchar'
		], 'lastName');
		$this->addColumn([
			'title' => 'Email',
			'type' => 'varchar'
		], 'email');
		$this->addColumn([
			'title' => 'Mobile',
			'type' => 'varchar'
		], 'mobile');
		$this->addColumn([
			'title' => 'Discount',
			'type' => 'varchar'
		], 'discount');
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

	public function getSalesman()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('p',1);
		$count = $request->getRequest('ppr',20);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('salesmanId') as totalCount FROM `salesman`");
		$this->getPager()->execute($totalRecord['totalCount'], $current, $count);
		$salesmanModel = Ccc::getModel('Salesman');
		$salesman = $salesmanModel->fetchAll("SELECT * FROM `salesman` LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $salesman;
	}
}