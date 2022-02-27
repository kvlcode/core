<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Customer extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Customer_Grid')->toHtml();
	}

	public function addAction()
	{	
		$customer = Ccc::getModel('Customer');
		Ccc::getBlock('Customer_Edit')->setData(['customerEdit' => $customer])->toHtml();
	}

	public function editAction()
	{	

		try {
			
			$id = (int) $this->getRequest()->getRequest('id');
			if (!$id) {
				throw new Exception("Invalid Id", 1);
				
			}
		
			$customerModel =  Ccc::getModel('Customer');
			$customer = $customerModel->fetchRow("SELECT c.*,a.*
						                        FROM customer c
						                        JOIN address a
						                        ON a.customerId = c.customerId
						                        WHERE c.customerId = {$id}");
			
			if (!$customer) {
				throw new Exception("Unable to Load", 1);	
			}
			
			Ccc::getBlock('Customer_Edit')->setData(['customerEdit' => $customer])->toHtml();	

		} 
		catch (Exception $e) {
			echo $e->getMessage();
		}

	}

	public function saveCustomer()
	{	
		 
		$customerData = $this->getRequest()->getPost('customer');
		if (!isset($customerData)) {
			throw new Exception("Missing Customer data in request.", 1);
		}
		
		$customerModel = Ccc::getModel('Customer');
		$customerModel->setData($customerData);

		if (!empty($customerData['customerId'])) {
			if (!(int)$customerData['customerId']) {
				throw new Exception("Invalid Request", 1);
				
			}

			$customerId = $customerData['customerId'];

			// unset($customerData['customerId']);
			$customerModel->updatedDate = date('Y-m-d H:i:s');
			$update = $customerModel->save();

			if (!$update) {
					throw new Exception("System can't update customer data", 1);
			}	
				
		}else{

			unset($customerModel->customerId);
			$customerModel->createdDate = date('Y-m-d H:i:s');
			$customerId = $customerModel->save();
			
			if (!$customerId) {
		        throw new Exception("System can't insert customer data", 1);
		        	
		    }
		        		
		}

		return $customerId;
	}

	public function saveAddress($customerId)
	{	

		$addressModel = Ccc::getModel('Customer_Address');
		$addressRow = $addressModel->load($customerId, 'customerId');
		$addressData = $this->getRequest()->getPost('address');
		
		if(!isset($addressData)){
			throw new Exception("Missing Address data in Request ", 1);	
		}
		
		$addressModel->setData($addressData);

		$billing = 0;
		if(array_key_exists('billing',$addressData) && $addressData["billing"] == 1){
			$billing = 1;
		}
		$shipping = 0;
		if(array_key_exists('shipping',$addressData) && $addressData["shipping"] == 1){
			$shipping = 1;
		}

		$addressModel->billing = $billing;
		$addressModel->shipping = $shipping;

		$addressInfo = $addressModel->fetchAll("SELECT * FROM address WHERE customerId = {$customerId}");		

		if ($addressInfo) {

			$addressModel->addressId = $addressRow->addressId;
			$update = $addressModel->save();
		
				if (!$update) {
					throw new Exception("System can't update address", 1);
				}	

		}else{

			$addressModel->customerId = $customerId;
			$insertId = $addressModel->save();

			if (!$insertId) {
		         	throw new Exception("System can't insert address", 1);
		        	
		    }
		}

	}

	public function saveAction()
	{
		try{
			
			$customerId = $this->saveCustomer();
			$this->saveAddress($customerId);
			$this->redirect($this->getView()->getUrl('grid', 'customer'));

	    }catch(Exception $e){
	    	// $this->redirect($this->getView()->getUrl('grid', 'customer'));
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
			
			$addressModel = Ccc::getModel('Customer');
			$delete = $addressModel->delete($id); 
	
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
				$this->redirect($this->getView()->getUrl('grid', 'customer'));	
				
		} catch (Exception $e) {
			// $this->redirect($this->getView()->getUrl('grid', 'customer'));	
			echo $e->getMessage();
		}

	}

	public function errorAction()
	{
		echo "Error...";
	}

}

?>