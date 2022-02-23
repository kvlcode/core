<?php
Ccc::loadClass('Model_Core_Table');
class Model_Admin_Resource extends Model_Core_Table
{
	protected $tableName = NULL;
	protected $primaryKey = NULL;

	public function __construct()
	{
		$this->setTableName('admin');
		$this->setPrimaryKey('adminId');
		$this->setRowClassName('Admin');

	}
}