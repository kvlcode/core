<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman_Customer extends Controller_Core_Action{

	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }

	public function gridAction()
	{
		$this->setTitle('Customer Assign');
		$content = $this->getLayout()->getContent();
		$customerGrid = Ccc::getBlock('Salesman_Customer_Grid');
		$content->addChild($customerGrid);
		$this->renderLayout();
	}

	public function saveAction()
	{
		try {
			
			$salesmanId = $this->getRequest()->getRequest('id');	
			$customers = $this->getRequest()->getPost('customer');
			
			if (!$customers) 
			{
				throw new Exception("Unable to load customer data.", 1);		
			}

			$customerModel = Ccc::getModel('Customer');
			if ($salesmanId != null) {
				
				if (!(int) $salesmanId) 
				{
					throw new Exception("Invalid request.", 1);
				}
				
				$customerModel->updatedDate = date('Y-m-d H:i:s');
				$customerModel->salesmanId = $salesmanId;

				foreach ($customers as $customerId) {
					$customerModel->customerId = $customerId;
					$update = $customerModel->save();
				}
				
				if (!$update) 
				{
					throw new Exception("System Can't update", 1);	
				}
				$this->getMessage()->addMessage('Data Updated.', Model_Core_Message::SUCCESS);

			}
			
			$this->redirect($this->getLayout()->getUrl(null, null, ['id' => $salesmanId], true));
		} 
		catch (Exception $e) 
		{	
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
			$this->redirect($this->getLayout()->getUrl(null, null, ['id' => $salesmanId], true));

		}
	}

	
}

?>