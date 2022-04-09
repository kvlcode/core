<?php
Ccc::loadClass('Model_Core_Row');
class Model_Customer extends Model_Core_Row{

	protected $billingAddresses = null;
	protected $shippingAddresses = null;

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DISABLED_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';
	protected $billingAddress = null;
	protected $shippingAddress = null;
	protected $salesman = null;

	public function __construct()
	{	
		$this->setResourceClassName('Customer_Resource');
	}

	public function getStatus($key = NULL)
	{
		$status = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
		];
		if(!$key){
			return $status;
		}
		if(array_key_exists($key, $status)){
			return $status[$key];
		}
		return self::STATUS_DISABLED_DEFAULT;
	}

	public function setBillingAddresses($billingAddress)
	{
		$this->billingAddress = $billingAddress;
		return $this;
	}

	public function getBillingAddresses($reload = false)
	{
		$addressModel = Ccc::getModel('Customer_Address');
		if (!$this->customerId) 
		{
			return $addressModel;
		}
		if ($this->billingAddress && !$reload) 
		{
			return $this->billingAddress;
		}
		$address = $addressModel->fetchRow("SELECT * FROM `customer_address` 
											WHERE `customerId` = {$this->customerId} AND `billing` = 1");
		if (!$address) 
		{
			return $addressModel;
		}
		$this->setBillingAddresses($address);
		return $address;
	}

	public function setShippingAddresses($shippingAddress)
	{
		$this->shippingAddress = $shippingAddress;
		return $this;
	}
	
	public function getShippingAddresses($reload = false)
	{
		$addressModel = Ccc::getModel('Customer_Address');
		if (!$this->customerId) 
		{
			return $addressModel;
		}
		if ($this->shippingAddress && !$reload) 
		{
			return $this->shippingAddress;
		}
		$address = $addressModel->fetchRow("SELECT * FROM `customer_address` 
											WHERE `customerId` = {$this->customerId} AND `shipping` = 1");
		if (!$address) 
		{
			return $addressModel;
		}
		$this->setShippingAddresses($address);
		return $address;
	}



	public function setSalesman($salesman)
	{
		$this->salesman = $salesman;
		return $this;
	}

	public function getSalesman($reload = false)
	{
		$salesmanModel = Ccc::getModel('Salesman');
		if (!$this->customerId) 
		{
			return $salesmanModel;
		}
		if ($this->salesman && !$reload) 
		{
			return $this->salesman;
		}
		$salesman = $salesmanModel->fetchRow("SELECT * FROM `salesman` 
											WHERE `salesmanId` = {$this->salesmanId}");
		if (!$salesman) 
		{
			return $salesmanModel;
		}
		$this->setSalesman($salesman);
		return $salesman;
	}

  public function setCart($cart)
	{
		$this->cart = $cart;
		return $this;
	}

	public function getCart($reload = false)
	{
		$cartModel = Ccc::getModel('Cart');
		if (!$this->customerId) 
		{
			return $cartModel;
		}
		if ($this->cart && !$reload) 
		{
			return $this->cart;
		}
		$cart = $cartModel->fetchRow("SELECT * FROM `cart` 
											WHERE `customerId` = {$this->customerId}");
		if (!$cart) 
		{
			return $cartModel;
		}
		$this->setCart($cart);
		return $cart;
	}

}