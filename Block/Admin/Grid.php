<?php
Ccc::loadClass('Block_Core_Grid');
class Block_Admin_Grid extends Block_Core_Grid
{
	protected $pager = null;

	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($admin)
	{
		return $this->getUrl('edit', null, ['id' => $admin->adminId]);
	}

	public function getDeleteUrl($admin)
	{
		return $this->getUrl('delete', null, ['id' => $admin->adminId]);
	}

	public function prepareCollections()
	{
		$this->setCollection($this->getAdmins());
	}

	public function prepareColumns()
	{
		$this->addColumn([
			'title' => 'Admin Id',
			'type' => 'int'
		], 'adminId');
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