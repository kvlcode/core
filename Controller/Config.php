<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Config extends Controller_Core_Action{

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
		$configGrid = Ccc::getBlock('Config_Index');
		$content->addChild($configGrid);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $configGrid
		];
		$this->renderJson($response);
	}

	public function editAction()
	{
		try 
		{	
			if ((int)$this->getRequest()->getRequest('id'))
			{
				$this->setTitle('Config Edit');
				$id = (int)$this->getRequest()->getRequest('id');
				$config = Ccc::getModel('Config')->load($id);
				
				if (!$config) 
				{
					throw new Exception("Unable to Load Data", 1);	
				}
			}
			else
			{	
				$this->setTitle('Config Add');
				$config = Ccc::getModel('Config');
			}	
			Ccc::register('config', $config);
			$configEdit = Ccc::getBlock('Config_Edit')->toHtml();
			$response = [
			'status' => 'success',
			'content' => $configEdit
			];
			$this->renderJson($response);
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->message(), Model_Core_Message::ERROR);	
			$this->redirectPage();
		}
	}

	public function saveAction()
	{
		try
		{
			$configData = $this->getRequest()->getPost('config');
			if (!$configData) 
			{
				throw new Exception("Missing config data in request.", 1);	
			}

			$configModel = Ccc::getModel('Config');
			$configModel->setData($configData);
			$configId = (int)$this->getRequest()->getRequest('id');
			if ($configId) 
			{
				$configModel->configId = $configId;
				$configModel->updatedDate = date('Y-m-d H:i:s');

			}
			else
			{
				$configModel->createdDate = date('Y-m-d H:i:s');
			}

			$saveId = $configModel->save();
			if (!$saveId) 
			{
		        throw new Exception("System can't saved config data.", 1);	
		    }
		    $this->getMessage()->addMessage("Data saved successfully.", Model_Core_Message::SUCCESS);
			$this->redirectPage();				
		}
		catch(Exception $e)
		{	
			$this->getMessage()->addMessage($e->message(), Model_Core_Message::ERROR);	
			$this->redirectPage();		
	    }			
	}

	public function deleteAction()
	{
		$id = $this->getRequest()->getRequest('id');
		try
		{
			if (!$id)
			{
				throw new Exception("Invalid Request.", 1);
			}

			$configModel = Ccc::getModel('Config_Resource');
			$delete = $configModel->delete($id);
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);							
			}
			$this->getMessage()->addMessage("Data Deleted.");
			$this->redirectPage();
		}
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->message(), Model_Core_Message::ERROR);	
			$this->redirectPage();
		}	
	}
	
	public function redirectPage()
	{
		$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
 		$response = [
		'status' => 'success',
		'content' => $configGrid,
		'message' => $message
		];
		$this->renderJson($response);	
	}
}