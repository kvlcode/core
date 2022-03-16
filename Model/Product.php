<?php
 Ccc::loadClass('Model_Core_Row');
class Model_Product extends Model_Core_Row{

	protected $small;
	protected $thumbnail;
	protected $base;
	protected $gallery;
	protected $media;

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DISABLED_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';

	public function __construct()
	{	
		$this->setResourceClassName('Product_Resource');
	}

	public function getStatus($key = NULL)
	{
		$status = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
		];
		if(!$key){
			return $status;
		}
		if(array_key_exists($key, $status)){
			return $status[$key];
		}
		return self::STATUS_DISABLED_DEFAULT;
	}
	
	public function setMedia($media)
	{
		$this->media =$media;
		return $this;
	}

	public function getMedia($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->productId)
		{
			return $mediaModel;
		}
		if($this->media && !$reload)
		{
			return $this->media;
		}
		$media = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `productId` = {$this->productId}");
		if(!$media)
		{
			return null;
		}
		$this->setMedia($media);

		return $this->media;
	}

	public function setGallery($gallery)		
	{
		$this->gallery = $gallery;
		return $this;
	}

	public function getGallery($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->productId)
		{
			return $mediaModel;
		}
		if($this->gallery && !$reload)
		{
			return $this->gallery;
		}
		$gallery = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `productId` = {$this->gallery}");
		if(!$gallery)
		{
			return null;
		}
		$this->setGallery($gallery);

		return $this->gallery;
	}

	public function setBase($base)		
	{
		$this->base = $base;
		return $this;
	}

	public function getBase($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->productId)
		{
			return $mediaModel;
		}
		if($this->base && !$reload)
		{
			return $this->base;
		}
		$base = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `productId` = $this->productId AND `base` = 1");
		if(!$base)
		{
			return null;
		}
		$this->setBase($base);

		return $this->base;
	}

	public function setSmall($small)		
	{
		$this->small = $small;
		return $this;
	}

	public function getSmall($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->productId)
		{
			return $mediaModel;
		}
		if($this->small && !$reload)
		{
			return $this->small;
		}
		$small = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `productId` = $this->productId AND `small` = 1");
		if(!$small)
		{
			return null;
		}
		$this->setSmall($small);

		return $this->small;
	}

	public function setThumbnail($thumbnail)		
	{
		$this->thumbnail = $thumbnail;
		return $this;
	}

	public function getThumbnail()
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->productId)
		{
			return $mediaModel;
		}
		if($this->thumbnail && !$reload)
		{
			return $this->thumbnail;
		}
		$thumbnail = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `productId` = $this->productId AND `thumbnail` = 1");
		if(!$thumbnail)
		{
			return $mediaModel;
		}

		return $thumbnail;
	}

	public function setCategories($category)
	{
		$this->category = $category;
		return $this;
	}

	public function getCategories($reload = false)
	{
		$categoryModel = Ccc::getModel('Category');
		if (!$this->categoryId) 
		{
			return $categoryModel;
		}
		if ($this->category && !$reload) 
		{
			return $this->category;
		}
		$category = $categoryModel->fetchRow("SELECT * FROM `categories` 
											WHERE `categoryId` = {$this->categoryId}");
		if (!$category) 
		{
			return $categoryModel;
		}
		$this->setCategories($category);
		return $category;
	}
}