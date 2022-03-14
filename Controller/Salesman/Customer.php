<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman_Customer extends Controller_Core_Action{

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
			
			if (!isset($customers)) {
				$this->getMessage()->addMessage("Unable to load.", Model_Core_Message::ERROR);
				throw new Exception("Unable to load customer data.", 1);		
			}

			$customerModel = Ccc::getModel('Customer');
			if ($salesmanId != null) {
				
				if (!(int) $salesmanId) {
					$this->getMessage()->addMessage("Invalid request.", Model_Core_Message::ERROR);
					throw new Exception("Invalid request.", 1);
				}
				
				$customerModel->updatedDate = date('Y-m-d H:i:s');
				$customerModel->salesmanId = $salesmanId;

				foreach ($customers as $customerId) {
					$customerModel->customerId = $customerId;
					$update = $customerModel->save();
				}
				
				if (!$update) {
					$this->getMessage()->addMessage("System Can't update.", Model_Core_Message::ERROR);
					throw new Exception("System Can't update", 1);	
				}
				$this->getMessage()->addMessage('Data Updated.', Model_Core_Message::SUCCESS);

			}
			
			$this->redirect($this->getView()->getUrl(null, null, ['id' => $salesmanId], true));

		} 
		catch (Exception $e) 
		{	
			$this->redirect($this->getView()->getUrl(null, null, ['id' => $salesmanId], true));

		}
	}

	
}

?>