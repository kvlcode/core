<?php 

Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman extends Controller_Core_Action{

	public function gridAction()
	{
		$salesmanGrid = Ccc::getBlock('Salesman_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($salesmanGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Salesman_Grid');
		$this->renderLayout();
	}

	public function editAction()
	{	
		try {
			
			if ((int) $this->getRequest()->getRequest('id')) {
			
				$id = (int) $this->getRequest()->getRequest('id');	
				$salesman = Ccc::getModel('Salesman')->load($id);

				if (!$salesman) {
					$this->getMessage()->addMessage("Unable to load.", Model_Core_Message::ERROR);
					throw new Exception("Unable to load.", 1);
					
				}			
			}
			else
			{
				$salesman = Ccc::getModel('Salesman');
			}

			$salesmanEdit = Ccc::getBlock('Salesman_Edit')->setData(['salesmanEdit' => $salesman]);
			$content = $this->getLayout()->getContent();
			$content->addChild($salesmanEdit);
			$this->getLayout()->getChild('content')->getChild('Block_Salesman_Edit');
			$this->renderLayout();

		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl(null, null, null, true));

		}
	}


	public function saveAction()
	{
		try {
				
			$salesmanData = $this->getRequest()->getPost('salesman');
			if (!isset($salesmanData)) {
				$this->getMessage()->addMessage("Unable to load.", Model_Core_Message::ERROR);
				throw new Exception("Unable to load salesman data.", 1);
				
			}

			$salesmanModel = Ccc::getModel('Salesman');
			$salesmanModel->setData($salesmanData);

			if ($salesmanData['salesmanId'] != null) {
				
				if (!(int) $salesmanData['salesmanId']) {
					$this->getMessage()->addMessage("Invalid request.", Model_Core_Message::ERROR);
					throw new Exception("Invalid request.", 1);
					
				}

				$salesmanModel->updatedDate = date('Y-m-d H:i:s');
				$update = $salesmanModel->save();

				if (!$update) {
					$this->getMessage()->addMessage("System Can't update.", Model_Core_Message::ERROR);
					throw new Exception("System Can't update", 1);	
				}
				$this->getMessage()->addMessage('Data Updated.', Model_Core_Message::SUCCESS);

			}
			else
			{
				unset($salesmanModel->salesmanId);
				$salesmanModel->createdDate =  date('Y-m-d H:i:s');
				$insetId = $salesmanModel->save();

				if (!$insetId) {
					$this->getMessage()->addMessage("System Can't insert.", Model_Core_Message::ERROR);
					throw new Exception("System Can't insert", 1);		
				}
				$this->getMessage()->addMessage('Data Inserted.', Model_Core_Message::SUCCESS);

			}
			$this->redirect($this->getView()->getUrl(null, null, null, true));

		} 
		catch (Exception $e) 
		{	
			$this->redirect($this->getView()->getUrl(null, null, null, true));

		}
	}

	public function deleteAction()
	{	
		
		try
		{
			$id = $this->getRequest()->getRequest('id');
			if (!isset($id)) {
				$this->getMessage()->addMessage("Invalid Request.", Model_Core_Message::ERROR);
				throw new Exception("Invalid Request.", 1);
			}

			$salesmanModel = Ccc::getModel('Salesman');
			$delete = $salesmanModel->delete($id);
			if (!$delete) {
				$this->getMessage()->addMessage("System can't delete.", Model_Core_Message::ERROR);
				throw new Exception("System can't delete.", 1);
			}
			$this->getMessage()->addMessage('Data Deleted.', Model_Core_Message::SUCCESS);
			$this->redirect($this->getView()->getUrl(null, null, null, true));
		}
		catch (Exception $e) 
		{	
			$this->redirect($this->getView()->getUrl(null, null, null, true));

		}
	}

	public function errorAction()
	{
		echo "Error..!";
	}

}