<?php
Ccc::loadClass('Model_Core_Table');
class Model_Product_Resource extends Model_Core_Table{

	protected $tableName = NULL;
	protected $primaryKey = NULL;

	public function __construct()
	{
		$this->setTableName('product');
		$this->setPrimaryKey('productId');
		$this->setRowClassName('Product');
	}
}