<?php date_default_timezone_set("Asia/Kolkata");?>

<?php 

class Controller_Customer{

	public function gridAction()
	{
		require_once 'view\customer_grid.php';
	}

	public function editAction()
	{
		require_once 'view\customer_edit.php';
	}

	public function addAction()
	{
		require_once 'view\customer_add.php';
	}

	public function saveCustomer()
	{	
		global $adapter; 
		if (!isset($_POST['customer'])) {
			throw new Exception("Missing Customer data in request.", 1);
		}

		$personalInfo = $_POST['customer'];
		$firstName = $personalInfo['firstName'];
		$lastName = $personalInfo['lastName'];
		$email = $personalInfo['email'];
		$mobile = $personalInfo['mobile'];
		$status = $personalInfo['status'];
		$date = date('Y-m-d H:i:s');

		if (array_key_exists('hiddenId', $personalInfo)) {
			if (!(int)$personalInfo['hiddenId']) {
				throw new Exception("Invalid Request", 1);
				
			}

			$customerId = $personalInfo['hiddenId'];
		
			$update = $adapter->update("UPDATE customer 
										SET firstName ='$firstName',
								 			lastName ='$lastName', 
								 			email ='$email', 
								 			mobile ='$mobile', 
								 			status ='$status',
								 			updatedDate ='$date'
							 			WHERE
							 				customerId = '$customerId'");

			if (!$update) {
					throw new Exception("System can't update", 1);
				}	
				

		}else{
			$customerId = $adapter->insert("INSERT INTO 
											customer(`firstName`,`lastName`,`email`,`mobile`,`status`,`createdDate`)
											VALUES('$firstName','$lastName','$email','$mobile','$status','$date')");

				if (!$customerId) {
		         	throw new Exception("System can't insert", 1);
		        	
		        }
		        
		}
		return $customerId;
	}

	public function saveAddress($customerId)
	{
		global $adapter; 

		if(!isset($_POST['address'])){
			throw new Exception("Missing Address data in Request ", 1);	
		}
	
		$addressInfo = $_POST['address'];
		$address = $addressInfo['address'];
		$postalCode = $addressInfo['postalCode'];
		$city = $addressInfo['city'];
		$state = $addressInfo['state'];
		$country = $addressInfo['country'];
		$billing = 0;
		if(array_key_exists('billing',$addressInfo) && $addressInfo["billing"] == 1){
			$billing = 1;
		}
		$shipping = 0;
		if(array_key_exists('shipping',$addressInfo) && $addressInfo["shipping"] == 1){
			$shipping = 1;
		}

		$addressData = $adapter->fetchAll("SELECT * FROM address WHERE customerId = $customerId");	
	
		if ($addressData) {
			
			$update = $adapter->update("UPDATE address 
										SET address='$address',
									    postalCode='$postalCode',
									    city='$city',
									    state='$state',
									    country='$country',
									    billing='$billing',
									    shipping='$shipping'
									WHERE customerId = $customerId");
		
				if (!$update) {
					throw new Exception("System can't update", 1);
				}	

		}else{

			$insertAddress = $adapter->insert("INSERT INTO 
		        									address(`customerId`, `address`, `postalCode`, `city`, `state`, `country`,`billing`,`shipping`) VALUES('$customerId','$address','$postalCode','$city','$state','$country','$billing','$shipping')");


			if (!$insertAddress) {
		         	throw new Exception("System can't insert", 1);
		        	
		    }
		}

	}

	public function saveAction()
	{
		try{
			
			$customerId = $this->saveCustomer();
			$this->saveAddress($customerId);
			$this->redirect("index.php?a=grid&c=customer");

	    }catch(Exception $e){
	    	$this->redirect("index.php?a=grid&c=customer");
	    	echo $e->getMessage();

	    }
	}    	

	public function deleteAction()
	{
		
		try {
			
			if (!isset($_GET['id'])) {
				throw new Exception("Invalid Request.", 1);
			}
			
			global $adapter; 

			$id=$_GET['id'];
			$delete = $adapter->delete("DELETE FROM customer WHERE customerId = $id"); 
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect('index.php?a=grid&c=customer');	
				
		} catch (Exception $e) {
			$this->redirect('index.php?a=grid&c=customer');	
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