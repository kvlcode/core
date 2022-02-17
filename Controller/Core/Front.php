<?php 

class Controller_Core_Front{

	protected $request = null;

	public function setRequest($request)
	{
		$this->request = $request;
		return $this;
	}

	public function getRequest()
	{
		if(!$this->request){
			$request = new Model_Core_Request();
			$this->setRequest($request);
		}
		return $this->request;
	}

	public function init()
	{	
		$actionName=(isset($_GET['a'])) ? $_GET['a'].'Action' : 'error'; 

		$controllerName=$_GET['c'];
		$controllerName = 'Controller_'.$controllerName;
		$controllerClassName=$this->prepareClassName($controllerName); 

		Ccc::loadClass($controllerClassName);
		$controller = new $controllerClassName();
		$controller->$actionName();
	}

	public function prepareClassName($name)
	{
		$name=ucwords($name,"_");
		//echo $name;
		return $name;
	}
}

?>