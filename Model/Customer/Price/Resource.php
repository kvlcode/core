<?php
Ccc::loadClass('Model_Core_Row_Resource');

class Model_Customer_Price_Resource extends Model_Core_Row_Resource{

	protected $resourceName = NULL;
	protected $primaryKey = NULL;

	public function __construct()
	{
		$this->setResourceName('customer_price')->setPrimaryKey('entityId');
	}
}