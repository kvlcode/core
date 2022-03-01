<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Vendor extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Vendor_Grid')->toHtml();
	}

	public function editAction()
	{	

		try {

			if ((int) $this->getRequest()->getRequest('id')) {
				
				$id = (int) $this->getRequest()->getRequest('id');
				if (!$id) {
					throw new Exception("Invalid Id", 1);
				}
				$vendorModel =  Ccc::getModel('Vendor');
				$vendor = $vendorModel->fetchRow("SELECT v.*,a.*
							                        FROM vendor v
							                        JOIN vendor_address a
							                        ON a.vendorId = v.vendorId
							                        WHERE v.vendorId = {$id}");
				if (!$vendor) {
					throw new Exception("Unable to Load", 1);	
				}

			}
			else
			{
				$vendor = Ccc::getModel('Vendor');	
			}
			
			Ccc::getBlock('Vendor_Edit')->setData(['vendorEdit' => $vendor])->toHtml();	

		} 
		catch (Exception $e) {
			echo $e->getMessage();
		}

	}

	public function saveVendor()
	{	
		 
		$vendorData = $this->getRequest()->getPost('vendor');
		if (!isset($vendorData)) {
			throw new Exception("Missing Vendor data in request.", 1);
		}
		
		$vendorModel = Ccc::getModel('Vendor');
		$vendorModel->setData($vendorData);

		if (!empty($vendorData['vendorId'])) {
			if (!(int)$vendorData['vendorId']) {
				throw new Exception("Invalid Request", 1);
				
			}

			$vendorId = $vendorData['vendorId'];

			$vendorModel->updatedDate = date('Y-m-d H:i:s');
			$update = $vendorModel->save();

			if (!$update) {
					throw new Exception("System can't update vendor data", 1);
			}	
				
		}else{

			unset($vendorModel->vendorId);
			$vendorModel->createdDate = date('Y-m-d H:i:s');
			$vendorId = $vendorModel->save();
			
			if (!$vendorId) {
		        throw new Exception("System can't insert vendor data", 1);
		        	
		    }        		
		}
		return $vendorId;
	}

	public function saveAddress($vendorId)
	{	
		$addressModel = Ccc::getModel('Vendor_Address');
		$addressRow = $addressModel->load($vendorId, 'vendorId');
		$addressData = $this->getRequest()->getPost('address');
		
		if(!isset($addressData)){
			throw new Exception("Missing Address data in Request ", 1);	
		}
		
		$addressModel->setData($addressData);

		$addressInfo = $addressModel->fetchAll("SELECT * FROM vendor_address WHERE vendorId = {$vendorId}");		

		if ($addressInfo) {

			$addressModel->addressId = $addressRow->addressId;
			$update = $addressModel->save();
		
				if (!$update) {
					throw new Exception("System can't update address", 1);
				}	

		}else{

			$addressModel->vendorId = $vendorId;
			$insertId = $addressModel->save();

			if (!$insertId) {
		         	throw new Exception("System can't insert address", 1);       	
		    }
		}
	}

	public function saveAction()
	{
		try{
			
			$vendorId = $this->saveVendor();
			$this->saveAddress($vendorId);
			$this->redirect($this->getView()->getUrl('grid', 'vendor'));

	    }catch(Exception $e){
	    	echo $e->getMessage();

	    }
	}    	

	public function deleteAction()
	{
		
		try {
	
			$id = $this->getRequest()->getRequest('id');
			if (!isset($id)) {
				throw new Exception("Invalid Request.", 1);
			}
			
			$vendorModel = Ccc::getModel('Vendor');
			$delete = $vendorModel->delete($id); 
	
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
				$this->redirect($this->getView()->getUrl('grid', 'vendor'));	
				
		} catch (Exception $e) {
				
			echo $e->getMessage();
		}

	}

	public function errorAction()
	{
		echo "Error...";
	}

}

?>