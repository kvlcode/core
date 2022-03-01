<?php 
Ccc::loadClass('Model_Core_Row_Resource');
class Model_Page_Resource extends Model_Core_Row_Resource{

	protected $resourceName = null;
	protected $primaryKey = null;

	public function __construct()
	{
		$this->setResourceName('page');
		$this->setPrimaryKey('pageId');
	}


}