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

    public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$customerGrid = Ccc::getBlock('Customer_Index');
		$content->addChild($customerGrid);
		$this->renderLayout();

	}

	public function gridBlockAction()
	{
		$customerGrid = Ccc::getBlock('Customer_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $customerGrid
		];
		$this->renderJson($response);
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
			
			Ccc::register('customer', $customer);
			$categoryEdit = Ccc::getBlock('Category_Edit')->toHtml();
			$response = [
			'status' => 'success',
			'content' => $categoryEdit
			];
			$this->renderJson($response);	

		} 
		catch (Exception $e) 
		{	
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
			$this->gridBlockAction();
	
		}
	}

	public function saveCustomer()
	{	 
		$customerData = $this->getRequest()->getPost('customer');
		$customerId = (int) $this->getRequest()->getRequest('id');
		$customerModel = Ccc::getModel('Customer');

		if (!$customerData) 
		{
			throw new Exception("Missing Customer data in request.", 1);
		}
		
		$customerModel->setData($customerData);
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
	    // $this->redirect($this->getLayout()->getUrl('edit','customer', ['id'=>$customerRow->customerId, 'tab' => 'address'],true));   
		return $customerRow;
		
	}

	public function saveBillingAddress($customerRow = null)
	{	
		$customerId = (int) $this->getRequest()->getRequest('id');
		$customerModel = Ccc::getModel('Customer')->load($customerId);
		$addressData = $this->getRequest()->getPost('billingAddress');

		if(!$addressData)
		{
			throw new Exception("Missing Address data in Request.", 1);	
		}

		$addressRow = $customerModel->getBillingAddresses();
		$address = Ccc::getModel('Customer_Address');
		$address->setData($addressData);
		$address->billing = Model_Customer_Address::BILLING;

		if ($addressRow->addressId) 
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
	        throw new Exception("System can't save address.", 1);  
	    }
		$this->getMessage()->addMessage("Data saved successfully.");    
	}

	public function saveShippingAddress($customerRow = null)
	{	
		$customerId = $this->getRequest()->getRequest('id');
		$customerModel = Ccc::getModel('Customer')->load($customerId);
		$addressData = $this->getRequest()->getPost('shippingAddress');
		if(!$addressData)
		{
			throw new Exception("Missing Address data in Request.", 1);	
		}

		$address = Ccc::getModel('Customer_Address');
		$address->setData($addressData);
		$address->shipping = Model_Customer_Address::SHIPPING;
		$addressRow = $customerModel->getShippingAddresses();

		if ($addressRow->addressId) 
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
		try
		{	
			$customerRow = $this->saveCustomer();
			$this->saveBillingAddress();
			$this->saveShippingAddress();
			$this->redirectPage();
	    }
	    catch(Exception $e)
	    {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
			$this->redirectPage();
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
			$this->redirectPage();
		}
		catch (Exception $e) 
		{	
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);			
			$this->redirectPage();
		}
	}

	public function redirectPage()
	{
		$customerGrid = Ccc::getBlock('Customer_Grid')->toHtml();
 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
 		$response = [
		'status' => 'success',
		'content' => $customerGrid,
		'message' => $message
		];
		$this->renderJson($response);	
	}
}
