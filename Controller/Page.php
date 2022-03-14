<?php 
Ccc:: loadClass('Controller_Core_Action');

class Controller_Page extends Controller_Core_Action{

	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }

	public function gridAction()
	{
		$this->setTitle('Page Grid');
		$content = $this->getLayout()->getContent();
		$pageGrid = Ccc::getBlock('Page_Grid');
		$content->addChild($pageGrid);
		$this->renderLayout();
	}

	public function editAction()
	{
		try {
			
			if ((int) $this->getRequest()->getRequest('id')) {
				$this->setTitle('Page Edit');
				$id = (int)$this->getRequest()->getRequest('id');
				if (!$id) {
					$this->getMessage()->addMessage("Invalid request.", Model_Core_Message::ERROR);
					throw new Exception("Invalid request.", 1);
				}

				$page = Ccc::getModel('Page')->load($id);
				if (!$page) {
					$this->getMessage()->addMessage("Unable to load.", Model_Core_Message::ERROR);
					throw new Exception("Unable to load.", 1);
				}
			}
			else
			{
				$this->setTitle('Page Add');
				$page = Ccc::getModel('Page');
			}

			$pageEdit = Ccc::getBlock('Page_Edit')->setPage($page);
			$content = $this->getLayout()->getContent();
			$content->addChild($pageEdit);
			$this->renderLayout();

		}
		catch (Exception $e)
		{
			$this->redirect($this->getView()->getUrl(null, null, null, true));
		}
	}

	public function saveAction()
	{
		try
		{
			$pageData = $this->getRequest()->getPost('page');

			if (!isset($pageData)) {
				$this->getMessage()->addMessage("Unable to load data.", Model_Core_Message::ERROR);
				throw new Exception("Unable to load data.", 1);
				
			}

			$pageModel = Ccc::getModel('Page');
			$pageModel->setData($pageData);
			$pageId = (int)$this->getRequest()->getRequest('id');

			if ($pageId) 
			{
				$pageModel->updatedDate =  date('Y-m-d H:i:s');
				$pageModel->pageId = $pageId;
			}
			else
			{
				$pageModel->createdDate = date('Y-m-d H:i:s');
			}

			$saveId = $pageModel->save();
			if (!$saveId) {
				$this->getMessage()->addMessage("System can't save data.", Model_Core_Message::ERROR);
				throw new Exception("Sustem can't' save data.", 1);
			}
			$this->getMessage()->addMessage('Data Saved successfully.');

			$this->redirect($this->getView()->getUrl(null, null, null, true));
		}
		catch (Exception $e) 
		{	
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

			$pageModel = Ccc::getModel('Page');
			$delete = $pageModel->delete($id);
         	if (!$delete) {
				$this->getMessage()->addMessage("System can't delete.", Model_Core_Message::ERROR);
         		throw new Exception("System can't delete.", 1);
         	}
         	$this->getMessage()->addMessage('Data Deleted.', Model_Core_Message::SUCCESS);
      		$this->redirect($this->getView()->getUrl(null, null, null, true));

		} catch (Exception $e) {
			$this->redirect($this->getView()->getUrl(null, null, null, true));
		}
	}

	public function errorAction()
	{
		echo "Error!!";
	}


}
