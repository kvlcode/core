<?php require_once('Model/Core/Adapter.php');?>
<?php $adapter = new Model_Core_Adapter();?>
<?php date_default_timezone_set("Asia/Kolkata");?>
<?php require_once('menu.php');?>
<?php 

class Ccc{

	public static $front = null;

	public static function setFront($front)
	{
		self::$front = $front;	
	}

	public static function getFront()
	{		
		Ccc::loadClass('Controller_Core_Front');
		if(!self::$front){
			$front = new Controller_Core_Front();
			self::setFront($front);
		}
		return self::$front;
	}
	
	public static function loadFile($path)
	{
		require_once($path);
	}

	public static function loadClass($className)
	{
		$path=str_replace('_', '/', $className).".php"; //Controller/Customer.php
		Ccc::loadFile($path);
	}

	public static function getModel($className)
	{
		$className = 'Model_'.$className;
		self::loadClass($className);
		return new $className();
	}

	public static function getBlock($className)
	{
		$className = 'Block_'.$className;
		self::loadClass($className);
		return new $className();
	}

	public static function init()
	{
			self::getFront()->init();
	}	
}

Ccc::init();

?>