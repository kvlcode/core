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


	public function gridAction()
	{
		$this->setTitle('Config Grid');
		$pageGrid = Ccc::getBlock('Config_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($pageGrid);
		$this->renderLayout();
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

			$configEdit = Ccc::getBlock('Config_Edit')->setConfig($config);
			$content = $this->getLayout()->getContent();
			$content->addChild($configEdit);
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->message(), Model_Core_Message::ERROR);	
			$this->redirect($this->getView()->getUrl(null, null, null, true));		
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
			$this->redirect($this->getView()->getUrl(null, null, null, true)); 				
		
		}
		catch(Exception $e)
		{	
			$this->getMessage()->addMessage($e->message(), Model_Core_Message::ERROR);	
	    	$this->redirect($this->getView()->getUrl(null, null, null, true)); 				
	    }			
	}

	public function deleteAction()
	{
		$id = $this->getRequest()->getRequest('id');
		try{
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
			$this->redirect($this->getView()->getUrl(null, null, null, true)); 

		}
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->message(), Model_Core_Message::ERROR);	
			$this->redirect($this->getView()->getUrl(null, null, null, true)); 
		}	
	}
}