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
		try 
		{
			if ((int) $this->getRequest()->getRequest('id')) 
			{
				$this->setTitle('Customer Edit');	
				$id = (int) $this->getRequest()->getRequest('id');
				$customerModel =  Ccc::getModel('Customer');
				$customer = $customerModel->load($id);
				if (!$customer) 
				{
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
		catch (Exception $e) 
		{	
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
			$this->redirect($this->getLayout()->getUrl(null, null, null, true));	
		}
	}

	public function saveCustomer()
	{	 
		$customerData = $this->getRequest()->getPost('customer');
		if (!$customerData) 
		{
			throw new Exception("Missing Customer data in request.", 1);
		}
		
		$customerModel = Ccc::getModel('Customer');
		$customerModel->setData($customerData);
		$customerId = (int) $this->getRequest()->getRequest('id');
		if($customerId) 
		{
			$customerModel->updatedDate = date('Y-m-d H:i:s');
			$customerModel->customerId = $customerId;		
		}
		else
		{
			$customerModel->createdDate = date('Y-m-d H:i:s');
		}

		$customerRow = $customerModel->save();
		if (!$customerRow) 
		{
	        throw new Exception("System can't save customer data", 1);   	
	    }    
		return $customerRow;
	}

	public function saveBillingAddress($customerRow)
	{	
		$addressData = $this->getRequest()->getPost('billingAddress');
		if(!$addressData)
		{
			throw new Exception("Missing Address data in Request.", 1);	
		}

		$address = Ccc::getModel('Customer_Address');
		$address->setData($addressData);
		$address->billing = 1;
		$address->shipping = 0;
		$addressRow = $customerRow->getBillingAddresses();
	
		if ($addressRow->addressId) 
		{
			$address->addressId = $addressRow->addressId;
		}
		else
		{
			$address->customerId = $customerRow->customerId;
		}

		$saveId = $address->save();
		if (!$saveId) 
		{
	        throw new Exception("System can't save address.", 1);   	
	    }
		$this->getMessage()->addMessage("Data saved successfully.");    
	}

	public function saveShippingAddress($customerRow)
	{	
		$addressData = $this->getRequest()->getPost('shippingAddress');
		if(!$addressData)
		{
			throw new Exception("Missing Address data in Request.", 1);	
		}

		$address = Ccc::getModel('Customer_Address');
		$address->setData($addressData);
		$address->billing = 0;
		$address->shipping = 1;
		$addressRow = $customerRow->getShippingAddresses();

		if ($addressRow->addressId) 
		{
			$address->addressId = $addressRow->addressId;
		}
		else
		{
			$address->customerId = $customerRow->customerId;
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
		try
		{	
			$customerRow = $this->saveCustomer();
			$this->saveBillingAddress($customerRow);
			$this->saveShippingAddress($customerRow);
			$this->redirect($this->getLayout()->getUrl(null, null, null, true));
	    }
	    catch(Exception $e)
	    {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
	    	$this->redirect($this->getLayout()->getUrl(null, null, null, true));	
	    }
	}    	

	public function deleteAction()
	{
		try 
		{
			$id = $this->getRequest()->getRequest('id');
			if (!isset($id)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			$customerModel = Ccc::getModel('Customer');
			$delete = $customerModel->delete($id); 
	
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
			}
			$this->getMessage()->addMessage("Data Deleted.");
			$this->redirect($this->getLayout()->getUrl(null, null, null, true));	
		}
		catch (Exception $e) 
		{	
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);			
			$this->redirect($this->getLayout()->getUrl(null, null, null, true));	
		}
	}
}
