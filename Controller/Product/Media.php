<?php 
Ccc::loadClass('Controller_Core_Action');
class Controller_Product_Media extends Controller_Core_Action
{

	public function gridAction()
	{	
		$mediaGrid = Ccc::getBlock('Product_Media_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($mediaGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Product_Media_Grid');
		$this->renderLayout();
	}

	public function saveAction()
	{

		if ($_FILES['image']) {
			
			$id = Ccc::getFront()->getRequest()->getRequest('id');
			$file = $_FILES['image'];

			$extention =$file['type']; 
			$extention = explode("/", $extention);
			$extention = array_pop($extention);
	
			$imageName = date('Y-m-d H:i:s');
			$imageName = str_replace(array('-',':',' ') ,'', $imageName.".JPG");
			$tempName = $file['tmp_name'];
			move_uploaded_file($tempName, 'Media/Product/'.$imageName);
			$imageModel = Ccc::getModel('Product_Media');
			$imageModel->productId = $id;
			$imageModel->name = $imageName;
			$imageModel->save();
		}
		else{

			$imageData = $this->getRequest()->getPost('image');
			$id = Ccc::getFront()->getRequest()->getRequest('id');

			$mediaModel = Ccc::getModel('Product_Media');
			$mediaModel->productId = $id;

			foreach ($imageData as $key => $value) {
				
					$mediaModel->$key = 0;
					$mediaModel->save('productId');
					unset($mediaModel->$key);	
				
			}

			foreach ($imageData as $key => $value) 
			{

				if (!is_array($value)) {
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
		}
		$this->redirect($this->getView()->getUrl('grid','product_media',['id'=> $id]));
	}
}