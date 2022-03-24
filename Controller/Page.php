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
		try 
		{	
			if ((int) $this->getRequest()->getRequest('id')) 
			{
				$this->setTitle('Page Edit');
				$id = (int)$this->getRequest()->getRequest('id');
				if (!$id) 
				{
					throw new Exception("Invalid request.", 1);
				}

				$page = Ccc::getModel('Page')->load($id);
				if (!$page) 
				{
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
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
			$this->redirect($this->getView()->getUrl(null, null, null, true));
		}
	}

	public function saveAction()
	{
		try
		{
			$pageData = $this->getRequest()->getPost('page');
			if (!isset($pageData)) 
			{
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
			if (!$saveId) 
			{
				throw new Exception("Sustem can't' save data.", 1);
			}
			$this->getMessage()->addMessage('Data Saved successfully.');
			$this->redirect($this->getView()->getUrl(null, null, null, true));
		}
		catch (Exception $e) 
		{	
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);		
			$this->redirect($this->getView()->getUrl(null, null, null, true));
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

			$pageModel = Ccc::getModel('Page');
			$delete = $pageModel->delete($id);
         	if (!$delete) 
         	{
         		throw new Exception("System can't delete.", 1);
         	}
         	$this->getMessage()->addMessage('Data Deleted.', Model_Core_Message::SUCCESS);
      		$this->redirect($this->getView()->getUrl(null, null, null, true));

		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
			$this->redirect($this->getView()->getUrl(null, null, null, true));
		}
	}

	public function deleteAllAction()
	{
		try {
			
			$delete = $this->getRequest()->getPost('check');
			//Working...

		} catch (Exception $e) {
			
		}
	}

}
