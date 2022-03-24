<?php Ccc::loadClass('Model_Core_Row');
class Model_Cart extends Model_Core_Row{

	protected $billingAddress = null;
	protected $shippingAddress = null;
	protected $session = null;

	public function __construct()
	{	
		$this->setResourceClassName('Cart_Resource');
	}

	public function getSession()
    {
        if(!$this->session){
            $this->setSession(Ccc::getModel('Core_Session'));
        }
        return $this->session;
    }

	public function setCart($cartId)
    {
        if(!$cartId){
            return $this;
        }
        $cart['cartId'] = $cartId;
        $this->getSession()->cart = $cart;
        return $this->getSession()->cart;
    }

    public function getCart()
    {
        if(!$this->getSession()->cart){
            return null;
        }
        return $this->getSession()->cart;        
    }

	public function setBillingAddresses($billingAddress)
	{
		$this->billingAddress = $billingAddress;
		return $this;
	}

	public function getBillingAddresses($reload = false)
	{
		$addressModel = Ccc::getModel('Cart_Address');
		if (!$this->cartId) 
		{
			return $addressModel;
		}
		if ($this->billingAddress && !$reload) 
		{
			return $this->billingAddress;
		}
		$address = $addressModel->fetchRow("SELECT * FROM `cart_address` 
											WHERE `cartId` = {$this->cartId} AND `billing` = 1");
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
		$addressModel = Ccc::getModel('Cart_Address');
		if (!$this->cartId) 
		{
			return $addressModel;
		}
		if ($this->shippingAddress && !$reload) 
		{
			return $this->shippingAddress;
		}
		$address = $addressModel->fetchRow("SELECT * FROM `cart_address` 
											WHERE `cartId` = {$this->cartId} AND `shipping` = 1");
		if (!$address) 
		{
			return $addressModel;
		}
		$this->setShippingAddresses($address);
		return $address;
	}

	public function setSession($session)
    {
		$this->session = $session;
		return $this->session;
    }
}
