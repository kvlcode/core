<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Admin');
class Controller_Admin extends Controller_Core_Action{

	public function testAction()
	{
		$controller = get_class();
		// $this->getUrl($action, $controller, ['id' => 2, 'tab'=> 'menu']);
		$this->getUrl('save','admin', ['id'=>2]);

	}

	public function gridAction()
	{
		
		$adminTable = Ccc::getModel('Admin');           // Returrn Object of given Model
		$admin = $adminTable->fetchAll();

		$view = $this->getView();
		$view->setTemplate('view/admin_grid.php');
		$view->addData('adminGrid', $admin);
		$view->toHtml();
	}

	public function editAction()
	{	
		$adminTable = Ccc::getModel('Admin');           // Returrn Object of given Model
		$id =  $this->getRequest()->getRequest('id');
		$row = $adminTable->fetchRow(['adminId'=> $id]);
		$view = $this->getView();
		$view->setTemplate('view/admin_edit.php');
		$view->addData('adminEdit', $row);
		$view->toHtml();
	}

	public function addAction()
	{
		$view =$this->getView();
		$view->setTemplate('view/admin_add.php');
		$view->toHtml();
		
	}

	public function saveAction()
	{	
		$adminTable = Ccc::getModel('Admin');
		$adminInfo = $this->getRequest()->getPost('admin');

		if (!isset($adminInfo)) {
			throw new Exception("Missing Admin data in request.", 1);
		}


		if (array_key_exists('hiddenId', $adminInfo)) {
			if (!(int)$adminInfo['hiddenId']) {
				throw new Exception("Invalid Request", 1);
				
			}

			$hiddenId = $adminInfo['hiddenId'];
			unset($adminInfo['hiddenId']);
			$adminInfo['updatedDate'] = date('Y-m-d H:i:s');
			$update = $adminTable->update($adminInfo, ['adminId' => $hiddenId]);

			if (!$update) {
					throw new Exception("System can't update", 1);
			}	
				

		}else{

			$adminInfo['createdDate'] = date('Y-m-d H:i:s');
			$insertId = $adminTable->insert($adminInfo);

			if (!$insertId) {
		       	throw new Exception("System can't insert", 1);
		        	
		    }
		        
		}
		$this->redirect('index.php?c=admin&a=grid');
	
	}
	
	public function deleteAction()
	{
		
		try {

			$id = $this->getRequest()->getRequest('id');
			
			if (!isset($id)) {
				throw new Exception("Invalid Request.", 1);
			}

			$adminTable = Ccc::getModel('Admin');
			$delete = $adminTable->delete(['adminId'=> $id]);

			// $delete = $adapter->delete("DELETE FROM admin WHERE adminId = $id"); 
			
			if(!$delete)
			{
				throw new Exception("System can't delete record.", 1);
										
			}
			$this->redirect('index.php?c=admin&a=grid');	
				
		} catch (Exception $e) {
			$this->redirect('index.php?c=admin&a=grid');	
			//echo $e->getMessage();
		}

	}

	public function errorAction()
	{
		echo "Error...";
	}
}

?>