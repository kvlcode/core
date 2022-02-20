<?php
Ccc::loadClass('Model_Core_Table');
class Model_Customer extends Model_Core_Table{

	protected $tableName = NULL;
	protected $primaryKey = NULL;

	public function __construct()
	{
		$this->setTableName('customer')->setPrimaryKey('customerId');
	}
}