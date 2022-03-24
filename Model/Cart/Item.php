<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Cart_Item extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Cart_Item_Resource');
	}
}
