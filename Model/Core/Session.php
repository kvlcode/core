<?php 
class Model_Core_Session {

	protected $namespace = null;

	public function __construct()
	{
		$this->setNamespace('core');
		$this->start();
	}

	public function setNamespace($namespace)
	{
		$this->namespace = $namespace;
		return $this;
	}

	public function getNamespace()
	{
		return $this->namespace; 
	}

	public function start()
	{
		if (!$this->isStarted()) {
			session_start();
		}
		return $this;
	}

	public function isStarted()
	{
		if ($this->getId()) {
			return true;
		}
		return false;
	}

	public function destroy()
	{
		if ($this->isStarted()) {
			session_destroy();
		}
		return $this;
	}

	public function getId($id = null)
	{
		if ($id != null) {
			return session_id($id);	
		}
		return session_id();

	}

	public function regenerateId()
	{
		if (!$this->isStarted()) {
			$this->start();
		}
		return session_regenerate_id();
	}

	public function __set($key, $value)
	{
		if (!$this->isStarted()) {
			$this->start();
		}
		$_SESSION[$this->getNamespace()][$key] = $value;
		return $this;		
	}

	public function __get($key)
	{
		if (!$this->isStarted()) {
			return null;
		}
		if (!array_key_exists($key, $_SESSION[$this->getNamespace()])) {
			 $_SESSION[$this->getNamespace()][$key] = [];
		}
		if (array_key_exists($key, $_SESSION[$this->getNamespace()])) {
			return $_SESSION[$this->getNamespace()][$key];
		}
		return null;
			
	}

	public function __unset($key)
	{	
		if (!$this->isStarted()) {
			return $this;
		}
		if (array_key_exists($key, $_SESSION[$this->getNamespace()])) {
			unset($_SESSION[$this->getNamespace()][$key]);
		}
		return $this;
	}


}