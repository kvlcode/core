<?php
Ccc::loadClass('Block_Core_Template');
class Block_Category_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/edit.php');
	}

	public function getCategories()   //Add
	{
		$categoryModel = Ccc::getModel('Category');
		$category = $categoryModel->fetchAll("SELECT name, path FROM categories ORDER BY path");
		return $category;
	}

	public function getCategory()   //Edit
	{
		return $this->getData('categoryRow');
	}

	public function getParent() //Edit
	{

		$id = $this->getCategory()->categoryId;
		$parentList = Ccc::getModel('Category')->fetchAll("SELECT path FROM categories WHERE path NOT LIKE '%$id%'");
		return $parentList;
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