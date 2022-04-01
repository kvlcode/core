<?php Ccc::loadClass('Block_Core_Template');
class Block_Cart_Grid extends Block_Core_Template{

	public function __construct()
	{
		$this->setTemplate('view/cart/grid.php');
	}

	public function getOrders()
	{	
		$orders = Ccc::getModel('Order')->fetchAll("SELECT * FROM `orders`");
		return $orders;
	}
}