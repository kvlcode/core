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
			$this->setMessage(Ccc::getModel('Admin_Message'));
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
		echo $this->getResponse()
				->setHeader('Content-type', 'text/html')
				->render($this->getLayout()->toHtml());
	}

	public function redirect($url)
	{
		header("Location: $url");
		exit();
	}

	public function getResponse()
	{
		return Ccc::getFront()->getResponse();
	}

	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
	}

	public function setTitle($title)	
	{
		$this->getLayout()->getHead()->setTitle($title);
	}

	public function authentication()
    {
        $loginModel = Ccc::getModel("Admin_Login");
        $request = $this->getRequest();
        if($request->getRequest('c') == 'admin_login'){
            $this->redirect();
        }
        if(!$loginModel->getLogin()){
            $this->redirect($this->getLayout()->getUrl('login','admin_login'));
        }
        return true;
    }
}

?>