<?php require_once 'Adapter.php'; ?>


<?php 

class Categories{

	public function gridAction(){

		require_once 'categories_grid.php';
	}

	public function addAction(){

		require_once 'categories_add.php';
	}

	public function saveAction()
	{	
		try{

			$adapter = new Adapter();
				
			$h_id = $_POST["hiddenId"];	
			$name = $_POST['category']['name'];
			$status = $_POST['category']['status'];	
				$date = date('Y-m-d H:i:s');
				

			if ($h_id){

				$update = $adapter->update("UPDATE categories SET name='$name', status='$status',updatedDate='$date' WHERE categoryId=$h_id");
				
				if (!$update) {
					throw new Exception("System can't update", 1);
				}
				
			}else{
				
		       	$insert = $adapter->insert("INSERT INTO `categories`(`name`, `status`, `createdDate`) VALUES ('$name','$status','$date')");
				
				if (!$insert){
		         	throw new Exception("System can't insert", 1);
		        	
		        }
				
			}

			$this->redirect("categories.php?a=gridAction"); 

		}catch(Exception $e){
	    	$this->redirect("categories.php?a=gridAction");
	    	// echo $e->getMessage();
	    }    
	}

	public function editAction()
	{
		require_once 'categories_edit.php';
	}

	public function deleteAction()
	{

		try{

			if (!isset($_GET['id'])) {
				throw new Exception("Invalid Request.", 1);
			}
			
			$adapter = new Adapter();
			
			$id=$_GET['id'];

			$delete = $adapter->delete("delete from categories where categoryId=$id");
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}

			$this->redirect("categories.php?a=gridAction");
		
		}catch (Exception $e) {
			$this->redirect('categories.php?a=gridAction');	
			//echo $e->getMessage();
		}
		

	}

	public function errorAction(){

		echo "Error Ocurred!!";	
	}

	public function redirect($url)
	{
		header("Location: $url");
		exit();
	}

	
	// public function CurrentDate()
	// {
	// 	date_default_timezone_set("Asia/Kolkata");
	// 	$date = date('Y-m-d H:i:s');
	// 	return $date;
	// }


}

$action=($_GET['a'] )? $_GET['a'] : 'errorAction';

$categories = new Categories();
$categories->$action();

?>