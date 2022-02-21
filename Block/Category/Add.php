<?php
Ccc::loadClass('Block_Core_Template');
class Block_Category_Add extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/add.php');
	}

	public function getCategories()
	{
		return $this->getData('parentCategory');
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

