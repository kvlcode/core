<?php
Ccc::loadClass('Block_Core_Grid');
class Block_Vendor_Grid extends Block_Core_Grid
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($vendor)
	{
		return $this->getUrl('edit', null, ['id' => $vendor->vendorId]);
	}

	public function getDeleteUrl($vendor)
	{
		return $this->getUrl('delete', null, ['id' => $vendor->vendorId]);
	}

	public function prepareCollections()
	{
		$this->setCollection($this->getVendors());
		// $vendors = $this->getVendorData();
  //       foreach ($vendors as &$vendor) 
  //       {
  //           $vendorAddress = $vendor->getAddress()->getData();
  //           $vendor->setData($vendorAddress);
  //       }
  //       $this->setCollection($vendors);
  //       return $this;
	}

	public function prepareColumns()
	{
		$this->addColumn([
			'title' => 'Vendor Id',
			'type' => 'int'
		], 'vendorId');
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
			'title' => 'Address',
			'type' => 'varchar'
		],'address');
		$this->addColumn([
			'title' => 'Postal Code',
			'type' => 'int'
		],'postalCode');
		$this->addColumn([
			'title' => 'City',
			'type' => 'varchar'
		],'city');
		$this->addColumn([
			'title' => 'State',
			'type' => 'varchar'
		],'state');
			$this->addColumn([
			'title' => 'Country',
			'type' => 'varchar'
		],'country');
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

	public function getVendors()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('p',1);
		$count = $request->getRequest('ppr',20);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('vendorId') as totalCount FROM `vendor`");
		$this->getPager()->execute($totalRecord['totalCount'], $current, $count);
		$vendors = Ccc::getModel('Vendor')->fetchAll("SELECT * FROM `vendor` LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $vendors;
	}

}