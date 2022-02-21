<?php
Ccc::loadClass('Block_Core_Template');
class Block_Category_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/edit.php');
	}

	public function getCategory()
	{
		return $this->getData('categoryRow');	
	}

	public function getParent()
	{
		return $this->getData('parent');	
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