<?php 
Ccc::loadClass('Model_Core_View');
Ccc::loadClass('Block_Core_Layout');

class Controller_Core_Action {

	protected $layout = null;
	protected $view = null;
	protected $message = null;

	public function setMessage($message)
	{
		$this->message = $message;
		return $this;
	}

	public function getMessage()
	{
		if (!$this->message) {
			$this->setMessage(Ccc::getModel('Core_Message'));
		}
		return $this->message;
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		if(!$this->layout) {
			$this->setLayout(new Block_Core_Layout());				
		}
		return $this->layout;
	}

	public function setView($view)
	{
		$this->view = $view;
		return $this;
	}

	public function getView()
	{
		if(!$this->view) {
			$this->setView(new Model_Core_View());				
		}
		return $this->view;
	}

	public function renderLayout()
	{
		$this->getLayout()->toHtml();
		return $this;
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

}

?>