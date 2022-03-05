<?php
Ccc::loadClass('Block_Core_Template');
class Block_Config_Edit extends Block_Core_Template
{
	protected $config = null;

	public function __construct()
	{
		$this->setTemplate('view/config/edit.php');
	}

	public function getConfig()
	{
		return $this->config;
	}

	public function setConfig($config)
	{
		$this->config = $config;
		return $this;
	}

}