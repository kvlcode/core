<?php 
		require_once('Adapter.php'); 
		date_default_timezone_set("Asia/Kolkata");
?>

<?php 

class Product{

	public function gridAction()			
	{
		require_once 'product_grid.php';
	}

	public function addAction()
	{
		require_once 'product_add.php';
	}

	public function editAction()
	{
		require 'product_edit.php';
	}

	public function saveAction()
	{

		try{

		    $adapter = new Adapter();
				
			$hid=$_POST['hiddenId'];
			$name=$_POST['product']['name'];
			$price=$_POST['product']['price'];
			$quantity=$_POST['product']['quantity'];
			$status=$_POST['product']['status'];		 
			$date = date('Y-m-d H:i:s');

			if($hid){
			  		
			  	$update = $adapter->update("UPDATE product 
									SET name='$name',
								 		price='$price',
								 		quantity='$quantity',
								 		status='$status',
								 		updatedDate='$date' 
				 					WHERE productId='$hid'");
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

			$this->redirect("product.php?a=gridAction"); 				
		}catch(Exception $e){
	    	$this->redirect("product.php?a=gridAction");
	    	// echo $e->getMessage();

	    }

			

	}

	public function deleteAction()
	{
		
		try{

			if (!isset($_GET['id'])){
				throw new Exception("Invalid Request", 1);
				
			}


			$adapter=new Adapter();
			
			$id = $_GET["id"];

			$delete = $adapter->delete("DELETE FROM product WHERE productId = $id ");

			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect("product.php?a=gridAction"); 

		}catch (Exception $e) {

			$this->redirect('product.php?a=gridAction');	
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

$action=($_GET['a'] )? $_GET['a'] : 'errorAction';

$product = new Product();
$product->$action();

?>