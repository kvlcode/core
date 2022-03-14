<?php
Ccc::loadClass('Block_Core_Template');
class Block_Product_Edit extends Block_Core_Template
{
	protected $product = null;

	public function __construct()
	{
		$this->setTemplate('view/product/edit.php');
	}

	public function getProduct()
	{
		return $this->product;

	}

	public function setProduct($product)
	{
		$this->product = $product;
		return $this;
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


	public function getCategories()
	{
		$category = Ccc::getModel('Category');
		$categories = $category->fetchAll("SELECT * FROM categories where status = 1");
		return $categories;
	}


	public function getSelect($categoryId)
	{
		$productId = Ccc::getFront()->getRequest()->getRequest('id');
		$categoryProduct = Ccc::getModel('Category_Product');
		$selectedValues = $categoryProduct->fetchAll("SELECT * FROM `category_product` WHERE `productId` = '{$productId}' AND `categoryId` = '{$categoryId}'");

		if($selectedValues){
            return "checked";
        }
        return null;
	}

}