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
					throw new Exception("Unable to Load", 1);	
				}
			}
			else
			{
				$config = Ccc::getModel('Config');
			}	

			$configEdit = Ccc::getBlock('Config_Edit')->setData(['configEdit' => $config]);
			$content = $this->getLayout()->getContent();
			$content->addChild($configEdit);
			$this->getLayout()->getChild('content')->getChild('Block_Config_Edit');
			$this->renderLayout();

		} 
		catch (Exception $e) {

			echo $e->getMessage();
			
		}
	}

	public function saveAction()
	{
		try{
 
			$configData = $this->getRequest()->getPost('config');

			if (!isset($configData)) {
				throw new Exception("Missing config data in request.", 1);
				
			}
			$configModel = Ccc::getModel('Config');
			$configModel->setData($configData);

			if (!empty($configData['configId'])) {

				if (!(int)$configData['configId']) {
					throw new Exception("Invalid request", 1);
					
				}

				// $configModel->updatedDate = date('Y-m-d H:i:s');
				$update = $configModel->save();

			  	if (!$update) {
					throw new Exception("System can't update", 1);
				
				}	
			
			}
			else
			{
				unset($configModel->configId);
				$configModel->createdDate = date('Y-m-d H:i:s');
				$insertId = $configModel->save();

				if (!$insertId) {
			         	throw new Exception("System can't insert", 1);	
			    }

			}	
			$this->redirect($this->getView()->getUrl(null, null, null, true)); 				
		
		}catch(Exception $e){
	    	
	    	echo $e->getMessage();
	    }			

	}



	public function deleteAction()
	{

		$id = $this->getRequest()->getRequest('id');

		try{
			if (!isset($id)){
				throw new Exception("Invalid Request", 1);
			}

			$configModel = Ccc::getModel('Config_Resource');
			$delete = $configModel->delete($id);
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect($this->getView()->getUrl(null, null, null, true)); 

		}catch (Exception $e) {

			echo $e->getMessage();
		}
		
	}

	public function errorAction()
	{
			echo "Error.";
	}


}