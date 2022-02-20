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

			$productTable = Ccc::getModel('Product');
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
 
			$productTable = Ccc::getModel('Product');
			$product = $this->getRequest()->getPost('product');

			if (!isset($product)) {
				throw new Exception("Missing product data in request.", 1);
				
			}
			if (array_key_exists('hiddenId', $product)) {

				if (!(int)$product['hiddenId']) {
					throw new Exception("Invalid request", 1);
					
				}

				$hiddenId = $product['hiddenId'];
				unset($product['hiddenId']);
				$product['updatedDate'] = date('Y-m-d H:i:s');
				$update = $productTable->update($product, ['productId' => $hiddenId]);

			  	if (!$update) {
					throw new Exception("System can't update", 1);
				
				}
					 
				$date = date('Y-m-d H:i:s');	
			
			}else{
				
				$product['createdDate'] = date('Y-m-d H:i:s');
				$insertId =$productTable->insert($product);

				 	if (!$insertId) {
			         	throw new Exception("System can't insert", 1);	
			        }

			}	
			$this->redirect($this->getUrl('product','grid')); 				
		
		}catch(Exception $e){
	    	$this->redirect($this->getUrl('product','grid'));
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

			$productTable = Ccc::getModel('Product');
			$delete = $productTable->delete(['productId' => $id]);
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect($this->getUrl('product','grid')); 

		}catch (Exception $e) {

			$this->redirect($this->getUrl('product','grid'));	
			//echo $e->getMessage();
		}
		
	}

	public function errorAction()
	{
			echo "Error.";
	}

}

?>