<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Product extends Controller_Core_Action{

	public function gridAction()			
	{	
		$productGrid = Ccc::getBlock('Product_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($productGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Product_Grid');
		$this->renderLayout();		
	}

	public function editAction()
	{
		try {

			if ((int) $this->getRequest()->getRequest('id')) {
			
				$id = (int) $this->getRequest()->getRequest('id');
				$product = Ccc::getModel('Product')->load($id);

				if (!$product) {
					$this->getMessage()->addMessage("Unable to Load.", Model_Core_Message::ERROR);	
					throw new Exception("Unable to Load", 1);	
				}
			}
			else
			{
				$product = Ccc::getModel('Product');
			}	
			$productEdit = Ccc::getBlock('Product_Edit')->setProduct($product);
			$content = $this->getLayout()->getContent();
			$content->addChild($productEdit);
			$this->getLayout()->getChild('content')->getChild('Block_Product_Edit');
			$this->renderLayout();
		} 
		catch (Exception $e) {

			$this->redirect($this->getView()->getUrl(null, null, null, true)); 
			
		}
	}

	public function saveAction()
	{

		try{
 
			$productData = $this->getRequest()->getPost('product');
			$categoryData = $this->getRequest()->getPost('category');

			if (!$productData) {
				$this->getMessage()->addMessage("Missing product data in request.", Model_Core_Message::ERROR);	
				throw new Exception("Missing product data in request.", 1);	
			}
			
			$productModel = Ccc::getModel('Product');
			$productModel->setData($productData);
			$categoryProduct = Ccc::getModel('Category_Product');

			if (!(int)$this->getRequest()->getRequest('id')) 
			{
				$productId = $this->getRequest()->getRequest('id');
				$productModel->updatedDate = date('Y-m-d H:i:s');
				$update = $productModel->save();

				global $adapter; 
				$adapter->delete("DELETE FROM `category_product` WHERE `productId` = {$productId}");

				$categoryProduct->productId = $productId;
				foreach ($categoryData['categoryId'] as $key => $id) {
					$categoryProduct->categoryId = $id;
					$categoryProduct->save();
				}

			  	if (!$update) {
					$this->getMessage()->addMessage("System can't update.", Model_Core_Message::ERROR);	
					throw new Exception("System can't update.", 1);
				}
				$this->getMessage()->addMessage('Data Updated.', Model_Core_Message::SUCCESS);	
			
			}else{
				
				unset($productModel->productId);
				$productModel->createdDate = date('Y-m-d H:i:s');
				$insertId = $productModel->save();

				$categoryProduct->productId = $insertId;
				foreach ($categoryData['categoryId'] as $key => $id) {
					$categoryProduct->categoryId = $id;
					$categoryProduct->save();
				}

				if (!$insertId) {
					$this->getMessage()->addMessage("System can't insert.", Model_Core_Message::ERROR);	
			        throw new Exception("System can't insert.", 1);	
			    }
			    $this->getMessage()->addMessage('Data Inserted.', Model_Core_Message::SUCCESS);
			}	
			$this->redirect($this->getView()->getUrl(null, null, null, true)); 				
		
		}catch(Exception $e){
	    	$this->redirect($this->getView()->getUrl(null, null, null, true)); 
	    }			

	}

	public function deleteAction()
	{

		$id = $this->getRequest()->getRequest('id');

		try{
			if (!isset($id)){
				$this->getMessage()->addMessage("Invalid Request.", Model_Core_Message::ERROR);	
				throw new Exception("Invalid Request.", 1);
			}

			$productModel = Ccc::getModel('Product_Resource');
			$delete = $productModel->delete($id);
			if(!$delete)
			{	
				$this->getMessage()->addMessage("System can't delete record.", Model_Core_Message::ERROR);	
				throw new Exception("System can't delete record.", 1);
			}
			$this->getMessage()->addMessage('Data Deleted.', Model_Core_Message::SUCCESS);
			$this->redirect($this->getView()->getUrl(null, null, null, true)); 

		}catch (Exception $e) {

			$this->redirect($this->getView()->getUrl(null, null, null, true)); 
		}
		
	}

	public function errorAction()
	{
			echo "Error.";
	}

}

?>