<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Categories extends Controller_Core_Action{

	public function gridAction(){
		global $adapter;
		$categories = $adapter->fetchAll('SELECT * FROM categories');

		$view = $this->getView();
		$view->setTemplate('view/categories_grid.php');
		$view->addData('categoriesGrid', $categories);
		$view->toHtml();
	}

	public function addAction(){
		global $adapter;
		$categoriesAdd = $adapter->fetchAll("SELECT name, path FROM categories ORDER BY path");
		$view = $this->getView();
		$view->setTemplate('view/categories_add.php');
		$view->addData('categoriesAdd', $categoriesAdd);
		$view->toHtml();
	}

	public function editAction()
	{	
		$request = new Model_Core_Request();
		$id = $request->getRequest('id');
		global $adapter;
		$row = $adapter->fetchRow("SELECT * FROM categories WHERE categoryId='$id'");
		$view = $this->getView();
		$view->setTemplate('view/categories_edit.php');
		$view->addData('categoriesEdit', $row);
		$view->toHtml();
	}

	public function saveAction()
	{	
		global $adapter;
		$request = new Model_Core_Request();
		$row = $request->getPost('category');
		$parentName = $row['parentName'];
		$name= $row['name'];
		$status=$row['status'];
		$date=date('y-m-d h:m:s');
	
		$insertId=$adapter->insert("INSERT INTO `categories` ( `name`, `status`, `createdDate`,`path`) VALUES ( '$name' , '$status', '$date' , '$parentName')");
		$path = $adapter->fetchRow("SELECT * FROM `categories` WHERE `name` = '$parentName' ");
		
			if ($parentName == '0') {
				$newPath = $adapter->update(" UPDATE `categories` SET `path` = '$insertId' WHERE `categoryId` = '$insertId';");	

			}
			else{
				$parentPath = $path['path']."/".$insertId;
				print_r($parentPath);
				$path1 = explode("/", $path['path']);
				$parentIdTable = array_pop($path1);
				$newPath = $adapter->update(" UPDATE `categories` SET `path` = '$parentPath', `parentId`='$parentIdTable'  WHERE `categoryId` = '$insertId' ");
			}
			
		$this->redirect('index.php?a=grid&c=categories');
		
	}

	public function deleteAction()
	{

		try{
			$request = new Model_Core_Request();
			$id = $request->getRequest('id');	

			if (!isset($id)) {
				throw new Exception("Invalid Request.", 1);
			}
			
			global $adapter; 
			
			$delete = $adapter->delete("DELETE FROM categories WHERE categoryId=$id");
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}

			$this->redirect("index.php?a=grid&c=categories");
		
		}catch (Exception $e) {
			$this->redirect("index.php?a=grid&c=categories");	
			//echo $e->getMessage();
		}
		

	}

	public function errorAction(){

		echo "Error Ocurred!!";	
	}


}

?>