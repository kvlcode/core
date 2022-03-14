<?php 

Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman extends Controller_Core_Action{

	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }

	public function gridAction()
	{
		$this->setTitle('Salesman Grid');
		$salesmanGrid = Ccc::getBlock('Salesman_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($salesmanGrid);
		$this->renderLayout();
	}

	public function editAction()
	{	
		try 
		{
			if ((int) $this->getRequest()->getRequest('id')) {
				$this->setTitle('Salesman Edit');
				$id = (int) $this->getRequest()->getRequest('id');	
				$salesman = Ccc::getModel('Salesman')->load($id);
				if (!$salesman) {
					$this->getMessage()->addMessage("Unable to load.", Model_Core_Message::ERROR);
					throw new Exception("Unable to load.", 1);		
				}			
			}
			else
			{
				$this->setTitle('Salesman Add');
				$salesman = Ccc::getModel('Salesman');
			}

			$salesmanEdit = Ccc::getBlock('Salesman_Edit')->setSalesman($salesman);
			$content = $this->getLayout()->getContent();
			$content->addChild($salesmanEdit);
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
			$salesmanId = (int)$this->getRequest()->getRequest('id');

			if ($salesmanId) {
				$salesmanModel->updatedDate = date('Y-m-d H:i:s');
				$salesmanModel->salesmanId = $salesmanId;
			}
			else
			{
				$salesmanModel->createdDate =  date('Y-m-d H:i:s');
			}

			$saveId = $salesmanModel->save();

			if (!$saveId) {
				$this->getMessage()->addMessage("System can't save data.", Model_Core_Message::ERROR);
				throw new Exception("System can't save data", 1);		
			}
			$this->getMessage()->addMessage('Data saved successfully.', Model_Core_Message::SUCCESS);
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