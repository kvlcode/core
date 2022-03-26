<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Admin extends Controller_Core_Action{

	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }

	public function gridAction()
	{
		$this->setTitle('Admin Grid');
		$adminGrid = Ccc::getBlock('Admin_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($adminGrid);
		$this->renderLayout();
	}

	public function editAction()
	{	

		try {
			
			if ((int) $this->getRequest()->getRequest('id')) 
			{
				$this->setTitle('Admin Edit');
				$id = (int) $this->getRequest()->getRequest('id');
				$admin =  Ccc::getModel('Admin')->load($id);	

				if (!$admin) 
				{
					throw new Exception("Unable to Load Data.", 1);	
				}
			}
			else
			{
				$this->setTitle('Admin Add');
				$admin =  Ccc::getModel('Admin');
			}

			$adminEdit = Ccc::getBlock('Admin_Edit')->setAdmin($admin);
			$content = $this->getLayout()->getContent();
			$content->addChild($adminEdit);
			$this->renderLayout();

		} 
		catch (Exception $e) {
			$this->getMessage()->addMessage($e->message(), Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl(null, null, null, true));	
		}		
	}

	public function saveAction()
	{	
		try{
			$adminData = $this->getRequest()->getPost('admin');
			if (!$adminData) {
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
		       	throw new Exception("System can't save admin data", 1);   	
		    }    
			$this->getMessage()->addMessage('Data saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirect($this->getLayout()->getUrl(null, null, null, true));
		}
		catch (Exception $e) {
			$this->getMessage()->addMessage($e->message(), Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl(null, null, null, true));
		}

	}
	
	public function deleteAction()
	{
		
		try {

			$id = $this->getRequest()->getRequest('id');
			if (!$id) {
				throw new Exception("Invalid Request.", 1);
			}

			$adminModel = Ccc::getModel('Admin_Resource');
			$delete = $adminModel->delete($id);
			
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
			}
			$this->getMessage()->addMessage("Data Deleted.");
			$this->redirect($this->getLayout()->getUrl(null, null, null, true));	
		}
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->message(), Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl(null, null, null, true));
		}
	}
}

?>