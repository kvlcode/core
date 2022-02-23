<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Admin extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Admin_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Admin_Add')->toHtml();	
	}

	public function editAction()
	{	

		try {
			
			$id = (int) $this->getRequest()->getRequest('id');
			if (!$id) {
				throw new Exception("Invalid Id", 1);
				
			}
		
			$adminTable =  Ccc::getModel('Admin_Resource');
			$row = $adminTable->fetchRow("SELECT * FROM `admin` WHERE adminId = {$id}");	
			
			if (!$row) {
				throw new Exception("Unable to Load", 1);	
			}
			
			Ccc::getBlock('Admin_Edit')->addData('adminEdit', $row)->toHtml();	

		} 
		catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}

	public function saveAction()
	{	
		try{
			$adminInfo = $this->getRequest()->getPost('admin');

			if (!isset($adminInfo)) {
				throw new Exception("Missing Admin data in request.", 1);
			}

			$adminModel = Ccc::getModel('Admin_Resource');
			$admin = $adminModel->getRow();
			$date = date('Y-m-d H:i:s');

			if (array_key_exists('adminId', $adminInfo)) {
				if (!(int)$adminInfo['adminId']) {
					throw new Exception("Invalid Request", 1);
					
				}
				
				$admin = $adminModel->load($adminInfo['adminId']);
				$admin->firstName = $adminInfo['firstName'];
				$admin->lastName = $adminInfo['lastName'];
				$admin->email = $adminInfo['email'];
				$admin->password = $adminInfo['password'];
				$admin->status = $adminInfo['status'];
				$admin->updatedDate = $date;
				// $admin->unset('adminId');
				$update = $admin->save();

				if (!$update) {
						throw new Exception("System can't update", 1);
				}	
					

			}else{

				$admin->firstName = $adminInfo['firstName'];
				$admin->lastName = $adminInfo['lastName'];
				$admin->email = $adminInfo['email'];
				$admin->password = $adminInfo['password'];
				$admin->status = $adminInfo['status'];
				$admin->createdDate = $date;
				$insertId = $admin->save();

				if (!$insertId) {
			       	throw new Exception("System can't insert", 1);
			        	
			    }
			        
			}
			$this->redirect($this->getView()->getUrl('admin','grid'));
		}
		catch (Exception $e) {
			$this->redirect($this->getView()->getUrl('admin','grid'));
		}

	}
	
	public function deleteAction()
	{
		
		try {

			$id = $this->getRequest()->getRequest('id');
			
			if (!isset($id)) {
				throw new Exception("Invalid Request.", 1);
			}

			$adminTable = Ccc::getModel('Admin_Resource');
			$delete = $adminTable->delete($id);
			
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect($this->getView()->getUrl('admin','grid'));	
				
		} catch (Exception $e) {
			$this->redirect($this->getView()->getUrl('admin','grid'));	
			//echo $e->getMessage();
		}

	}

	public function errorAction()
	{
		echo "Error...";
	}
}

?>