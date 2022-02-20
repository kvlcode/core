<?php 

Ccc::loadClass('Model_Core_View');

class Controller_Core_Action {

	protected $view = null;

	public function setView($view)
	{
		$this->view = $view;
		return $this;
	}

	public function getView()
	{
		if (!$this->view) {
			$this->setView(new Model_Core_View());
		}
		return $this->view;
	}

	public function redirect($url)
	{
		header("Location: $url");
		exit();
	}

	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
	}

	public function getUrl($controllerName = null,$actionName = null, array $data = null, $reset = true)
	{
		
		$defaultPath = $this->getRequest()->getRequest();	
		$path =[];

		if ($controllerName) {
			$path['c'] = $controllerName;
		}

		if ($actionName) {
			$path['a'] = $actionName;
		}

		if (is_array($data)) {
			foreach ($data as $key => $value) {
				if ($value) {
					$path[$key] = $value;
				}
			}
		}
		else{
			foreach ($defaultPath as $key => $value) {
				if ($key != 'c' && $key != 'a' ) {
					unset($defaultPath[$key]);
				}
			}
		}

		$finalElements = array_merge($defaultPath, $path);
		$finalPath = 'index.php?'. http_build_query($finalElements);
		return $finalPath;
		
	}

}

?>