<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Cart_Payment extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Cart_Payment_Resource');
	}
}



