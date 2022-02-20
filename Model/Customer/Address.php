<?php
Ccc::loadClass('Model_Core_Table');

class Model_Customer_Address extends Model_Core_Table{

	protected $tableName = NULL;
	protected $primaryKey = NULL;

	public function __construct()
	{
		$this->setTableName('address')->setPrimaryKey('addressId');
	}
}