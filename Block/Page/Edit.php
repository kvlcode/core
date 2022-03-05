<?php
Ccc::loadClass('Block_Core_Template');
class Block_Page_Edit extends Block_Core_Template
{
	protected $page = null;

	public function __construct()
	{
		$this->setTemplate('view/page/edit.php');
	}

	public function getPage()
	{
		return $this->page;
	}

	public function setPage($page)
	{
		$this->page = $page;
		return $this;
	}

}