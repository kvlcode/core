<?php  Ccc::loadClass('Model_Core_Row_Resource');?>
<?php
class Model_Order_Address_Resource extends Model_Core_Row_Resource
{
	protected $resourceName = null;
	protected $primaryKey = null;
		
	public function __construct()
	{
		$this->setResourceName('order_address');
		$this->setPrimaryKey('addressId');
	}
}