<?php
Ccc::loadClass('Model_Core_Row_Resource');
class Model_Cart_Resource extends Model_Core_Row_Resource
{
	protected $resourceName = NULL;
	protected $primaryKey = NULL;

	public function __construct()
	{
		$this->setResourceName('cart');
		$this->setPrimaryKey('cartId');
	}
}