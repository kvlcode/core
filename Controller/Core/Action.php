<?php 

Ccc::loadClass('Model_Core_View');

class Controller_Core_Action {

	protected $view = null;

	// public function getAdapter()
	// {		
	// 	global $adapter;
	// 	return $adapter;
	// }

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

	public function getUrl($actionName = null, $controllerName = null, array $id = null)
	{
		$defaultPath = [
			'a' => $_GET['a'],
			'c' => $_GET['c'],
			'id' => $_GET['id'],
			'tab' => $_GET['menu']
		];

		$path =[
			'a' => $actionName,
			'c' => $controllerName,
			'id' => $id['id'],
			'tab' => $id['tab']
		];
		
		echo "<pre>";
		print_r($path);
		$path2 = [];
		foreach ($path as $key => $value) {
			if ($value != null) {
				print_r($value);
				// $path2[$key] = $value;
			}
			else{
				echo "---------";
				print_r($value);

				// unset($path[$key]);
			}
		}

		$path3 = http_build_query($path2);
		$finalPath = 'index.php?'.$path3;
		print_r($finalPath);
		exit();

		$path3 = array_merge($defaultPath, $path2);

		
		// if($actionName == null)
		// {
		// 	if ($controllerName == null) {
		// 		if ($id['id'] == null && $id['tab'] == null) {
		// 			print_r($defaultpath);
		// 		}
		// 	}
		// 	else
		// 	{			
		// 	}
		// }
		// else
		// {
		// 	if ($controllerName == null) {
		// 		// if ($id['']) {
		// 		// 	// code...
		// 		// }
		// 	}
		// 	else
		// 	{		
		// 	}
		// }
		// $elements =[
		// 	'a'=
		// 	'id' =
		// ]
	}

}

?>