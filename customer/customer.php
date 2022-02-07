<?php require_once('Adapter.php'); 

	date_default_timezone_set("Asia/Kolkata");

?>

<?php 

class Customer{


	public function gridAction()
	{
		require_once('customer_grid.php');
	}

	public function saveAction()
	{
		try{

			$adapter = new Adapter();

			// $hiddenId = NULL;
    		$hiddenId = $_POST["hiddenId"];

			$firstName=$_POST['customer']['firstName'];
			$lastName=$_POST['customer']['lastName'];
			$email=$_POST['customer']['email'];
			$mobile=$_POST['customer']['mobile'];
			$status=$_POST['customer']['status'];
			$date = date('Y-m-d H:i:s');

			//Address
			$address = $_POST['address']['address'];
			$postalCode = $_POST['address']['postalCode'];
			$city = $_POST['address']['city'];
			$state = $_POST['address']['state'];
			$country = $_POST['address']['country'];
			$billing = $_POST['address']['billing'];
			$shipping = $_POST['address']['shipping'];
	
			if ($hiddenId) {
						
				$update = $adapter->update("UPDATE customer c
													INNER JOIN  
													address a
													ON c.customerId = a.customerId
													SET c.firstName ='$firstName',
						 							 	c.lastName ='$lastName', 
						 							 	c.email ='$email', 
						 							 	c.mobile ='$mobile', 
						 							 	c.status ='$status',
						 							 	c.updatedDate ='$date', 
						 							 	a.address ='$address',
						 							 	a.postalCode ='$postalCode',
						 							 	a.city ='$city',
						 							 	a.state ='$state',
						 							 	a.country ='$country',
						 							 	a.billing = '$billing',
						 							 	a.shipping = '$shipping'
												
					 							 	WHERE
					 							 	  c.customerId = '$hiddenId'");

				
				if (!$update) {
					throw new Exception("System can't update", 1);
				}			
			
			}else{

		        $insertCustomer = $adapter->insert("INSERT INTO customer(`firstName`, `lastName`, `email`, `mobile`,`status`, `createdDate`) VALUES('$firstName','$lastName','$email','$mobile','$status','$date')");


		        if (!$insertCustomer) {
		         	throw new Exception("System can't insert", 1);
		        	
		        }

		        $insertAddress = $adapter->insert("INSERT INTO 
		        									address(`customerId`, `address`, `postalCode`, `city`, `state`, `country`,`billing`,`shipping`) VALUES('$insertCustomer','$address','$postalCode','$city','$state','$country','$billing','$shipping')");

	    	}
		    	$this->redirect("customer.php?a=gridAction");
	    
	    }catch(Exception $e){
	    	$this->redirect("customer.php?a=gridAction");
	    	echo $e->getMessage();

	    }
	}    	
	
	public function editAction()
	{
		require_once('customer_edit.php');
	}

	public function addAction()
	{
		require_once('customer_add.php');
	}

	public function deleteAction()
	{
		
		try {
			
			if (!isset($_GET['id'])) {
				throw new Exception("Invalid Request.", 1);
			}
			
			$adapter=new Adapter();

			$id=$_GET['id'];
			$delete = $adapter->delete("DELETE FROM customer WHERE customerId = $id"); 
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect('customer.php?a=gridAction');	
				
		} catch (Exception $e) {
			$this->redirect('customer.php?a=gridAction');	
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

// print_r($_GET);

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction' ;

$customer = new Customer();

$customer->$action();


?>