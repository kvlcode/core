<?php
 Ccc::loadClass('Model_Core_Row');
class Model_Category_Media extends Model_Core_Row{

	protected $category;
	protected $path ='Media/Category';

	public function __construct()
	{	
		$this->setResourceClassName('Category_Media_Resource');
	}

	public function setCategory($category)
	{
		$this->category = $category;
		return $this;
	}

	public function getCategory($reload = false)
	{
		$categoryModel = Ccc::getModel('category'); 
		if(!$this->category)
		{
			return null;
		}
		if($this->category && !$reload)
		{
			return $this->category;
		}
		$category = $mediaModel->fetchRow("SELECT * FROM `image` WHERE `categoryId` = {$this->category}");
		if(!$category)
		{
			return null;
		}
		$this->setcategory($category);

		return $this->category;
	}

	public function getImageUrl()
	{
		return Ccc::getBaseUrl($this->path.'/'.$this->name);
	}
}
