<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Admin_Login extends Controller_Core_Action{
	public function loginAction()
	{
		$content = $this->getLayout()->getContent();
		$adminLoginGrid = Ccc::getBlock('Admin_Login');
		$content->addChild($adminLoginGrid);
		$this->renderLayout();
	}

	public function loginPostAction()
	{
		try {

			$login = $this->getRequest()->getPost('login');
			$adminLogin = Ccc::getModel('Admin');

			if (!$login) {
				$this->getMessage()->addMessage('Invalid login data.', Model_Admin_Message::ERROR);
				throw new Exception("Invalid request", 1);
			}
			
			$email = $login['email'];
			$password = md5($login['password']);

			if ($email == NULL || $password == NULL) {
			
				$this->getMessage()->addMessage('Invalid request.', Model_Admin_Message::ERROR);
				throw new Exception("Invalid request", 1);
			}
			
			$adminLogin->login($email, $password);
			$adminLoginMessage = Ccc::getModel('Admin_Message');
			$adminLoginMessage->login = $adminLogin;

			if ($adminLoginMessage->login == 1) {
				$this->redirect($this->getLayout()->getUrl('grid','Product'));
			}
		
			
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));			

		} catch (Exception $e) {
			
			$this->redirect($this->getView()->getUrl('login', 'admin_login'));
		}
	}
		
	public function logoutAction()
	{
		$logout = Ccc::getModel('Admin');
		$logout = $logout->logout();
		$this->redirect($this->getLayout()->getUrl('login','admin_login'));
	}
}

