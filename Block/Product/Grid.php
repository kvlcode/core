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

		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('p',1);
		$count = $request->getRequest('ppr',20);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('productId') as totalCount FROM `product`");
		$this->getPager()->execute($totalRecord['totalCount'], $current, $count);
		$productModel = Ccc::getModel('Product');
		$products = $productModel->fetchAll("SELECT * FROM `product` LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $products;
	}

}