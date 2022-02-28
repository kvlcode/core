<?php

class Model_Core_View{
	public $template = null;
	public $data = [];

	public function getTemplate()
	{
		return $this->template;
	}

	public function setTemplate($template)
	{
		$this->template = $template;
		return $this;
	}

	public function toHtml()
	{
		require($this->getTemplate());    //View load here
	}

	public function getData($key = null)
	{
		if(!$key) {
				return $this->data;	
		}
		if(array_key_exists($key, $this->data)) {
			return $this->data[$key];	
		}
		return null;
	}
	
	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	public function addData($key, $value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function removeData($key)
	{
		if (array_key_exists($key, $this->data)) {
			unset($this->data[$key]);	
		}
		return $this;
	}

	public function getUrl($actionName = null, $controllerName = null, array $data = null, $reset = true)
	{
		
		$defaultPath = Ccc::getFront()->getRequest()->getRequest();	
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
		else
		{
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

	// public function getSubUrl()
	// {
	// 	$url1 = "http://localhost/Cybercom/core";
	// 	$url = $this->getUrl();
	// 	$url = $url1.'/'.$url;
	// 	return $url;
		
	// }

}

?>