<?php 
class Model_Core_Session {

	public function __construct()
	{
		$this->start();
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
		$_SESSION[$key] = $value;
		return $this;		
	}

	public function __get($key)
	{
		if (!$this->isStarted()) {
			return null;
		}
		if (!array_key_exists($key, $_SESSION)) {
			return null;
		}
		return $_SESSION[$key];	
	}

	public function __unset($key)
	{	
		if (!$this->isStarted()) {
			return $this;
		}
		if (array_key_exists($key, $_SESSION)) {
			unset($_SESSION[$key]);

		}
		return $this;
	}


}