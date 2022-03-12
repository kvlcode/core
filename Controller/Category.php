<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Category extends Controller_Core_Action{

	public function gridAction()
	{
		$categoryGrid = Ccc::getBlock('Category_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($categoryGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Category_Grid');
		$this->renderLayout();
	}

	public function editAction()
	{	

		try {

			if ((int) $this->getRequest()->getRequest('id')) {
				
				$id = (int) $this->getRequest()->getRequest('id');
				$categoryRow = Ccc::getModel('Category')->fetchRow("SELECT * FROM categories WHERE categoryId='$id'");
				
				if (!$categoryRow) {
					$this->getMessage()->addMessage("Unable to Load Data", Model_Admin_Message::ERROR);
					throw new Exception("Unable to Load Data", 1);	
				}

			}
			else{

				$categoryRow = Ccc::getModel('Category');
			}

			$categoryEdit = Ccc::getBlock('Category_Edit')->addData('categoryRow', $categoryRow);
			$content = $this->getLayout()->getContent();
			$content->addChild($categoryEdit);
			$this->getLayout()->getChild('content')->getChild('Block_Category_Edit');
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
			$category = $this->getRequest()->getPost('category');	
			$categoryModel = Ccc::getModel('Category');
			$categoryModel->setData($category);
			
			$date =date('y-m-d h:m:s');
			if($category['categoryId'] != null){

				if (!(int)$category['categoryId']) {
					$this->getMessage()->addMessage("Invalid Request.", Model_Admin_Message::ERROR);
					throw new Exception("Invalid Request", 1);	
				}

				$categoryId = $categoryModel->categoryId;
				$oldPath = $categoryModel->fetchRow("SELECT path FROM `categories` WHERE `categoryId` ='$categoryId' ");
			
				$oldPathString = $oldPath->path;

				$samePath = $categoryModel->fetchAll("SELECT path, parentId FROM `categories` WHERE path LIKE '%$oldPathString%'");

				if ($samePath) {
		
					foreach ($samePath as $key => $value) {
									
						$parentId = $value->parentId;
						$samePath2 = explode("/", $value->path);
						unset($samePath2[0]);
						$samePath3 = implode("/", $samePath2);
						$finalPath = $categoryModel->parentPath ."/".$samePath3;

						$categoryPathModel = Ccc::getModel('Category');
						$categoryPathModel->parentId = $parentId;
						$categoryPathModel->path = $finalPath;
						$categoryPathModel->save('parentId');

					}
				}

				$newPath = $categoryModel->parentPath ."/".$categoryId;	
				$categoryModel->path = $newPath;
				$categoryModel->updatedDate = date('Y-m-d H:i:s');
				unset($categoryModel->parentPath);
				$update = $categoryModel->save();
				if (!$update) {
					$this->getMessage()->addMessage("System can't update.", Model_Admin_Message::ERROR);	
					throw new Exception("System can't update", 1);
				}
				$this->getMessage()->addMessage('Data Updated.');	
			}
			else
			{

				$categoryModel->createdDate = date('Y-m-d H:i:s');
				$path = $categoryModel->path;
				unset($categoryModel->categoryId);

				$insertId = $categoryModel->save();
				$modelPath = Ccc::getModel('Category')->load($path, 'name');
				$categoryModel->categoryId = $insertId;
				
				if ($categoryModel->path == '0') {
					$categoryModel->path = $insertId;
					$categoryModel->save();	
				}
				else{

					$categoryModel->path = $modelPath->path."/".$insertId;
					$pathArray = explode("/", $modelPath->path);   			 
					$categoryModel->parentId = array_pop($pathArray);    // parentId of new element
					$insert = $categoryModel->save();
					if (!$insert) {
						$this->getMessage()->addMessage("System can't insert.", Model_Admin_Message::ERROR);	
						throw new Exception("System can't update", 1);
					}
					$this->getMessage()->addMessage('Data Inserted.');

				}
			}
				
			$this->redirect($this->getView()->getUrl(null, null, null, true));	
		}
		catch (Exception $e){
			$this->redirect($this->getView()->getUrl(null, null, null, true));	
		}	
	}

	public function deleteAction()
	{

		try{	
			
			$id = $this->getRequest()->getRequest('id');

			if (!isset($id)) {
				$this->getMessage()->addMessage("Invalid Request.", Model_Admin_Message::ERROR);	
				throw new Exception("Invalid Request.", 1);
			}
			
			$categoryModel = Ccc::getModel('Category');
			$delete = $categoryModel->delete($id);
		
			if(!$delete)
			{
				$this->getMessage()->addMessage("System can't delete record.", Model_Admin_Message::ERROR);	
				throw new Exception("System can't delete record.", 1);							
			}
			$this->getMessage()->addMessage('Data Deleted.');
			$this->redirect($this->getView()->getUrl(null, null, null, true));
		
		}
		catch (Exception $e) 
		{		
			$this->redirect($this->getView()->getUrl(null, null, null, true));
		}
		
	}

}

?>