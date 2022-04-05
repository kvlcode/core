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

    public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Index');
		$content->addChild($adminGrid);
		$this->renderLayout();

	}

	public function gridBlockAction()
	{
		$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $adminGrid
		];
		$this->renderJson($response);
	}

	public function editAction()
	{
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
		
		Ccc::register('admin', $admin);
		$adminEdit = Ccc::getBlock('Admin_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $adminEdit
		];
		$this->renderJson($response);
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
			$this->gridBlockAction();
		}
		catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->gridBlockAction();
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
			$this->gridBlockAction();

		}
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->gridBlockAction();
		}
	}
}

?>