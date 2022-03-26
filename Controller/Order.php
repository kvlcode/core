<?php Ccc::loadClass('Controller_Core_Action');

class Controller_Order extends Controller_Core_Action{

	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }

	public function editAction()
	{
		$orderId = (int) $this->getRequest()->getRequest('orderId');
		$this->setTitle('Order');
    	$orderModel = Ccc::getModel('Order')->load($orderId);
		$orderEdit = Ccc::getBlock('Order_Edit')->setOrder($orderModel);
		$content = $this->getLayout()->getContent();
		$content->addChild($orderEdit);
		$this->renderLayout();
	}


}