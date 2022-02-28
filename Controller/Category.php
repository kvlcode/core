<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Category extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Category_Grid')->toHtml();
	}

	public function editAction()
	{	

		try {

			if ((int) $this->getRequest()->getRequest('id')) {
				
				$id = (int) $this->getRequest()->getRequest('id');

				$categoryRow = Ccc::getModel('Category')->fetchRow("SELECT * FROM categories WHERE categoryId='$id'");
				
				if (!$categoryRow) {
						throw new Exception("Unable to Load Row", 1);	
				}

			}
			else{

				$categoryRow = Ccc::getModel('Category');
			}

			Ccc::getBlock('Category_Edit')->addData('categoryRow', $categoryRow)->toHtml();

		}
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}	

	}

	public function saveAction()
	{	
		global $adapter;
		$category = $this->getRequest()->getPost('category');
		
		$categoryModel = Ccc::getModel('Category');
		$categoryModel->setData($category);

		// $parentName = $category['parentName'];
		// $parentPath = $category['parentPath'];
		// $categoryId = $category['categoryId'];
		// $name = $category['name'];
		// $status =$category['status'];
		$date =date('y-m-d h:m:s');
	
		if(($category['categoryId'] != null)){

			$categoryModel = Ccc::getModel('Category');
			$oldPath = $categoryModel->fetchRow("SELECT path FROM `categories` WHERE `categoryId` ='$categoryId' ");
			
			$oldPathString = $oldPath['path'];

			$samePath = $adapter->fetchAll("SELECT path, parentId FROM `categories` WHERE path LIKE '%$oldPathString/%'");
			
			foreach ($samePath as $key => $value) {
				
				$parentId = $value['parentId'];
				
				$samePath2 = explode("/", $value['path']);
				unset($samePath2[0]);
				$samePath3 = implode("/", $samePath2);

				$finalPath = $parentPath ."/".$samePath3;
				
				$pathQuery = "UPDATE `categories` SET `path`='$finalPath' WHERE `parentId` ='$parentId'";
				$adapter->update($pathQuery);

			}

			$newPath = $parentPath ."/".$categoryId;	

			$updateQuery = "UPDATE `categories` SET  `name` = '$name', `status`= '$status',`path`='$newPath', `updatedDate` = '$date' WHERE `categoryId` ={$categoryId}";

			$updateId = $adapter->update($updateQuery);

		}
		else
		{

			$categoryModel->createdDate = $date;
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

				$categoryModel->save();


			}
		}
			
		$this->redirect($this->getView()->getUrl('grid', 'category'));
		
	}

	public function deleteAction()
	{

		try{	
			
			$id = $this->getRequest()->getRequest('id');

			if (!isset($id)) {
				throw new Exception("Invalid Request.", 1);
			}
			
			global $adapter; 
			$delete = $adapter->delete("DELETE FROM categories WHERE categoryId=$id");
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}

			$this->redirect($this->getView()->getUrl('grid', 'category'));
		
		}catch (Exception $e) {
			$this->redirect($this->getView()->getUrl('grid', 'category'));	
			//echo $e->getMessage();
		}
		
	}

	public function errorAction(){

		echo "Error Ocurred!!";	
	}

}

?>