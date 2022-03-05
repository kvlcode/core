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

}