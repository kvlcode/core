<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Category extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Category_Grid')->toHtml();
	}

	public function addAction(){

		$categoryTable = Ccc::getModel('Category');
		$category = $categoryTable->fetchAll("SELECT name, path FROM categories ORDER BY path");
		Ccc::getBlock('Category_Add')->addData('parentCategory', $category)->toHtml();
	
	}

	public function editAction()
	{	

		try {
			
			$id = (int) $this->getRequest()->getRequest('id');
			if (!$id) {
				throw new Exception("Invalid Id", 1);
				
			}

			$categoryTable = Ccc::getModel('Category');
			$row = $categoryTable->fetchRow("SELECT * FROM categories WHERE categoryId='$id'");
			
			if (!$row) {
					throw new Exception("Unable to Load Row", 1);	
			}

			$parentList = $categoryTable->fetchAll("SELECT path FROM categories WHERE path NOT LIKE '%$id%'");
				
			Ccc::getBlock('Category_Edit')->addData('categoryRow', $row)->addData('parent', $parentList)->toHtml();

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
		
		$parentName = $category['parentName'];
		$parentPath = $category['parentPath'];
		$hiddenId = $category['hiddenId'];
		$name= $category['name'];
		$status=$category['status'];
		$date=date('y-m-d h:m:s');
	
		if(array_key_exists('hiddenId', $category)){

			$categoryTable = Ccc::getModel('Category');
			$oldPath = $categoryTable->fetchRow("SELECT path FROM `categories` WHERE `categoryId` ='$hiddenId' ");
			
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

			$newPath = $parentPath ."/".$hiddenId;	

			$updateQuery = "UPDATE `categories` SET  `name` = '$name', `status`= '$status',`path`='$newPath', `updatedDate` = '$date' WHERE `categoryId` ={$hiddenId}";

			$updateId = $adapter->update($updateQuery);

		}
		else
		{
			$insertId = $adapter->insert("INSERT INTO `categories` ( `name`, `status`, `createdDate`,`path`) VALUES ( '$name', '$status', '$date', '$parentName')");
			$path = $adapter->fetchRow("SELECT * FROM `categories` WHERE `name` = '$parentName' ");
			
			if ($parentName == '0') {
				$newPath = $adapter->update(" UPDATE `categories` SET `path` = '$insertId' WHERE `categoryId` = '$insertId'");	
			}
			else{
				$parentPath = $path['path']."/".$insertId;    // path of new element
				$pathArray = explode("/", $path['path']);    
				$parentIdTable = array_pop($pathArray);    // parentId of new element
				$newPath = $adapter->update(" UPDATE `categories` SET `path` = '$parentPath', `parentId`='$parentIdTable'  WHERE `categoryId` = '$insertId' ");
			}
		}
			
		$this->redirect($this->getUrl('category','grid'));
		
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

			$this->redirect($this->getUrl('category','grid'));
		
		}catch (Exception $e) {
			$this->redirect($this->getUrl('category','grid'));	
			//echo $e->getMessage();
		}
		
	}

	public function errorAction(){

		echo "Error Ocurred!!";	
	}

}

?>