<?php
Ccc::loadClass('Model_Core_Row_Resource');
class Model_Product_Media_Resource extends Model_Core_Row_Resource
{
	protected $resourceName = NULL;
	protected $primaryKey = NULL;

	public function __construct()
	{
		$this->setResourceName('product_media');
		$this->setPrimaryKey('imageId');
	}
}
