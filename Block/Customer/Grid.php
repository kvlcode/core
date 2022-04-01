<?php
Ccc::loadClass('Block_Core_Grid');
class Block_Customer_Grid extends Block_Core_Grid
{
	protected $pager = null;
	public function __construct()
	{
		parent::__construct();
		$this->getAddress();
		// $this->setTemplate('view/customer/grid.php');
	}

	public function getEditUrl($customer)
	{
		return $this->getUrl('edit', null, ['id' => $customer->customerId]);
	}

	public function getDeleteUrl($customer)
	{
		return $this->getUrl('delete', null, ['id' => $customer->adminId]);
	}

	public function prepareCollections()
	{
		$this->setCollection($this->getCustomers());
	}

	public function getAddress()
	{
		$customers = $this->getCustomers();
		foreach ($customers as $customer) 
		{
			$address[] = $customer->getBillingAddresses();
		}
		print_r($address);
	}

	public function prepareColumns()
	{
		$this->addColumn([
			'title' => 'Customer Id',
			'type' => 'int'
		], 'customerId');
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
			'type' => 'int'
		], 'mobile');
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