<?php
Ccc::loadClass('Model_Core_Row');
class Model_Vendor extends Model_Core_Row{

	public function __construct()
	{	
		$this->setResourceClassName('Vendor_Resource');
	}

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DISABLED_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';

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
}