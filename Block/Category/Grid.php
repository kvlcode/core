<?php
Ccc::loadClass('Block_Core_Template');
class Block_Category_Grid extends Block_Core_Template
{
	public $pager = null;

	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
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

	public function getCategories()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('p',1);
		$count = $request->getRequest('count',20);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('categoryId') as totalCount FROM `category`");
		$this->getPager()->execute($totalRecord['totalCount'], $current, $count);
		$categoryModel = Ccc::getModel('Category');
		$categories = $categoryModel->fetchAll("SELECT c.*,
													b.name AS baseImage, 
													t.name AS thumbImage, 
													s.name AS smallImage
													FROM 
													categories c LEFT JOIN category_media b ON c.categoryId = b.categoryId AND (b.base = 1)
													LEFT JOIN category_media t ON c.categoryId = t.categoryId AND (t.thumbnail = 1)
													LEFT JOIN category_media s ON c.categoryId = s.categoryId AND (s.small =1) LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $categories;
	}

	public function path($path)
	{	
		$category = Ccc::getModel('Category');
		$pathArray = explode("/", $path);
		$temp1 = [];
			foreach ($pathArray as $value) {
				$temp2 = $category->fetchRow("SELECT name FROM categories WHERE categoryId = '$value'");
				$temp1[] = $temp2->name;

			}	
		$finalPath = implode("=>", $temp1); 	
		return $finalPath;	
				
	}
}