<?php 
Ccc::loadClass('Block_Core_Template');
class Block_Product_Edit_Tabs_Product extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/edit/tabs/product.php');
	}

	public function getProduct()
	{
		return Ccc::getRegistry('product');	
	}
}