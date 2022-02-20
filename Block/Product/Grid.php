<?php
Ccc::loadClass('Block_Core_Template');
class Block_Product_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}

	public function getProducts()
	{
		$productTable = Ccc::getModel('Product');
		$products = $productTable->fetchAll("SELECT * FROM `product`");
		return $products;
	}

}