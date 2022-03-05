<?php 
Ccc::loadClass('Block_Core_Template');
class Block_Salesman_Edit extends Block_Core_Template{

	protected $salesman = null;

	public function __construct()
	{
		$this->setTemplate('view/salesman/edit.php');
	}

	public function getSalesman()
	{
		return $this->salesman;
	}

	public function setSalesman($salesman)
	{
		$this->salesman = $salesman;
		return $this;
	}

}