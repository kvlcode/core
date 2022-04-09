<?php 
Ccc::loadClass('Model_Core_Row');
class Model_Order extends Model_Core_Row{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DISABLED_DEFAULT = 2;
	const STATUS_ENABLED_LBL ='Complete';
	const STATUS_DISABLED_LBL = 'Pending..';

	const STATE_ENABLED = 1;
	const STATE_DISABLED = 2;
	const STATE_DISABLED_DEFAULT = 2;
	const STATE_ENABLED_LBL ='Complete';
	const STATE_DISABLED_LBL = 'Pending..';

	protected $customer = null;
	protected $billingAddress = null;
	protected $shippingAddress = null;
	protected $payment = null;
	protected $items = null;

	public function __construct()
	{
		$this->setResourceClassName('Order_Resource');
	}

	public function getStatus($key = null)
	{

		$status =[
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
		];

		if (!$key) {
			return $status;
		}

		if(array_key_exists($key, $status)){
			return $status[$key];
		}
		return self::STATUS_DISABLED_DEFAULT;
	}


	public function getState($key = null)
	{

		$state =[
			self::STATE_ENABLED => self::STATE_ENABLED_LBL,
			self::STATE_DISABLED => self::STATE_DISABLED_LBL
		];

		if (!$key) {
			return $state;
		}

		if(array_key_exists($key, $state)){
			return $state[$key];
		}
		return self::STATE_DISABLED_DEFAULT;
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

	public function setBillingAddresses($billingAddress)
	{
		$this->billingAddress = $billingAddress;
		return $this;
	}

	public function getBillingAddresses($reload = false)
	{
		$addressModel = Ccc::getModel('Order_Address');
		if (!$this->orderId) 
		{
			return $addressModel;
		}
		if ($this->billingAddress && !$reload) 
		{
			return $this->billingAddress;
		}
		$address = $addressModel->fetchRow("SELECT * FROM `order_address` 
											WHERE `orderId` = {$this->orderId} AND `type` = 1");
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
		$addressModel = Ccc::getModel('Order_Address');
		if (!$this->orderId) 
		{
			return $addressModel;
		}
		if ($this->shippingAddress && !$reload) 
		{
			return $this->shippingAddress;
		}
		$address = $addressModel->fetchRow("SELECT * FROM `order_address` 
											WHERE `orderId` = {$this->orderId} AND `type` = 2");
		if (!$address) 
		{
			return $addressModel;
		}
		$this->setShippingAddresses($address);
		return $address;
	}

	public function setPaymentMethod(Model_Cart_Payment $payment)
	{
		$this->payment = $payment;
		return $this;
	}

	public function getPaymentMethod($reload = false)
	{
		$cartPaymentModel = Ccc::getModel('Cart_Payment');
		if (!$this->paymentId) 
		{
			return $cartPaymentModel;
		}
		if ($this->payment && !$reload) 
		{
			return $this->payment;
		}
		$cartPaymentRow = $cartPaymentModel->fetchRow("SELECT * FROM `cart_payment` 
											WHERE `paymentId` = {$this->paymentId}");
		if (!$cartPaymentRow) 
		{
			return $cartPaymentRow;
		}
		$this->setPaymentMethod($cartPaymentRow);
		return $cartPaymentRow;
	}

	public function setShippingMethod(Model_Cart_Shipping $shipping)
	{
		$this->shipping = $shipping;
		return $this;
	}

	public function getShippingMethod($reload = false)
	{
		$cartShippingModel = Ccc::getModel('Cart_Shipping');
		if (!$this->shippingId) 
		{
			return $cartShippingModel;
		}
		if ($this->shipping && !$reload) 
		{
			return $this->shipping;
		}
		$cartShippingRow = $cartShippingModel->fetchRow("SELECT * FROM `cart_shipping` 
											WHERE `shippingId` = {$this->shippingId}");
		if (!$cartShippingRow) 
		{
			return $cartShippingModel;
		}
		$this->setShippingMethod($cartShippingRow);
		return $cartShippingRow;
	}

	public function setItems($items)
	{
		$this->items = $items;
		return $this;
	}

	public function getItems($reload = false)
	{
		$orderItemModel = Ccc::getModel('Order_Item'); 
		if(!$this->orderId)
		{
			return $orderItemModel;
		}

		if($this->items && !$reload)
		{
			return $this->items;
		}

		$orderItem = $orderItemModel->fetchAll("SELECT * FROM `order_item` WHERE `orderId` = {$this->orderId}");

		if(!$orderItem)
		{
			return $orderItemModel;
		}
		$this->setItems($orderItem);
		return $orderItem;
	}


}