<?php 
Ccc::loadClass('Controller_Core_Action');
class Controller_Product_Media extends Controller_Core_Action
{
	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }

	public function gridAction()
	{	
		$this->setTitle('Product Media Grid');
		$mediaGrid = Ccc::getBlock('Product_Media_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($mediaGrid);
		$this->renderLayout();
	}

	public function saveAction()
	{
		try 
		{
			if ($_FILES['image']) 
			{	
				if (!$this->getRequest()->getRequest('id')) 
				{
					throw new Exception("Invalid Request", 1);
				}
				$id = $this->getRequest()->getRequest('id');
				$file = $_FILES['image'];
				$extention =$file['type']; 
				$extention = explode("/", $extention);
				$extention = array_pop($extention);

				if($extention != "jpg" && $extention != "jpeg" && $extention != "png") 
				{
					throw new Exception("Invalid file extention.", 1);		
				}
		
				$imageName = date('Y-m-d H:i:s');
				$imageName = str_replace(array('-',':',' ') ,'', $imageName.".jpg");
				$tempName = $file['tmp_name'];
				move_uploaded_file($tempName, 'Media/Product/'.$imageName);
				$imageModel = Ccc::getModel('Product_Media');
				$imageModel->productId = $id;
				$imageModel->name = $imageName;
				$upload = $imageModel->save();
				if (!$upload) 
				{
					throw new Exception("System can't upload", 1);	
				}
				$this->getMessage()->addMessage("Image Uploaded", Model_Core_Message::SUCCESS);

			}
			else
			{
				$imageData = $this->getRequest()->getPost('image');
				$id = Ccc::getFront()->getRequest()->getRequest('id');
				$mediaModel = Ccc::getModel('Product_Media');
				$mediaModel->productId = $id;

				foreach ($imageData as $key => $value) 
				{	
					$mediaModel->$key = 0;
					$mediaModel->save('productId');
					unset($mediaModel->$key);	
				}

				foreach ($imageData as $key => $value) 
				{
					if (!is_array($value)) 
					{
						$mediaModel->$key = 1;
						$mediaModel->imageId = $value;
						$mediaModel->save();
						unset($mediaModel->$key);	
					}
					else
					{
						foreach ($value as $key2 => $value2) 
						{ 
							if ($key == 'remove') 
							{
								$mediaModel->delete($value2);
							}
							else
							{
								$mediaModel->$key = 1;
								$mediaModel->imageId = $value2;
								$mediaModel->save();
								unset($mediaModel->$key);
							}	
						}		
					}
				}
				$this->getMessage()->addMessage("Image Data updated", Model_Core_Message::SUCCESS);
			}
			$this->redirect($this->getView()->getUrl(null, null, ['id'=> $id], true));

		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);	
			$this->redirect($this->getView()->getUrl(null, null, ['id'=> $id], true));
		}
	}
}