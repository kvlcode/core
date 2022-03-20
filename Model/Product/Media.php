<?php
 Ccc::loadClass('Model_Core_Row');
class Model_Product_Media extends Model_Core_Row{

	protected $product;
	protected $path = 'Media/Product';

	public function __construct()
	{	
		$this->setResourceClassName('Product_Media_Resource');
	}

	public function setProduct($product)
	{
		$this->product = $product;
		return $this;
	}

	public function getProduct($reload = false)
	{
		$productModel = Ccc::getModel('Product'); 
		if(!$this->product)
		{
			return null;
		}
		if($this->product && !$reload)
		{
			return $this->product;
		}
		$product = $mediaModel->fetchRow("SELECT * FROM `image` WHERE `productId` = {$this->product}");
		if(!$product)
		{
			return null;
		}
		$this->setProduct($product);

		return $this->product;
	}

	public function getImageUrl()
	{
		return Ccc::getPath();
	}
}
