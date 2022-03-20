<?php 
Ccc::loadClass('Block_Core_Template');

class Block_Page_Grid extends Block_Core_Template{

	protected $pager = null;

	public function __construct()
	{
		$this->setTemplate('view/page/grid.php');
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

	public function getPages()
	{
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $count = (int)$request->getRequest('count',20);
        $totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count(pageId) as total FROM page");
        $this->getPager()->execute($totalRecord['total'], $page, $count);
        $pages = Ccc::getModel('Page')->fetchAll("SELECT * FROM page LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
        return $pages;		
	}
}