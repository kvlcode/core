<?php date_default_timezone_set("Asia/Kolkata");?>
<?php 

class Controller_Categories{

	public function gridAction(){

		require_once 'view\categories_grid.php';
	}

	public function addAction(){

		require_once 'view\categories_add.php';
	}

	public function saveAction()
	{	
		try{

			global $adapter; 
			$category = $_POST['category'];
			$hiddenId = $category['hiddenId'];	
			$name = $category['name'];
			$status = $category['status'];	
			$date = date('Y-m-d H:i:s');
				

			if ($hiddenId){

				$update = $adapter->update("UPDATE categories SET name='$name', status='$status',updatedDate='$date' WHERE categoryId=$hiddenId");
				
				if (!$update) {
					throw new Exception("System can't update", 1);
				}
				
			}else{
				
		       	$insert = $adapter->insert("INSERT INTO `categories`(`name`, `status`, `createdDate`) VALUES ('$name','$status','$date')");
				
				if (!$insert){
		         	throw new Exception("System can't insert", 1);
		        	
		        }
				
			}

			$this->redirect("index.php?a=grid&c=categories"); 

		}catch(Exception $e){
	    	$this->redirect("index.php?a=grid&c=categories");
	    	// echo $e->getMessage();
	    }    
	}

	public function editAction()
	{
		require_once 'view\categories_edit.php';
	}

	public function deleteAction()
	{

		try{

			if (!isset($_GET['id'])) {
				throw new Exception("Invalid Request.", 1);
			}
			
			global $adapter; 
			
			$id=$_GET['id'];

			$delete = $adapter->delete("DELETE FROM categories WHERE categoryId=$id");
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}

			$this->redirect("index.php?a=grid&c=categories");
		
		}catch (Exception $e) {
			$this->redirect("index.php?a=grid&c=categories");	
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


	public function testAction()
	{
		global $adapter;
		$row=$_POST['category'];
		$parentName = $row['parentName'];
		$name= $row['name'];
		$status=$row['status'];
		$date=date('y-m-d h:m:s');
		$query="INSERT INTO `categories` ( `name`, `status`, `createdDate`,`path`) VALUES ( '$name' , '$status', '$date' , '$parentName')";
		$insert=$adapter->insert($query);
		$path = $adapter->fetchRow("SELECT * FROM `categories` WHERE `name` = '$parentName' ");
					//print_r($path);
					//print_r($insert);
					//$parentId = $path->fetch_array(MYSQLI_ASSOC);
					$parentPath = $path['path']."/".$insert;
					//print_r($parentPath);
				
					//exit();
					$newPath = $adapter->update(" UPDATE `categories` SET `path` = '$parentPath' WHERE `categoryId` = '$insert' ");
		// var_dump($update);
	
		//$result = $adapter->fetchPairs($fetchResult);
		$adapter->redirect('index.php?a=grid&c=categories');
	}

}

?>