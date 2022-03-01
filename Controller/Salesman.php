<?php 

Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman extends Controller_Core_Action{


	public function gridAction()
	{
		Ccc::getBlock('Salesman_Grid')->toHtml();
	}

	public function editAction()
	{	
		try {
			
			if ((int) $this->getRequest()->getRequest('id')) {
			
				$id = (int) $this->getRequest()->getRequest('id');	
				$salesman = Ccc::getModel('Salesman')->load($id);

				if (!$salesman) {
					throw new Exception("Unable to load.", 1);
					
				}			
			}
			else
			{
				$salesman = Ccc::getModel('Salesman');
			}

			Ccc::getBlock('Salesman_Edit')->setData(['salesmanEdit' => $salesman])->toHtml();

		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}
	}


	public function saveAction()
	{
		try {
				
			$salesmanData = $this->getRequest()->getPost('salesman');
			if (!isset($salesmanData)) {
				throw new Exception("Unable to load salesman data.", 1);
				
			}

			$salesmanModel = Ccc::getModel('Salesman');
			$salesmanModel->setData($salesmanData);

			if ($salesmanData['salesmanId'] != null) {
				
				if (!(int) $salesmanData['salesmanId']) {
					throw new Exception("Invalid request.", 1);
					
				}

				$salesmanModel->updatedDate = date('Y-m-d H:i:s');
				$update = $salesmanModel->save();

				if (!$update) {
					throw new Exception("System Can't update", 1);
					
				}
			}
			else
			{
				unset($salesmanModel->salesmanId);
				$salesmanModel->createdDate =  date('Y-m-d H:i:s');
				$insetId = $salesmanModel->save();

				if (!$insetId) {
					throw new Exception("System Can't update", 1);
					
				}
			}
			$this->redirect($this->getView()->getUrl('grid', 'salesman'));

		} 
		catch (Exception $e) 
		{	
			echo $e->getMessage();
		}
	}

	public function deleteAction()
	{	
		
		try
		{
			$id = $this->getRequest()->getRequest('id');
			if (!isset($id)) {
				throw new Exception("Invalid Request.", 1);
			}

			$salesmanModel = Ccc::getModel('Salesman');
			$delete = $salesmanModel->delete($id);
			if (!$delete) {
				throw new Exception("System can't delete.", 1);
			}
			$this->redirect($this->getView()->getUrl('grid', 'salesman'));
		}
		catch (Exception $e) 
		{	
			echo $e->getMessage();
		}
	}

	public function errorAction()
	{
		echo "Error..!";
	}

}