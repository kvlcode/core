<?php
Ccc::loadClass('Block_Core_Template');

class Block_Core_Layout_Header_Message extends Block_Core_Template{

	public function __construct()
	{
		$this->setTemplate('view/core/layout/header/message.php');
	}

	public function getMessages()
	{
		$messages = Ccc::getModel('Core_Message')->getMessages();
		return $messages;
	}

	public function unsetMessages()
	{
		Ccc::getModel('Core_Message')->unsetMessages();
	}

}