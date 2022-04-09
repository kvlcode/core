<?php 
Ccc::loadClass('Block_Core_Grid');

class Block_Page_Grid extends Block_Core_Grid
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($page)
	{
		return $this->getUrl('edit', null, ['id' => $page->pageId]);
	}

	public function getDeleteUrl($page)
	{
		return $this->getUrl('delete', null, ['id' => $page->pageId]);
	}

	public function prepareCollections()
	{
		$this->setCollection($this->getPages());
	}

	public function prepareColumns()
	{
		$this->addColumn([
			'title' => 'Page Id',
			'type' => 'int'
		], 'pageId');
		$this->addColumn([
			'title' => ' Name',
			'type' => 'varchar'
		], 'name');
		$this->addColumn([
			'title' => 'Code',
			'type' => 'varchar'
		], 'code');
		$this->addColumn([
			'title' => 'Content',
			'type' => 'longtext'
		], 'content');
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

	public function getPages()
	{
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $count = (int)$request->getRequest('ppr',20);
        $totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count(pageId) as total FROM page");
        $this->getPager()->execute($totalRecord['total'], $page, $count);
        $pages = Ccc::getModel('Page')->fetchAll("SELECT * FROM page LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
        return $pages;		
	}
}