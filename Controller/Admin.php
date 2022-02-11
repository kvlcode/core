<?php date_default_timezone_set("Asia/Kolkata"); ?>
<?php 

class Controller_Admin{

	public function gridAction()
	{
		require_once 'view\admin_grid.php';
	}

	public function editAction()
	{
		require_once 'view\admin_edit.php';
	}

	public function addAction()
	{
		require_once 'view\admin_add.php';
	}

	public function saveAction()
	{	
		global $adapter; 
		if (!isset($_POST['admin'])) {
			throw new Exception("Missing Admin data in request.", 1);
		}

		$adminInfo = $_POST['admin'];
		$firstName = $adminInfo['firstName'];
		$lastName = $adminInfo['lastName'];
		$email = $adminInfo['email'];
		$password = $adminInfo['password'];
		$status = $adminInfo['status'];
		$date = date('Y-m-d H:i:s');

		if (array_key_exists('hiddenId', $adminInfo)) {
			if (!(int)$adminInfo['hiddenId']) {
				throw new Exception("Invalid Request", 1);
				
			}

			$adminId = $adminInfo['hiddenId'];
		
			$update = $adapter->update("UPDATE admin 
										SET firstName ='$firstName',
								 			lastName ='$lastName', 
								 			email ='$email',
								 			password = '$password',  
								 			status ='$status',
								 			updatedDate ='$date'
							 			WHERE
							 				adminId = '$adminId'");

			if (!$update) {
					throw new Exception("System can't update", 1);
				}	
				

		}else{
			$adminId = $adapter->insert("INSERT INTO 
											admin(`firstName`,`lastName`,`email`,`password`,`status`,`createdDate`)
											VALUES('$firstName','$lastName','$email','$password','$status','$date')");

				if (!$adminId) {
		         	throw new Exception("System can't insert", 1);
		        	
		        }
		        
		}
		$this->redirect('index.php?a=grid&c=admin');
	
	}
	
	public function deleteAction()
	{
		
		try {
			
			if (!isset($_GET['id'])) {
				throw new Exception("Invalid Request.", 1);
			}
			
			global $adapter; 

			$id = $_GET['id'];
			$delete = $adapter->delete("DELETE FROM admin WHERE adminId = $id"); 
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect('index.php?a=grid&c=admin');	
				
		} catch (Exception $e) {
			$this->redirect('index.php?a=grid&c=admin');	
			//echo $e->getMessage();
		}

	}

	public function errorAction()
	{
		echo "Error...";
	}

	public function redirect($url)
	{
			header("Location: $url");
	}


}

?>