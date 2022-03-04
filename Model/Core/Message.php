<?php 
class Model_Core_Message{

	const SUCCESS = "success";
	const ERROR = "error";
	const WARNING = "warning";

	protected $session = null; 

	public function setSession($session)
	{
		$this->session = $session;
		return $this;		
	}	

	public function getSession()
	{
		if (!$this->session) {
			$session = Ccc::getModel('Core_Session');
			$this->setSession($session);
		}
		return $this->session;
	}

	public function getMessages()
	{
		return $this->getSession()->messages;
	}

	public function addMessage($message, $type = self::SUCCESS)
	{
		$messages = ($this->getSession()->messages) ? $this->getSession()->messages : [];
		$messages[$type] = $message;
		$this->getSession()->messages = $messages;
		return $this;
	}

	public function unsetMessages()
	{
		unset($this->getSession()->messages);
	}


}