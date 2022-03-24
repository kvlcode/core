<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Cart_Shipping extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Cart_Shipping_Resource');
	}
}
