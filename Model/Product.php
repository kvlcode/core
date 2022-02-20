<?php
Ccc::loadClass('Model_Core_Table');
class Model_Product extends Model_Core_Table{

	protected $tableName = NULL;
	protected $primaryKey = NULL;

	public function __construct()
	{
		$this->setTableName('product')->setPrimaryKey('productId');
	}
}