<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Product extends Controller_Core_Action{

	public function gridAction()			
	{	
		global $adapter;
		$product = $adapter->fetchAll('SELECT * FROM product');
		$view = $this->getView();
		$view->setTemplate('view/product_grid.php');
		$view->addData('productGrid', $product);
		$view->toHtml();
		
	}

	public function addAction()
	{
		$view = $this->getView();
		$view->setTemplate('view/product_add.php');
		$view->toHtml();
	
	}

	public function editAction()
	{
		global $adapter;
		global $ccc;
		$id = $ccc->getFront()->getRequest()->getRequest('id');
		$row = $adapter->fetchRow("SELECT * FROM product WHERE productId = '$id'");

		$view = $this->getView();
		$view->setTemplate('view/product_edit.php');
		$view->addData('productEdit',$row);
		$view->toHtml();
	}

	public function saveAction()
	{

		try{

		    global $adapter; 
			global $ccc;
			$product = $ccc->getFront()->getRequest()->getPost('product');
			$hiddenId = $product['hiddenId'];
			$name = $product['name'];
			$price = $product['price'];
			$quantity = $product['quantity'];
			$status = $product['status'];		 
			$date = date('Y-m-d H:i:s');

			if($hiddenId){
			  		
			  	$update = $adapter->update("UPDATE product 
									SET name='$name',
								 		price='$price',
								 		quantity='$quantity',
								 		status='$status',
								 		updatedDate='$date' 
				 					WHERE productId='$hiddenId'");
			  	if (!$update) {
					throw new Exception("System can't update", 1);
				}	
			
			}else{
				
				$insert = $adapter->insert("INSERT INTO 
				 				product(`name`,
				 						 `price`,
				 						 `quantity`,
				 						 `status`,
				 						 `createdDate`) 
				 				VALUES('$name',
				 						'$price',
				 						'$quantity',
				 						'$status',
				 						'$date')");
				 	if (!$insert) {
			         	throw new Exception("System can't insert", 1);	
			        }

			}	

			$this->redirect("index.php?a=grid&c=product"); 				
		}catch(Exception $e){
	    	$this->redirect("index.php?a=grid&c=product");
	    	// echo $e->getMessage();

	    }			

	}

	public function deleteAction()
	{
		global $ccc;
		$id = $ccc->getFront()->getRequest()->getRequest('id');

		try{

			if (!isset($id)){
				throw new Exception("Invalid Request", 1);
				
			}

			global $adapter; 

			$delete = $adapter->delete("DELETE FROM product WHERE productId = $id ");

			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect("index.php?a=grid&c=product"); 

		}catch (Exception $e) {

			$this->redirect('index.php?a=grid&c=product');	
			//echo $e->getMessage();
			}
		
	}

	public function errorAction()
	{
			echo "Error.";
	}

}

?>