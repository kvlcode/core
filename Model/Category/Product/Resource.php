<?php  Ccc::loadClass('Model_Core_Row_Resource');?>
<?php
class Model_Category_Product_Resource extends Model_Core_Row_Resource
{
		protected $resourceName = null;
		protected $primaryKey = null;
	
	public function __construct()
	{
		$this->setResourceName('category_product');
		$this->setPrimaryKey('entityId');
	}
}