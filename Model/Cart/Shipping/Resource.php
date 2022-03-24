<?php  Ccc::loadClass('Model_Core_Row_Resource');?>
<?php
class Model_Cart_Shipping_Resource extends Model_Core_Row_Resource
{
		protected $resourceName = null;
		protected $primaryKey = null;
		
	public function __construct()
	{
		$this->setResourceName('cart_shipping');
		$this->setPrimaryKey('shippingId');
	}
}