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
		
			$adminTable =  Ccc::getModel('Admin');
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
		$adminTable = Ccc::getModel('Admin');
		$adminInfo = $this->getRequest()->getPost('admin');

		if (!isset($adminInfo)) {
			throw new Exception("Missing Admin data in request.", 1);
		}


		if (array_key_exists('hiddenId', $adminInfo)) {
			if (!(int)$adminInfo['hiddenId']) {
				throw new Exception("Invalid Request", 1);
				
			}

			$hiddenId = $adminInfo['hiddenId'];
			unset($adminInfo['hiddenId']);
			$adminInfo['updatedDate'] = date('Y-m-d H:i:s');
			$update = $adminTable->update($adminInfo, ['adminId' => $hiddenId]);

			if (!$update) {
					throw new Exception("System can't update", 1);
			}	
				

		}else{

			$adminInfo['createdDate'] = date('Y-m-d H:i:s');
			$insertId = $adminTable->insert($adminInfo);

			if (!$insertId) {
		       	throw new Exception("System can't insert", 1);
		        	
		    }
		        
		}
		$this->redirect($this->getUrl('admin','grid'));
	
	}
	
	public function deleteAction()
	{
		
		try {

			$id = $this->getRequest()->getRequest('id');
			
			if (!isset($id)) {
				throw new Exception("Invalid Request.", 1);
			}

			$adminTable = Ccc::getModel('Admin');
			$delete = $adminTable->delete(['adminId'=> $id]);
			
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect($this->getUrl('admin','grid'));	
				
		} catch (Exception $e) {
			$this->redirect($this->getUrl('admin','grid'));	
			//echo $e->getMessage();
		}

	}

	public function errorAction()
	{
		echo "Error...";
	}
}

?>