<?php
Ccc::loadClass('Block_Core_Template');
class Block_Customer_Edit extends Block_Core_Template
{
	protected $customer = null;

	public function __construct()
	{
		$this->setTemplate('view/customer/edit.php');
	}

	public function getCustomer()
	{
		return $this->customer;
	}

	public function setCustomer($customer)
	{
		$this->customer = $customer;
		return $this;
	}
	
}