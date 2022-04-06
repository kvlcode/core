<?php
Ccc::loadClass('Block_Core_Template');
class Block_Cart_Edit extends Block_Core_Template
{
	protected $cart = null;
	
	public function __construct()
	{
		$this->setTemplate('view/cart/edit.php');
	}

	public function getCustomers()
	{
		$customers = Ccc::getModel('Customer')->fetchAll("SELECT `customerId`,`firstName` FROM `customer`");
		return $customers;
	}

	public function getProducts()
	{
		$products = Ccc::getModel('Product')->fetchAll("SELECT * FROM `product`");
		return $products;
	}

	public function getCartItems()
	{
		$cartId = $this->getCart()->getCart()['cartId'];
		$cartItems = Ccc::getModel('Cart_Item')->fetchAll("SELECT * FROM `cart_item` WHERE `cartId` = {$cartId}");
		return $cartItems;
	}

	public function getCart()
	{
		return $this->cart;
	}

	public function setCart($cart)
	{
		$this->cart = $cart;
		return $this;
	}

	public function getShipping()
	{
		$cartShipping = Ccc::getModel('Cart_Shipping')->fetchAll("SELECT * FROM `cart_shipping`");
		return $cartShipping;
	}

	public function getPayment()
	{
		$cartPayment = Ccc::getModel('Cart_Payment')->fetchAll("SELECT * FROM `cart_payment`");
		return $cartPayment;
	}

	public function getDiscount($productId, $rowTotal)
	{
		$productModel = Ccc::getModel('Product')->load($productId);
		$discountPrice = $rowTotal * $productModel->discount / 100;
		return $discountPrice;	
	}

	public function getTax($productId, $rowTotal)
	{
		$productModel = Ccc::getModel('Product')->load($productId);
		$taxPrice = $rowTotal * $productModel->tax / 100;
		return $taxPrice;	
	}

	public function getCartShippingMethod()
	{
		$cartModel = Ccc::getModel('Cart')->fetchAll("SELECT * FROM `cart` where cartId = {$this->getCart()->getCart()['cartId']}");
		return $cartModel;
	}
}