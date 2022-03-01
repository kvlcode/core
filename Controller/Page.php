<?php 
Ccc:: loadClass('Controller_Core_Action');

class Controller_Page extends Controller_Core_Action{


	public function gridAction()
	{
		Ccc::getBlock('Page_Grid')->toHtml();
	}

	public function editAction()
	{
		try {
			
			if ((int) $this->getRequest()->getRequest('id')) {

				$id = (int) $this->getRequest()->getRequest('id');

				if (!$id) {
					throw new Exception("Invalid request.", 1);
				}

				$page = Ccc::getModel('Page')->load($id);
				
				if (!$page) {
					throw new Exception("Unable to load", 1);
				}
			}
			else
			{
				$page = Ccc::getModel('Page');
			}

			Ccc::getBlock('Page_Edit')->setData(['pageEdit' => $page])->toHtml();

		}
		catch (Exception $e)
		{
			echo $e->getMessage();	
		}
	}

	public function saveAction()
	{
		try
		{
			$pageData = $this->getRequest()->getPost('page');

			if (!isset($pageData)) {
				throw new Exception("Unable to load data.", 1);
				
			}

			$pageModel = Ccc::getModel('Page');
			$pageModel->setData($pageData);

			if ($pageData['pageId'] != null) {
				
				if (!(int) $pageData['pageId']) {
					throw new Exception("Invalid Request.", 1);
					
				}

				$pageModel->updatedDate =  date('Y-m-d H:i:s');
				$update = $pageModel->save();

				if (!$update) {
					throw new Exception("System can't update.", 1);
					
				}
			}
			else
			{
				unset($pageModel->pageId);
				$pageModel->createdDate = date('Y-m-d H:i:s');
				$insertId = $pageModel->save();
				if (!$insertId) {
					throw new Exception("Sustem can't'insert.", 1);
					
				}
			}

			$this->redirect($this->getView()->getUrl('grid','page'));
		}
		catch (Exception $e) 
		{	
			echo $e->getMessage();
		}
	}


	public function deleteAction()
	{
		try {
			
			$id = $this->getRequest()->getRequest('id');
			if (!$id) {
				throw new Exception("Invalid Request.", 1);
				
			}

			$pageModel = Ccc::getModel('Page');
			$delete = $pageModel->delete($id);
         	if (!$delete) {
         		throw new Exception("System can't delete.", 1);
         	}
      		$this->redirect($this->getView()->getUrl('grid', 'page'));

		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function errorAction()
	{
		echo "Error!!";
	}


}
