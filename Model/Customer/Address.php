<?php
Ccc::loadClass('Model_Core_Row');
class Model_Customer_Address extends Model_Core_Row{

	const BILLING = 1;
	const SHIPPING = 1;
	protected $customer = null;

	public function __construct()
	{	
		$this->setResourceClassName('Customer_Address_Resource');
	}


	public function setCustomer($customer)
	{
		$this->customer = $customer;
		return $this;
	}

	public function getCustomer($reload = false)
	{
		$customerModel = Ccc::getModel('Customer');
		if (!$this->customerId) 
		{
			return $customerModel;
		}
		if ($this->customer && !$reload) 
		{
			return $this->customer;
		}
		$customer = $customerModel->fetchRow("SELECT * FROM `customer` 
											WHERE `customerId` = {$this->customerId}");
		if (!$customer) 
		{
			return $customerModel;
		}
		$this->setCustomer($customer);
		return $customer;
	}

}