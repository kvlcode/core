<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Admin extends Controller_Core_Action{

	// public function __construct()
	// {
	// 	$this->authenticate();
	// }

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
					$this->getMessage()->addMessage("Unable to Load Data.", Model_Admin_Message::ERROR);
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
			$this->redirect($this->getView()->getUrl(null, null, null, true));
			
		}		
	}

	public function saveAction()
	{	
		try{
			$adminData = $this->getRequest()->getPost('admin');
			if (!$adminData) {
				$this->getMessage()->addMessage("Missing Admin data in request.", Model_Core_Message::ERROR);
				throw new Exception("Missing Admin data in request.", 1);
			}

			$adminModel = Ccc::getModel('Admin');
			$adminModel->setData($adminData);
			$adminModel->password = md5($adminModel->password);
			
			if ($this->getRequest()->getRequest('id')) {
				$adminModel->adminId = $this->getRequest()->getRequest('id');
				$adminModel->updatedDate = date('Y-m-d H:i:s');		
			}
			else
			{
				$adminModel->createdDate = date('Y-m-d H:i:s');	
			}

			$saveId = $adminModel->save();
			if (!$saveId)
			{
				$this->getMessage()->addMessage("System can't save admin data.", Model_Core_Message::ERROR);	
		       	throw new Exception("System can't save admin data", 1);   	
		    }    
			$this->getMessage()->addMessage('Data saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect($this->getView()->getUrl(null, null, null, true));
		}
		catch (Exception $e) {

			$this->redirect($this->getView()->getUrl(null, null, null, true));
		}

	}
	
	public function deleteAction()
	{
		
		try {

			$id = $this->getRequest()->getRequest('id');
			if (!$id) {
				$this->getMessage()->addMessage("Invalid Request.", Model_Core_Message::ERROR);	
				throw new Exception("Invalid Request.", 1);
			}

			$adminModel = Ccc::getModel('Admin_Resource');
			$delete = $adminModel->delete($id);
			
			if(!$delete)
			{
				$this->getMessage()->addMessage("System can't delete record.", Model_Admin_Message::ERROR);
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->getMessage()->addMessage("Data Deleted.");
			$this->redirect($this->getView()->getUrl(null, null, null, true));	
				
		}
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl(null, null, null, true));
		}
	}
}

?>