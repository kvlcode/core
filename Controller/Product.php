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
					throw new Exception("Unable to Load", 1);	
				}
			}
			else
			{
				$product = Ccc::getModel('Product');
			}	
			$productEdit = Ccc::getBlock('Product_Edit')->setData(['productEdit' => $product]);
			$content = $this->getLayout()->getContent();
			$content->addChild($productEdit);
			$this->getLayout()->getChild('content')->getChild('Block_Product_Edit');
			$this->renderLayout();
		} 
		catch (Exception $e) {

			echo $e->getMessage();
			
		}
	}

	public function saveAction()
	{

		try{
 
			$productData = $this->getRequest()->getPost('product');

			if (!isset($productData)) {
				throw new Exception("Missing product data in request.", 1);
				
			}
			$productModel = Ccc::getModel('Product');
			$productModel->setData($productData);

			if (!empty($productData['productId'])) {

				if (!(int)$productData['productId']) {
					throw new Exception("Invalid request", 1);
					
				}

				$productModel->updatedDate = date('Y-m-d H:i:s');
				$update = $productModel->save();

			  	if (!$update) {
					throw new Exception("System can't update", 1);
				
				}	
			
			}else{
				
				unset($productModel->productId);
				$productModel->createdDate = date('Y-m-d H:i:s');
				$insertId = $productModel->save();

				if (!$insertId) {
			         	throw new Exception("System can't insert", 1);	
			    }

			}	
			$this->redirect($this->getView()->getUrl(null, null, null, true)); 				
		
		}catch(Exception $e){
	    	echo $e->getMessage();
	    }			

	}

	public function deleteAction()
	{

		$id = $this->getRequest()->getRequest('id');

		try{
			if (!isset($id)){
				throw new Exception("Invalid Request", 1);
			}

			$productModel = Ccc::getModel('Product_Resource');
			$delete = $productModel->delete($id);
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect($this->getView()->getUrl(null, null, null, true)); 

		}catch (Exception $e) {
			
			echo $e->getMessage();
		}
		
	}

	public function errorAction()
	{
			echo "Error.";
	}

}

?>