<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Vendor extends Controller_Core_Action{

	public function gridAction()
	{
		$vendorGrid = Ccc::getBlock('Vendor_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($vendorGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Vendor_Grid');
		$this->renderLayout();
	}

	public function editAction()
	{	

		try {

			if ((int) $this->getRequest()->getRequest('id')) {
				
				$id = (int)$this->getRequest()->getRequest('id');
				if (!$id) {
					$this->getMessage()->addMessage("Invalid Id.", Model_Core_Message::ERROR);
					throw new Exception("Invalid Id.", 1);
				}
				$vendorModel =  Ccc::getModel('Vendor');
				$vendor = $vendorModel->fetchRow("SELECT v.*,a.*
							                        FROM vendor v
							                        JOIN vendor_address a
							                        ON a.vendorId = v.vendorId
							                        WHERE v.vendorId = {$id}");
				if (!$vendor) {
					$this->getMessage()->addMessage("Unable to Load.", Model_Core_Message::ERROR);
					throw new Exception("Unable to Load.", 1);	
				}

			}
			else
			{
				$vendor = Ccc::getModel('Vendor');	
			}
			
			$vendorEdit = Ccc::getBlock('Vendor_Edit')->setVendor($vendor);
			$content = $this->getLayout()->getContent();
			$content->addChild($vendorEdit);
			$this->getLayout()->getChild('content')->getChild('Block_Vendor_Edit');
			$this->renderLayout();	

		} 
		catch (Exception $e) {
			$this->redirect($this->getView()->getUrl(null, null, null, true));	

		}

	}

	public function saveVendor()
	{		 
		$vendorData = $this->getRequest()->getPost('vendor');
		if (!$vendorData) {
			$this->getMessage()->addMessage("Missing Vendor data in request.", Model_Core_Message::ERROR);
			throw new Exception("Missing Vendor data in request.", 1);
		}
		
		$vendorModel = Ccc::getModel('Vendor');
		$vendorModel->setData($vendorData);
		$vendorId = (int)$this->getRequest()->getRequest('id');
		if ($vendorId) 
		{
			$vendorModel->updatedDate = date('Y-m-d H:i:s');
			$vendorModel->vendorId = $vendorId;	
			$update = $vendorModel->save();
			if (!$update) {
				$this->getMessage()->addMessage("System can't update vendor data.", Model_Core_Message::ERROR);
		        throw new Exception("System can't update vendor data.", 1);    	
		    }    
		}
		else
		{
			$vendorModel->createdDate = date('Y-m-d H:i:s');
			$vendorId = $vendorModel->save();
			if (!$vendorId) {
				$this->getMessage()->addMessage("System can't save vendor data.", Model_Core_Message::ERROR);
		        throw new Exception("System can't save vendor data.", 1);    	
		    }        		
		}
		return $vendorId;
	}

	public function saveAddress($vendorId)
	{	
		$addressModel = Ccc::getModel('Vendor_Address');
		$addressRow = $addressModel->load($vendorId, 'vendorId');
		$addressData = $this->getRequest()->getPost('address');
		
		if(!$addressData){
			$this->getMessage()->addMessage("Missing Address data in Request.", Model_Core_Message::ERROR);
			throw new Exception("Missing Address data in Request.", 1);	
		}
		
		$addressModel->setData($addressData);	
	
		if ($addressRow) 
		{
			$addressModel->addressId = $addressRow->addressId;	
		}
		else
		{
			$addressModel->vendorId = $vendorId;
		}

		$saveId = $addressModel->save();
		if (!$saveId) {
			$this->getMessage()->addMessage("System can't save address.", Model_Core_Message::ERROR);
	        throw new Exception("System can't save address", 1);       	
	    }
		$this->getMessage()->addMessage('Data saved successfully.');
	}

	public function saveAction()
	{
		try{
			
			$vendorId = $this->saveVendor();
			$this->saveAddress($vendorId);
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
			
			$vendorModel = Ccc::getModel('Vendor');
			$delete = $vendorModel->delete($id); 
	
			if(!$delete)
			{
				$this->getMessage()->addMessage("System can't delete record.", Model_Core_Message::ERROR);
				throw new Exception("System can't delete record.", 1);
			}
			$this->getMessage()->addMessage('Data Deleted.', Model_Core_Message::SUCCESS);
			$this->redirect($this->getView()->getUrl(null, null, null, true));	
				
		} catch (Exception $e) {	
			$this->redirect($this->getView()->getUrl(null, null, null, true));	
		}

	}

	public function errorAction()
	{
		echo "Error...";
	}

}

?>