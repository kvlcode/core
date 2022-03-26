<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Order_Item extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Order_Item_Resource');
	}
}