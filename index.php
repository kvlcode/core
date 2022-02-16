<?php require_once('Model/Core/Adapter.php');?>
<?php date_default_timezone_set("Asia/Kolkata");?>
<?php require_once('menu.php');?>
<?php 

class Ccc{

	public $front = null;

	public function setFront($front)
	{
		$this->front = $front;
		return $this;
	}

	public function getFront()
	{		
		Ccc::loadClass('Controller_Core_Front');
		if(!$this->front){
			$front = new Controller_Core_Front();
			$this->setFront($front);
		}
		return $this->front;
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

	public function init()
	{
		//Ccc::loadClass('Controller_Core_Front');
		//$front=new Controller_Core_Front();
			$this->getFront()->init();
		/*
			$actionName=(isset($_GET['a'])) ? $_GET['a'] : 'error'; 
			$actionName=$actionName."Action"; //gridAction

			$controllerName=(isset($_GET['c'])) ? ucfirst($_GET['c']) : 'Customer'; //Customer
			$controllerPath='Controller/'.$controllerName.'.php'; //Controller/Customer.php
			$controllerClassName='Controller_'.$controllerName; // Controller_Customer

			Ccc::loadClass($controllerClassName);
			$controller = new $controllerClassName();
			$controller->$actionName();*/
	}	
}

$cc = new Ccc();
$cc->getFront()->init();

?>