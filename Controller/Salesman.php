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
    public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$salesmanGrid = Ccc::getBlock('Salesman_Index');
		$content->addChild($salesmanGrid);
		$this->renderLayout();

	}

	public function gridBlockAction()
	{
		$salesmanGrid = Ccc::getBlock('Salesman_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $salesmanGrid
		];
		$this->renderJson($response);
	}

	public function editAction()
	{	
		try 
		{
			if ((int) $this->getRequest()->getRequest('id'))
			{
				$this->setTitle('Salesman Edit');
				$id = (int) $this->getRequest()->getRequest('id');	
				$salesman = Ccc::getModel('Salesman')->load($id);
				if (!$salesman) 
				{
					throw new Exception("Unable to load.", 1);		
				}			
			}
			else
			{
				$this->setTitle('Salesman Add');
				$salesman = Ccc::getModel('Salesman');
			}
			Ccc::register('salesman', $salesman);
			$salesmanEdit = Ccc::getBlock('Salesman_Edit')->toHtml();
			$response = [
			'status' => 'success',
			'content' => $salesmanEdit
			];
			$this->renderJson($response);	
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
			$this->redirectPage();

		}
	}

	public function saveAction()
	{
		try 
		{		
			$salesmanData = $this->getRequest()->getPost('salesman');
			if (!$salesmanData) 
			{
				throw new Exception("Unable to load salesman data.", 1);	
			}

			$salesmanModel = Ccc::getModel('Salesman');
			$salesmanModel->setData($salesmanData);
			$salesmanId = (int)$this->getRequest()->getRequest('id');
			if ($salesmanId) 
			{
				$salesmanModel->updatedDate = date('Y-m-d H:i:s');
				$salesmanModel->salesmanId = $salesmanId;
			}
			else
			{
				$salesmanModel->createdDate =  date('Y-m-d H:i:s');
			}

			$saveId = $salesmanModel->save();
			if (!$saveId) 
			{
				throw new Exception("System can't save data", 1);		
			}
			$this->getMessage()->addMessage('Data saved successfully.', Model_Core_Message::SUCCESS);
			$this->redirectPage();
		} 
		catch (Exception $e) 
		{	
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
			$this->redirectPage();
		}
	}

	public function deleteAction()
	{	
		try
		{
			$id = $this->getRequest()->getRequest('id');
			if (!$id) 
			{
				throw new Exception("Invalid Request.", 1);
			}

			$salesmanModel = Ccc::getModel('Salesman');
			$delete = $salesmanModel->delete($id);
			if (!$delete) 
			{
				throw new Exception("System can't delete.", 1);
			}
			$this->getMessage()->addMessage('Data Deleted.', Model_Core_Message::SUCCESS);
			$this->redirectPage();
		}
		catch (Exception $e) 
		{	
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
			$this->redirectPage();
		}
	}

	public function redirectPage()
	{
		$salesmanGrid = Ccc::getBlock('Salesman_Grid')->toHtml();
 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
 		$response = [
		'status' => 'success',
		'content' => $salesmanGrid,
		'message' => $message
		];
		$this->renderJson($response);
	}
}