<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Product extends Controller_Core_Action{

	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }

	// public function gridAction()			
	// {	
	// 	$this->setTitle('Product Grid');
	// 	$productGrid = Ccc::getBlock('Product_Grid');
	// 	$content = $this->getLayout()->getContent();
	// 	$content->addChild($productGrid);
	// 	$this->renderLayout();		
	// }


    public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$productGrid = Ccc::getBlock('Product_Index');
		$content->addChild($productGrid);
		$this->renderLayout();

	}

	public function gridBlockAction()
	{
		$productGrid = Ccc::getBlock('Product_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $productGrid
		];
		$this->renderJson($response);
	}


	public function editAction()
	{
		try 
		{
			if ((int) $this->getRequest()->getRequest('id')) {
				$this->setTitle('Product Edit');
				$id = (int) $this->getRequest()->getRequest('id');
				$product = Ccc::getModel('Product')->load($id);
				if (!$product) 
				{
					throw new Exception("Unable to Load", 1);	
				}
			}
			else
			{
				$this->setTitle('Product Add');
				$product = Ccc::getModel('Product');
			}	
			Ccc::register('product', $product);
			$productEdit = Ccc::getBlock('Product_Edit')->toHtml();
			$response = [
			'status' => 'success',
			'content' => $productEdit
			];
			$this->renderJson($response);
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->redirectPage();
		}
	}

	public function saveAction()
	{
		try{
			$productData = $this->getRequest()->getPost('product');
			$categoryData = $this->getRequest()->getPost('category');
			if (!$productData) 
			{
				throw new Exception("Missing product data in request.", 1);	
			}
			
			$productModel = Ccc::getModel('Product');
			$categoryProduct = Ccc::getModel('Category_Product');

			if ((int)$this->getRequest()->getRequest('id')) 
			{
				$productId = $this->getRequest()->getRequest('id');
				$productRow = $productModel->load($productId);
				$productRow->setData($productData);
				$productRow->productId = $productId;
				$productRow->updatedDate = date('Y-m-d H:i:s');
				$update = $productRow->save();

				$CategoryProductRow = $categoryProduct->fetchAll("SELECT * FROM `category_product` WHERE `productId` = '{$productId}'");
				if ($CategoryProductRow) 
				{
					foreach ($CategoryProductRow as $key => $value) 
					{
						$categoryModel = Ccc::getModel('category_product');
						$categoryModel->delete($value->entityId);
					}
					$categoryProduct->productId = $productId;
					foreach ($categoryData['categoryId'] as $key => $id) 
					{
						$categoryProduct->categoryId = $id;
						$categoryProduct->save();
					}
				}

			  	if (!$update) 
			  	{
					throw new Exception("System can't update.", 1);
				}
				$this->getMessage()->addMessage('Data Updated.');	
			
			}
			else
			{
				$productModel->setData($productData);
				$productModel->createdDate = date('Y-m-d H:i:s');
				$insertId = $productModel->save();

				if ($categoryData) 
				{
					$categoryProduct->productId = $insertId;
					foreach ($categoryData['categoryId'] as $key => $id) 
					{
						$categoryProduct->categoryId = $id;
						$categoryProduct->save();
					}	
				}

				if (!$insertId) 
				{
			        throw new Exception("System can't insert.", 1);	
			    }
			    $this->getMessage()->addMessage('Data Inserted.');
			}	
			$this->redirectPage();
		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
	    	$this->redirectPage();
	    }			
	}

	public function deleteAction()
	{
		$id = $this->getRequest()->getRequest('id');
		try
		{
			if (!$id)
			{
				throw new Exception("Invalid Request.", 1);
			}

			$productModel = Ccc::getModel('Product_Resource');
			$delete = $productModel->delete($id);
			if(!$delete)
			{	
				throw new Exception("System can't delete record.", 1);
			}
			$this->getMessage()->addMessage('Data Deleted.');
			$this->redirectPage();
		}
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
			$this->redirectPage();

		}	
	}

	public function redirectPage()
	{
		$productGrid = Ccc::getBlock('Product_Grid')->toHtml();
 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
 		$response = [
		'status' => 'success',
		'content' => $productGrid,
		'message' => $message
		];
		$this->renderJson($response); 	
	}
}