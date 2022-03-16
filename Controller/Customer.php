<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Customer extends Controller_Core_Action{

	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }

	public function gridAction()
	{
		$this->setTitle('Customer Grid');
		$customerGrid = Ccc::getBlock('Customer_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($customerGrid);
		$this->renderLayout();
	}

	public function editAction()
	{	
		try {
			
			if ((int) $this->getRequest()->getRequest('id')) {
				$this->setTitle('Customer Edit');	
				$id = (int) $this->getRequest()->getRequest('id');
				$customerModel =  Ccc::getModel('Customer');
				$customer = $customerModel->load($id);
				if (!$customer) {
					$this->getMessage()->addMessage("Unable to Load Data.", Model_Core_Message::ERROR);
					throw new Exception("Unable to Load", 1);	
				}
			}
			else
			{
				$this->setTitle('Customer Add');
				$customer = Ccc::getModel('Customer');
			}	
			
			$customerEdit = Ccc::getBlock('Customer_Edit')->setCustomer($customer);
			$content = $this->getLayout()->getContent();
			$content->addChild($customerEdit);
			$this->renderLayout();	

		} 
		catch (Exception $e) {
			$this->redirect($this->getView()->getUrl(null, null, null, true));	
		}
	}

	public function saveCustomer()
	{	 
		$customerData = $this->getRequest()->getPost('customer');
		if (!$customerData) {
			$this->getMessage()->addMessage("Missing Customer data in request.", Model_Core_Message::ERROR);
			throw new Exception("Missing Customer data in request.", 1);
		}
		
		$customerModel = Ccc::getModel('Customer');
		$customerModel->setData($customerData);
		$customerId = (int) $this->getRequest()->getRequest('id');
		if($customerId) 
		{
			$customerModel->updatedDate = date('Y-m-d H:i:s');
			$customerModel->customerId = $customerId;
			$update = $customerModel->save();
			if (!$update) {
				$this->getMessage()->addMessage("System can't update customer data.", Model_Core_Message::ERROR);
				throw new Exception("System can't update customer data", 1);
			}		
		}
		else
		{
			$customerModel->createdDate = date('Y-m-d H:i:s');
			$customerId = $customerModel->save();
			if (!$customerId) {
				$this->getMessage()->addMessage("System can't insert customer data.", Model_Core_Message::ERROR);
		        throw new Exception("System can't insert customer data", 1);   	
		    }    
		}
		return $customerId;
	}

	public function saveBillingAddress($customerId)
	{	
		$addressData = $this->getRequest()->getPost('billingAddress');
		if(!$addressData){
			$this->getMessage()->addMessage("Missing Address data in Request.", Model_Core_Message::ERROR);
			throw new Exception("Missing Address data in Request.", 1);	
		}

		$address = Ccc::getModel('Customer_Address');
		$address->setData($addressData);
		$address->billing = 1;
		$address->shipping = 0;
		$addressRow = $address->load($customerId, 'customerId');
	
		if ($addressRow) 
		{
			$address->addressId = $addressRow->addressId;
		}
		else
		{
			$address->customerId = $customerId;
		}

		$saveId = $address->save();
		if (!$saveId) 
		{
			$this->getMessage()->addMessage("System can't save address.", Model_Core_Message::ERROR);
	        throw new Exception("System can't save address.", 1);   	
	    }
		$this->getMessage()->addMessage("Data saved successfully.");    
	}

	public function saveShippingAddress($customerId)
	{	
		$addressData = $this->getRequest()->getPost('shippingAddress');
		if(!$addressData){
			$this->getMessage()->addMessage("Missing Address data in Request.", Model_Core_Message::ERROR);
			throw new Exception("Missing Address data in Request.", 1);	
		}

		$address = Ccc::getModel('Customer_Address');
		$address->setData($addressData);

		$address->billing = 0;
		$address->shipping = 1;
		$addressRow = $address->fetchRow("SELECT * FROM `customer_address` 
											WHERE `customerId` = {$customerId} AND `shipping` = 1");

		if ($addressRow) 
		{
			$address->addressId = $addressRow->addressId;
		}
		else
		{
			$address->customerId = $customerId;
		}

		$saveId = $address->save();
		if (!$saveId) 
		{
			$this->getMessage()->addMessage("System can't save address.", Model_Core_Message::ERROR);
	        throw new Exception("System can't save address.", 1);   	
	    }
		$this->getMessage()->addMessage("Data saved successfully.");    
	}

	public function saveAction()
	{
		try{
			
			$customerId = $this->saveCustomer();
			$this->saveBillingAddress($customerId);
			$this->saveShippingAddress($customerId);
			$this->redirect($this->getView()->getUrl(null, null, null, true));

	    }catch(Exception $e){
	    	$this->redirect($this->getView()->getUrl(null, null, null, true));	
	    }
	}    	

	public function deleteAction()
	{
		
		try {
	
			$id = $this->getRequest()->getRequest('id');
			if (!isset($id)) {
				$this->getMessage()->addMessage("Invalid Request.", Model_Core_Message::ERROR);
				throw new Exception("Invalid Request.", 1);
			}
			
			$customerModel = Ccc::getModel('Customer');
			$delete = $customerModel->delete($id); 
	
			if(!$delete)
			{
				$this->getMessage()->addMessage("System can't delete record.", Model_Core_Message::ERROR);
				throw new Exception("System can't delete record.", 1);
			}
			$this->getMessage()->addMessage("Data Deleted.");
			$this->redirect($this->getView()->getUrl(null, null, null, true));	
		}
		catch (Exception $e) {			
			$this->redirect($this->getView()->getUrl(null, null, null, true));	
		}
	}
}

?>