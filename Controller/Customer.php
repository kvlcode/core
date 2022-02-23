<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Customer extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Customer_Grid')->toHtml();
	}

	public function addAction()
	{	
		Ccc::getBlock('Customer_Add')->toHtml();
	}

	public function editAction()
	{	

		try {
			
			$id = (int) $this->getRequest()->getRequest('id');
			if (!$id) {
				throw new Exception("Invalid Id", 1);
				
			}
		
			$customerTable =  Ccc::getModel('Customer');
			$row = $customerTable->fetchRow("SELECT c.*,a.*
						                        FROM customer c
						                        JOIN address a
						                        ON a.customerId = c.customerId
						                        WHERE c.customerId = {$id}");	
			
			if (!$row) {
				throw new Exception("Unable to Load", 1);	
			}
			
			Ccc::getBlock('Customer_Edit')->addData('customerEdit', $row)->toHtml();	

		} 
		catch (Exception $e) {
			echo $e->getMessage();
		}

	}

	public function saveCustomer()
	{	
		 
			$customerTable = Ccc::getModel('Customer');
			$customerInfo = $this->getRequest()->getPost('customer');
			if (!isset($customerInfo)) {
				throw new Exception("Missing Customer data in request.", 1);
			}
			

			if (array_key_exists('hiddenId', $customerInfo)) {
				if (!(int)$customerInfo['hiddenId']) {
					throw new Exception("Invalid Request", 1);
					
				}

				$customerId = $customerInfo['hiddenId'];

				unset($customerInfo['hiddenId']);
				$customerInfo['updatedDate'] = date('Y-m-d H:i:s');
				$updateId = $customerTable->update($customerInfo, $customerId);

				if (!$updateId) {
						throw new Exception("System can't update customer data", 1);
					}	
					
			}else{

				$customerInfo['createdDate'] = date('Y-m-d H:i:s');
				$customerId = $customerTable->insert($customerInfo);
				
					if (!$customerId) {
			         	throw new Exception("System can't insert customer data", 1);
			        	
			        }
			        		
			}

			return $customerId;
	}

	public function saveAddress($customerId)
	{	
		$addressTable = Ccc::getModel('Customer_Address');
		$addressData = $this->getRequest()->getPost('address');
		
		if(!isset($addressData)){
			throw new Exception("Missing Address data in Request ", 1);	
		}
		
		$billing = 0;
		if(array_key_exists('billing',$addressData) && $addressData["billing"] == 1){
			$billing = 1;
		}
		$shipping = 0;
		if(array_key_exists('shipping',$addressData) && $addressData["shipping"] == 1){
			$shipping = 1;
		}
		$addressData["billing"] = $billing;
		$addressData["shipping"] = $shipping;

		$addressInfo = $addressTable->fetchAll("SELECT * FROM address WHERE customerId = $customerId");	
	
		if ($addressInfo) {

			$addressData['customerId'] = $customerId;
			$update = $addressTable->update($addressData, $customerId);
		
				if (!$update) {
					throw new Exception("System can't update address", 1);
				}	

		}else{

			$addressData['customerId'] = $customerId;
			$insertId = $addressTable->insert($addressData);

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
			$this->redirect($this->getView()->getUrl('customer','grid'));

	    }catch(Exception $e){
	    	$this->redirect($this->getView()->getUrl('customer','grid'));
	    	// echo $e->getMessage();

	    }
	}    	

	public function deleteAction()
	{
		
		try {
	
			
			$id = $this->getRequest()->getRequest('id');
			if (!isset($id)) {
				throw new Exception("Invalid Request.", 1);
			}
			
			$addressTable = Ccc::getModel('Customer_Address');
			$delete = $addressTable->delete($id); 
	
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect($this->getView()->getUrl('customer','grid'));	
				
		} catch (Exception $e) {
			$this->redirect($this->getView()->getUrl('customer','grid'));	
			//echo $e->getMessage();
		}

	}

	public function errorAction()
	{
		echo "Error...";
	}

}

?>