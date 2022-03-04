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
		$productModel = Ccc::getModel('Product');
		$products = $productModel->fetchAll("SELECT p.*,
													b.imageId AS baseImage, 
													t.imageId AS thumbImage, 
													s.imageId AS smallImage
													FROM 
													product p LEFT JOIN product_media b ON p.productId = b.productId AND (b.base = 1)
													LEFT JOIN product_media t ON p.productId = t.productId AND (t.thumbnail = 1)
													LEFT JOIN product_media s ON p.productId = s.productId AND (s.small =1);");
		return $products;
	}

}