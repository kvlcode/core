<?php
Ccc::loadClass('Block_Core_Template');
class Block_Category_Grid extends Block_Core_Template
{
	protected $pager = null;

	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
	}

	public function getCategories()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('p',1);
		$count = $request->getRequest('ppr',20);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('categoryId') as totalCount FROM `categories`");
		$this->getPager()->execute($totalRecord['totalCount'], $current, $count);
		$categoryModel = Ccc::getModel('Category');
		$categories = $categoryModel->fetchAll("SELECT * FROM `categories` LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $categories;
	}

	public function path($path)
	{	
		$category = Ccc::getModel('Category');
		$pathArray = explode("/", $path);
		$temp1 = [];
			foreach ($pathArray as $value) {
				$temp2 = $category->fetchRow("SELECT name FROM `categories` WHERE categoryId = '$value'");
				$temp1[] = $temp2->name;

			}	
		$finalPath = implode("=>", $temp1); 	
		return $finalPath;	
				
	}
}