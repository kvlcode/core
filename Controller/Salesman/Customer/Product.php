<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman_Customer_Product extends Controller_Core_Action{

	public function gridAction()			
	{	
		$productGrid = Ccc::getBlock('Salesman_Customer_Product_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($productGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Salesman_Customer_Product_Grid');
		$this->renderLayout();		
	}

	public function saveAction()
	{
		try {
			
			echo "<pre>";
			$product = $this->getRequest()->getPost('product');			
			$customerId = $this->getRequest()->getRequest('id');

			foreach ($product as $key => $value) {				
				$customerPrice = Ccc::getModel('Customer_Price');	
				if($key == 'new'){
					foreach ($value as $productId => $price) {
						if ($price){
						 	$customerPrice->customerId = $customerId;
							$customerPrice->productId = $productId;
							$customerPrice->price = $price;
							$save = $customerPrice->save();
						} 
					}	
				}
				else{
					
					foreach ($value as $entityId => $price) {
						$customerPrice->price = $price;
						$customerPrice->entityId = $entityId;
						$save = $customerPrice->save(); 
					}	
				}	

			}

			if (!$save) {
				$this->getMessage()->addMessage("System can't save.", Model_Core_Message::ERROR);	
				throw new Exception("System can't save.", 1);
			}
			$this->getMessage()->addMessage('Data Saved.', Model_Core_Message::SUCCESS);
			$this->redirect($this->getView()->getUrl(null, null, ['id' => $customerId], true));

		} catch (Exception $e) {
			$this->redirect($this->getView()->getUrl(null, null, ['id' => $customerId], true));
								
		}
	}

	
}