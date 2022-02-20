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
}