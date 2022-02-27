<?php
Ccc::loadClass('Model_Core_Row_Resource');
class Model_Admin_Resource extends Model_Core_Row_Resource
{
	protected $resourceName = NULL;
	protected $primaryKey = NULL;

	public function __construct()
	{
		$this->setResourceName('admin');
		$this->setPrimaryKey('adminId');
	}
}
