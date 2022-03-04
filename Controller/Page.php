<?php 
Ccc:: loadClass('Controller_Core_Action');

class Controller_Page extends Controller_Core_Action{

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$pageGrid = Ccc::getBlock('Page_Grid');
		$content->addChild($pageGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Page_Grid');
		$this->renderLayout();
	}

	public function editAction()
	{
		try {
			
			if ((int) $this->getRequest()->getRequest('id')) {

				$id = (int) $this->getRequest()->getRequest('id');

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
				$page = Ccc::getModel('Page');
			}

			$pageEdit = Ccc::getBlock('Page_Edit')->setData(['pageEdit' => $page]);
			$content = $this->getLayout()->getContent();
			$content->addChild($pageEdit);
			$this->getLayout()->getChild('content')->getChild('Block_Page_Edit');
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

			if ($pageData['pageId'] != null) {
				
				if (!(int) $pageData['pageId']) {
					$this->getMessage()->addMessage("Invalid Request.", Model_Core_Message::ERROR);
					throw new Exception("Invalid Request.", 1);
					
				}

				$pageModel->updatedDate =  date('Y-m-d H:i:s');
				$update = $pageModel->save();

				if (!$update) {
					$this->getMessage()->addMessage("System can't update.", Model_Core_Message::ERROR);
					throw new Exception("System can't update.", 1);	
				}
				$this->getMessage()->addMessage('Data Updated.', Model_Core_Message::SUCCESS);
			}
			else
			{
				unset($pageModel->pageId);
				$pageModel->createdDate = date('Y-m-d H:i:s');
				$insertId = $pageModel->save();
				if (!$insertId) {
					$this->getMessage()->addMessage("System can't insert.", Model_Core_Message::ERROR);
					throw new Exception("Sustem can't'insert.", 1);
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
