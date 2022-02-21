<?php
Ccc::loadClass('Block_Core_Template');
class Block_Category_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
	}

	public function getCategories()
	{
		$categoryTable = Ccc::getModel('Category');
		$categories = $categoryTable->fetchAll("SELECT * FROM categories");
		return $categories;
	}

	public function path($path)
	{	
		global $adapter;
		$pathArray = explode("/", $path);
		$temp1 = [];
			foreach ($pathArray as $value) {
				$temp2 = $adapter->fetchRow("SELECT name FROM categories WHERE categoryId = '$value'");
				$temp1[] = $temp2['name'];

			}
			
		$finalPath = implode("=>", $temp1); 	
		return $finalPath;	
				
	}
}