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
		$categoryModel = Ccc::getModel('Category');
		$categories = $categoryModel->fetchAll("SELECT c.*,
													b.name AS baseImage, 
													t.name AS thumbImage, 
													s.name AS smallImage
													FROM 
													categories c LEFT JOIN category_media b ON c.categoryId = b.categoryId AND (b.base = 1)
													LEFT JOIN category_media t ON c.categoryId = t.categoryId AND (t.thumbnail = 1)
													LEFT JOIN category_media s ON c.categoryId = s.categoryId AND (s.small =1);");
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