<?php require_once('Model/Core/Adapter.php');?>
<?php $adapter = new Model_Core_Adapter();?>
<?php date_default_timezone_set("Asia/Kolkata");?>
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
	
	public static function register($key, $value)
	{
		$GLOBALS[$key] = $value;
	}

	public static function getRegistry($key)
	{
		if (array_key_exists($key, $GLOBALS)) {
			 return $GLOBALS[$key];
		}
		return null;
	}

	public static function getConfig()
	{
		if (!($config = self::getRegistry('config'))) {
			$config = self::loadFile('etc/config.php');
			self::register('çonfig', $config);
		}
		return $config;
	}

	public static function loadFile($path)
	{
		return require_once(getcwd().DIRECTORY_SEPARATOR.$path);
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