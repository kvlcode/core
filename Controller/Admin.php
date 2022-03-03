<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Admin extends Controller_Core_Action{

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Grid');
		$content->addChild($adminGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Admin_Grid');
		$this->renderLayout();

	}

	public function editAction()
	{	

		try {
			
			if ((int) $this->getRequest()->getRequest('id')) 
			{
				$id = (int) $this->getRequest()->getRequest('id');
			
				$admin =  Ccc::getModel('Admin')->load($id);	
				
				if (!$admin) {
					throw new Exception("Unable to Load", 1);	
				}
			}
			else
			{
				$admin =  Ccc::getModel('Admin');
			}

			$adminEdit = Ccc::getBlock('Admin_Edit')->setAdmin($admin);
			$content = $this->getLayout()->getContent();
			$content->addChild($adminEdit);
			$this->getLayout()->getChild('content')->getChild('Block_Admin_Edit');
			$this->renderLayout();

		} 
		catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}

	public function saveAction()
	{	
		try{
			$adminData = $this->getRequest()->getPost('admin');

			if (!isset($adminData)) {
				throw new Exception("Missing Admin data in request.", 1);
			}

			$adminModel = Ccc::getModel('Admin');
			$adminModel->setData($adminData);
			
			if ($adminData['adminId'] != null) {

				if (!(int)$adminData['adminId']) {
					throw new Exception("Invalid Request", 1);	
				}
				
				$adminModel->updatedDate = date('Y-m-d H:i:s');
				$update = $adminModel->save();
			
				if (!$update) {
						throw new Exception("System can't update", 1);
				}	
					

			}else{
				
				unset($adminModel->adminId);
				$adminModel->createdDate = date('Y-m-d H:i:s');
				$insertId = $adminModel->save();
				
				if (!$insertId) {
			       	throw new Exception("System can't insert", 1);
			        	
			    }
			        
			}
			$this->redirect($this->getView()->getUrl(null, null, null, true));
		}
		catch (Exception $e) {

			echo $e->getMessage();
		}

	}
	
	public function deleteAction()
	{
		
		try {

			$id = $this->getRequest()->getRequest('id');
			
			if (!isset($id)) {
				throw new Exception("Invalid Request.", 1);
			}

			$adminModel = Ccc::getModel('Admin_Resource');
			$delete = $adminModel->delete($id);
			
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect($this->getView()->getUrl(null, null, null, true));	
				
		}
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}

	}

	public function errorAction()
	{
		echo "Error...";
	}
}

?>