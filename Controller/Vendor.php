<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Vendor extends Controller_Core_Action{

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
		$vendorGrid = Ccc::getBlock('Vendor_Index');
		$content->addChild($vendorGrid);
		$this->renderLayout();

	}

	public function gridBlockAction()
	{
		$vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $vendorGrid
		];
		$this->renderJson($response);
	}


	public function editAction()
	{	
		try 
		{
			if ((int) $this->getRequest()->getRequest('id')) 
			{	
				$this->setTitle('Vendor Edit');
				$id = (int)$this->getRequest()->getRequest('id');
				if (!$id) 
				{
					throw new Exception("Invalid Id.", 1);
				}
				$vendorModel =  Ccc::getModel('Vendor');
				$vendor = $vendorModel->load($id);
				if (!$vendor) 
				{
					throw new Exception("Unable to Load.", 1);	
				}
			}
			else
			{
				$this->setTitle('Vendor Add');
				$vendor = Ccc::getModel('Vendor');	
			}
			Ccc::register('vendor', $vendor);
			$vendorEdit = Ccc::getBlock('Vendor_Edit')->toHtml();
			$response = [
				'status' => 'success',
				'content' => $vendorEdit
			];
			$this->renderJson($response);
		} 
		catch (Exception $e) 
		 {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->gridBlockAction();	
		}
	}

	public function saveVendor()
	{		 
		$vendorData = $this->getRequest()->getPost('vendor');
		$vendorId = (int)$this->getRequest()->getRequest('id');
		$vendorModel = Ccc::getModel('Vendor');
		
		if (!$vendorData) 
		{
			throw new Exception("Missing Vendor data in request.", 1);
		}
		
		$vendorModel->setData($vendorData);
		if($vendorId) 
		{
			$vendorModel->updatedDate = date('Y-m-d H:i:s');
			$vendorModel->vendorId = $vendorId;	  
		}
		else
		{
			$vendorModel->createdDate = date('Y-m-d H:i:s');
		}
			
		$vendorRow = $vendorModel->save();
		if (!$vendorRow) 
		{
	        throw new Exception("System can't save vendor data.", 1);    	
	    }        		
		return $vendorRow;
	}

	public function saveAddress($vendorRow)
	{	
		$addressData = $this->getRequest()->getPost('address');
		if(!$addressData)
		{
			throw new Exception("Missing Address data in Request.", 1);	
		}
		
		$addressModel = Ccc::getModel('Vendor_Address');
		$addressModel->setData($addressData);
		$addressRow = $vendorRow->getAddress();

		if($addressRow->addressId) 
		{
			$addressModel->addressId = $addressRow->addressId;	
		}
		else
		{
			$addressModel->vendorId = $vendorRow->vendorId;
		}

		$saveId = $addressModel->save();
		if (!$saveId) 
		{
	        throw new Exception("System can't save address", 1);       	
	    }
		$this->getMessage()->addMessage('Data saved successfully.');
	}

	public function saveAction()
	{
		try
		{
			$vendorRow = $this->saveVendor();
			$this->saveAddress($vendorRow);
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
			if (!$id) {
				throw new Exception("Invalid Request.", 1);
			}
			
			$vendorModel = Ccc::getModel('Vendor');
			$delete = $vendorModel->delete($id); 	
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
			}
			$this->getMessage()->addMessage('Data Deleted.', Model_Core_Message::SUCCESS);
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
		$vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
 		$response = [
		'status' => 'success',
		'content' => $vendorGrid,
		'message' => $message
		];
		$this->renderJson($response);
	}
}