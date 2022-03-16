<?php 
Ccc::loadClass('Controller_Core_Action');
class Controller_Customer_Price extends Controller_Core_Action{

	public function gridAction()			
	{	
		$this->setTitle('Customer Price');
		$productGrid = Ccc::getBlock('Customer_Price_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($productGrid);
		$this->renderLayout();		
	}

	public function saveAction()
	{
		try {
			
			$product = $this->getRequest()->getPost('product');			
			$customerId = $this->getRequest()->getRequest('id');
			$salesmanId = $this->getRequest()->getRequest('salesmanId');

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
			$this->redirect($this->getView()->getUrl(null, null, ['id' => $customerId, 'salesmanId' => $salesmanId], true));

		} catch (Exception $e) {
			$this->redirect($this->getView()->getUrl(null, null, ['id' => $customerId, 'salesmanId' => $salesmanId], true));
								
		}
	}

	
}