<?php date_default_timezone_set("Asia/Kolkata");?>

<?php 

class Controller_Product{

	public function gridAction()			
	{
		require_once 'view\product_grid.php';
	}

	public function addAction()
	{
		require_once 'view\product_add.php';
	}

	public function editAction()
	{
		require 'view\product_edit.php';
	}

	public function saveAction()
	{

		try{

		    global $adapter; 
			
			$product = $_POST['product'];
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
		
		try{

			if (!isset($_GET['id'])){
				throw new Exception("Invalid Request", 1);
				
			}


			global $adapter; 
			
			$id = $_GET["id"];

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
	public function redirect($url)
	{
		header("Location: $url");
		exit();
	}

}

?>