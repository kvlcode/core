<?php 
Ccc::loadClass('Block_Core_Template');
class Block_Category_Edit_Tabs_Category extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/edit/tabs/category.php');
	}

	public function getCategory()
	{
		return Ccc::getRegistry('category');	
	}


	public function getCategories()   
	{
		$categoryModel = Ccc::getModel('Category');
		$category = $categoryModel->fetchAll("SELECT name, path FROM categories ORDER BY path");
		return $category;
	}

	public function getParent() 
	{
		$id = $this->getCategory()->categoryId;
		$parentList = Ccc::getModel('Category')->fetchAll("SELECT path FROM categories WHERE path NOT LIKE '%$id%'");
		return $parentList;
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