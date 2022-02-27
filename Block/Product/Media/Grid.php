<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Product_Media_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/media/grid.php');
	}

	public function getMediaData()
	{
		$mediaModel = Ccc::getModel('Product_Media');
		$id = Ccc::getFront()->getRequest()->getRequest('id');
		$media = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE productId = {$id}");
		return $media;
	}
}