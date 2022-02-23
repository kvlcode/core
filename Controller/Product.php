<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Product extends Controller_Core_Action{

	public function gridAction()			
	{	
		Ccc::getBlock('Product_Grid')->toHtml();		
	}

	public function addAction()
	{
		Ccc::getBlock('Product_Add')->toHtml();
	}

	public function editAction()
	{
		try {
			
			$id = (int) $this->getRequest()->getRequest('id');
			
			if (!$id) {
				throw new Exception("Invalid Id", 1);	
			}

			$productTable = Ccc::getModel('Product_Resource');
			$row = $productTable->fetchRow("SELECT * FROM product WHERE productId = {$id}");

			if (!$row) {
				throw new Exception("Unable to Load", 1);	
			}
			Ccc::getBlock('Product_Edit')->addData('productEdit', $row)->toHtml();

		} 
		catch (Exception $e) {

			echo $e->getMessage();
			
		}
	}

	public function saveAction()
	{

		try{
 
			$productInfo = $this->getRequest()->getPost('product');

			if (!isset($productInfo)) {
				throw new Exception("Missing product data in request.", 1);
				
			}
			$productModel = Ccc::getModel('Product_Resource');
			$product = $productModel->getRow();
			$date = date('Y-m-d H:i:s');


			if (array_key_exists('productId', $productInfo)) {

				if (!(int)$productInfo['productId']) {
					throw new Exception("Invalid request", 1);
					
				}

				$product = $productModel->load($productInfo['productId']);
				$product->name = $productInfo['name'];
				$product->price = $productInfo['price'];
				$product->quantity = $productInfo['quantity'];
				$product->status = $productInfo['status'];
				$product->updatedDate = $date;
				$update = $product->save();

			  	if (!$update) {
					throw new Exception("System can't update", 1);
				
				}	
			
			}else{
				
				$product->name = $productInfo['name'];
				$product->price = $productInfo['price'];
				$product->quantity = $productInfo['quantity'];
				$product->status = $productInfo['status'];
				$product->createdDate = $date;
				$insertId = $product->save();

				if (!$insertId) {
			         	throw new Exception("System can't insert", 1);	
			    }

			}	
			$this->redirect($this->getView()->getUrl('product','grid')); 				
		
		}catch(Exception $e){
	    	$this->redirect($this->getView()->getUrl('product','grid'));
	    	// echo $e->getMessage();
	    }			

	}

	public function deleteAction()
	{

		$id = $this->getRequest()->getRequest('id');

		try{
			if (!isset($id)){
				throw new Exception("Invalid Request", 1);
			}

			$productTable = Ccc::getModel('Product_Resource');
			$delete = $productTable->delete($id);
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect($this->getView()->getUrl('product','grid')); 

		}catch (Exception $e) {

			$this->redirect($this->getView()->getUrl('product','grid'));	
			//echo $e->getMessage();
		}
		
	}

	public function errorAction()
	{
			echo "Error.";
	}

}

?>