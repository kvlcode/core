<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Category_Media_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/media/grid.php');
	}

	public function getMediaData()
	{
		$mediaModel = Ccc::getModel('Category_Media');
		$id = Ccc::getFront()->getRequest()->getRequest('id');
		$media = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE categoryId = {$id}");
		return $media;
	}
}