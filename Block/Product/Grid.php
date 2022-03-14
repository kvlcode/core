<?php
Ccc::loadClass('Block_Core_Template');
class Block_Product_Grid extends Block_Core_Template
{
	public $pager;

	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this;
	}

	public function getPager()
	{
		if(!$this->pager)
		{
			$this->setPager(Ccc::getModel('Core_Pager'));
		}
		return $this->pager;
	}

	public function getProducts()
	{

		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('p',1);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('productId') as totalCount FROM `product`");
		$this->getPager()->execute($totalRecord['totalCount'], $current);
		$productModel = Ccc::getModel('Product');
		$products = $productModel->fetchAll("SELECT p.*,
													b.name AS baseImage, 
													t.name AS thumbImage, 
													s.name AS smallImage
													FROM 
													product p LEFT JOIN product_media b ON p.productId = b.productId AND (b.base = 1)
													LEFT JOIN product_media t ON p.productId = t.productId AND (t.thumbnail = 1)
													LEFT JOIN product_media s ON p.productId = s.productId AND (s.small =1) LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $products;
	}

}