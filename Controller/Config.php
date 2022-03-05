<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Config extends Controller_Core_Action{

	public function gridAction()
	{
		$pageGrid = Ccc::getBlock('Config_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($pageGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Config_Grid');
		$this->renderLayout();
	}

	public function editAction()
	{
		try {
			
			if ((int) $this->getRequest()->getRequest('id'))
			{
				$id = (int) $this->getRequest()->getRequest('id');
				$config = Ccc::getModel('Config')->load($id);
				
				if (!$config) {
					$this->getMessage()->addMessage("Unable to Load Data.", Model_Core_Message::ERROR);
					throw new Exception("Unable to Load Data", 1);	
				}
			}
			else
			{
				$config = Ccc::getModel('Config');
			}	

			$configEdit = Ccc::getBlock('Config_Edit')->setConfig($config);
			$content = $this->getLayout()->getContent();
			$content->addChild($configEdit);
			$this->getLayout()->getChild('content')->getChild('Block_Config_Edit');
			$this->renderLayout();

		} 
		catch (Exception $e) {
			$this->redirect($this->getView()->getUrl(null, null, null, true));		
		}
	}

	public function saveAction()
	{
		try{
 
			$configData = $this->getRequest()->getPost('config');

			if (!isset($configData)) {
				$this->getMessage()->addMessage("Missing config data in request.", Model_Core_Message::ERROR);
				throw new Exception("Missing config data in request.", 1);	
			}
			$configModel = Ccc::getModel('Config');
			$configModel->setData($configData);

			if (!empty($configData['configId'])) {

				if (!(int)$configData['configId']) {
					$this->getMessage()->addMessage("Invalid request.", Model_Core_Message::ERROR);
					throw new Exception("Invalid request", 1);			
				}

				$update = $configModel->save();

			  	if (!$update) {
					$this->getMessage()->addMessage("System can't update.", Model_Core_Message::ERROR);
					throw new Exception("System can't update.", 1);	
				}
				$this->getMessage()->addMessage("Data Updated.", Model_Core_Message::SUCCESS);	
			
			}
			else
			{
				unset($configModel->configId);
				$configModel->createdDate = date('Y-m-d H:i:s');
				$insertId = $configModel->save();

				if (!$insertId) {
					$this->getMessage()->addMessage("System can't insert.", Model_Core_Message::ERROR); 
			        throw new Exception("System can't insert.", 1);	
			    }
			    $this->getMessage()->addMessage("Data Inserted.", Model_Core_Message::SUCCESS);

			}	
			$this->redirect($this->getView()->getUrl(null, null, null, true)); 				
		
		}
		catch(Exception $e)
		{	
	    	$this->redirect($this->getView()->getUrl(null, null, null, true)); 				
	    }			

	}


	public function deleteAction()
	{

		$id = $this->getRequest()->getRequest('id');

		try{
			if (!isset($id)){
				$this->getMessage()->addMessage("Invalid Request.", Model_Core_Message::ERROR);
				throw new Exception("Invalid Request.", 1);
			}

			$configModel = Ccc::getModel('Config_Resource');
			$delete = $configModel->delete($id);
			if(!$delete)
			{
				$this->getMessage()->addMessage("System can't delete record.", Model_Core_Message::ERROR);
				throw new Exception("System can't delete record.", 1);							
			}
			$this->getMessage()->addMessage("Data Deleted.", Model_Core_Message::SUCCESS);
			$this->redirect($this->getView()->getUrl(null, null, null, true)); 

		}
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl(null, null, null, true)); 
		}	
	}

	public function errorAction()
	{
			echo "Error.";
	}


}