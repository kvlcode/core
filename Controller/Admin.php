<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
class Controller_Admin extends Controller_Core_Action{

	// public function testAction()
	// {
	// 	$adminTable = new Model_Core_Table();
	// 	$adminTable->setTable('admin');
	// 	$adminTable->setPrimaryKey('adminId');
	// 	$adminTable->insert([]);

	// 	$adminTable->update([], 'adminId'=>5);
	// 	$adminTable->delete(['adminId'=> 2]); // array of Id

	// 	$adminTable->fetchRow($query);
	// 	$adminTable->fetchAll($query);
		
	// 	$admin = $adminTable->createRow();
	// 	$admin->set('firstName', 'Raj');
	// 	$admin->set('lastName', 'Patel');
	// 	$admin->set('email', 'raj@gmail.com');
	// 	$admin->set('password', 'Raj');
	// 	$admin->save();


	// }


	public function gridAction()
	{
		global $adapter;
		$admin = $adapter->fetchAll("SELECT * FROM admin");
		$view = $this->getView();
		$view->setTemplate('view/admin_grid.php');
		$view->addData('adminGrid', $admin);
		$view->toHtml();
	}

	public function editAction()
	{	
		$request = new Model_Core_Request();
		$id = $request->getRequest('id');
		global $adapter;
		$row = $adapter->fetchRow("SELECT *
			                            FROM admin
			                            WHERE adminId = $id");
		$view = $this->getView();
		$view->setTemplate('view/admin_edit.php');
		$view->addData('adminEdit', $row);
		$view->toHtml();
	}

	public function addAction()
	{
		$view =$this->getView();
		$view->setTemplate('view/admin_add.php');
		$view->toHtml();
		
	}

	public function saveAction()
	{	

		$request = new Model_Core_Request();
		$adminInfo = $request->getPost('admin');
		if (!isset($adminInfo)) {
			throw new Exception("Missing Admin data in request.", 1);
		}
		global $adapter; 
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

			$request = new Model_Core_Request();
			$id = $request->getRequest('id');
			
			if (!isset($id)) {
				throw new Exception("Invalid Request.", 1);
			}

			global $adapter; 
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
}

?>