<?php Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Customer_Address');
class Controller_Cart extends Controller_Core_Action{

	public function gridAction()
	{
		$this->setTitle('Cart');
		$cartGrid = Ccc::getBlock('Cart_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($cartGrid);
		$this->renderLayout();
	}

	public function editAction()
	{
		$this->setTitle('Cart');
    	$cartModel = Ccc::getModel('Cart');
		$cartEdit = Ccc::getBlock('Cart_Edit')->setCart($cartModel);
		$content = $this->getLayout()->getContent();
		$content->addChild($cartEdit);
		$this->renderLayout();
	}

	public function getCartAction()
    {
    	try
    	{
	    	$customerId = $this->getRequest()->getRequest('customerId');
	    	$cartModel = Ccc::getModel('Cart');
	    	$cartRow = $cartModel->load($customerId, 'customerId');
	    	if($cartRow)
	    	{
	    		$cartModel->setCart($cartRow->cartId);
	    	}
	    	else
	    	{
	    		$cartModel->customerId = $customerId;
	    		 $result = $cartModel->save();
	    		if(!$result)
		 		{
		 			throw new Exception("System is unable to insert.", 1);	
		 		}
		 		$cartModel->setCart($result->cartId);
	    	}
    		$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));	    	
   		}
   		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));	    	
		}
    }

	public function saveBillingAddressAction()
	{
		try 
		{
    		$customerId = $this->getRequest()->getRequest('customerId');
			$cartModel = Ccc::getModel('Cart');
			$billingAddress = $this->getRequest()->getPost('billingAddress');
			$cartId = $cartModel->getCart()['cartId'];	
			$cartRow = $cartModel->load($cartId);
			$cartBilling = $cartRow->getBillingAddresses();
				
			if($billingAddress['addressBook'])
			{
				$customerModel = Ccc::getModel('Customer')->load($customerId);
				$addressRow = $customerModel->getBillingAddresses();
		 		$addressRow->setData($billingAddress);
		 		unset($addressRow->addressBook);
				$addressRow->customerId = $cartRow->customerId;
				$addressRow->billing = Model_Customer_Address::BILLING;
				$saveBook = $addressRow->save();
				if(!$saveBook)
	 			{
	 			throw new Exception("System is unable to save in addressBook.", 1);	
	 			}
			}

			if($billingAddress['shipping'])
			{
				$cartAddressModel = Ccc::getModel('Cart_Address');
		 		$cartAddressModel->setData($billingAddress);
				$cartAddressModel->cartId = $cartId;
				$cartAddressModel->shipping = Model_Customer_Address::SHIPPING;
				if ($billingAddress['addressBook']) 
				{
		 			unset($cartAddressModel->addressBook);
				}
				$saveShipping = $cartAddressModel->save();
				if(!$saveShipping)
	 			{
	 			throw new Exception("System is unable to save in addressBook.", 1);	
	 			}
			}

			$billingAddressRow = $cartBilling->setData($billingAddress);
		 	unset($billingAddressRow->addressBook);
			$billingAddressRow->cartId = $cartId;
			$billingAddressRow->billing = Model_Customer_Address::BILLING;
			$saveBilling = $billingAddressRow->save();

	 		if(!$saveBilling)
	 		{
	 			throw new Exception("System is unable to save.", 1);	
	 		}
			$this->getMessage()->addMessage('Data Saved.');
    		$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));	    	

		}
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));	    	
		}	
	}

	public function saveShippingAddressAction()
	{
		try 
		{
			$customerId = $this->getRequest()->getRequest('customerId');
			$shippingAddress = $this->getRequest()->getPost('shippingAddress');
			if(!$shippingAddress)
			{
				throw new Exception("Missing Address data in Request ", 1);	
			}
			$cartModel = Ccc::getModel('Cart');
			$cartId = $cartModel->getCart()['cartId'];	
			$cartRow = $cartModel->load($cartId);
			$cartShipping = $cartRow->getShippingAddresses();			
			if($shippingAddress['addressBook'])
			{
				$customerModel = Ccc::getModel('Customer')->load($customerId);
				$addressRow = $customerModel->getShippingAddresses();
		 		$addressRow->setData($shippingAddress);
		 		unset($addressRow->addressBook);
				$addressRow->customerId = $cartRow->customerId;
				$addressRow->shipping = Model_Customer_Address::SHIPPING;

				$save = $addressRow->save();
				if(!$save)
	 			{
	 			throw new Exception("System is unable to save in addressBook.", 1);	
	 			}
			}

			$shippingAddressRow = $cartShipping->setData($shippingAddress);
			$shippingAddressRow->shipping = Model_Customer_Address::SHIPPING;
			$shippingAddressRow->cartId = $cartId;
		 	unset($shippingAddressRow->addressBook);
			$result = $shippingAddressRow->save();

			if(!$result)
	 		{
	 			throw new Exception("System is unable to insert.", 1);	
	 		}
			$this->getMessage()->addMessage('Data Saved.');
		 	$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));

		}
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));
		}	
	}

	public function addItemAction()
	{
		try
		{
			$items = $this->getRequest()->getPost('product');
			if(!$items)
			{
				throw new Exception("Invalid data", 1);	
			}
			$customerId = $this->getRequest()->getRequest('customerId');
			$productModel = Ccc::getModel('Product');
			$cartModel = Ccc::getModel('Cart');
			$cartId = $cartModel->getCart()['cartId'];
			$itemModel = Ccc::getModel('Cart_Item');
			foreach ($items as $productId => $value) 
			{
				$productRow = $productModel->load($value);
				$itemModel->cartId = $cartId;
				$itemModel->productId = $productRow->productId;
				$itemModel->quantity = $productRow->quantity;
				$itemModel->price = $productRow->price;
				$save = $itemModel->save();
			}

			if(!$save)
			{
				throw new Exception("System can't add ", 1);	
			}
		}
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));
		}
	

		$this->getMessage()->addMessage('Item Added.');
		$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));	

	}
	

	public function savePaymentMethodAction()
	{
		try 
		{
			$paymentId = $this->getRequest()->getPost('paymentMethod');
			$paymentModel = Ccc::getModel('Cart_Payment')->load($paymentId);
			$cartModel = Ccc::getModel('Cart');
			$cartId = $cartModel->getCart()['cartId'];
			$cartModel->cartId = $cartId;
			$cartModel->paymentMethod = $paymentId;
			$paymentId = $cartModel->save();

			if (!$paymentId) 
			{
				throw new Exception("System can't save.", 1);	
			}
			$this->getMessage()->addMessage('Payment method saved.');
		 	$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));
		}
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));
		}	
	}

	public function saveShippingMethodAction()
	{
		try 
		{

			$shippingId = $this->getRequest()->getPost('shippingMethod');
			$shippingModel = Ccc::getModel('cart_shipping')->load($shippingId);
			$cartModel = Ccc::getModel('Cart');
			$cartId = $cartModel->getCart()['cartId'];
			$cartModel->cartId = $cartId;
			$cartModel->shippingMethod = $shippingId;
			$cartModel->deliveryCharge = $shippingModel->amount;
			$save = $cartModel->save();

			if(!$save)
			{
				throw new Exception("System can't save ", 1);	
			}
			$this->getMessage()->addMessage('Shipping method saved.');
		 	$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));
		}
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));
		}	
	}

	public function removeItemAction()
	{
		$customerId = $this->getRequest()->getRequest('customerId');
		$items = $this->getRequest()->getPost('item');
		$itemModel = Ccc::getModel('Cart_Item');
		foreach ($items as $key => $itemId) 
		{
			if ($key == 'quantity') 
			{
				foreach ($itemId as $index => $quantity) 
				{
					$itemModel->itemId = $index;
					$itemModel->quantity = $quantity;
					$itemModel->save();
				}
			}
			else
			{
				$itemModel->delete($itemId);
			}
		}
		$this->redirect($this->getLayout()->getUrl('edit', 'cart', ['customerId' => $customerId]));
	}




	public function saveOrderAction()
	{
		$cartModel = Ccc::getModel('Cart');
		$cartId = $cartModel->getCart()['cartId'];
		$cartRow = $cartModel->load($cartId);
		$customerRow = $cartRow->getCustomer();
		$shippingMethod = $cartRow->getShippingMethod();

		$orderModel = Ccc::getModel('Order');
		$orderModel->customerId = $customerRow->customerId;
		$orderModel->firstName = $customerRow->firstName;
		$orderModel->lastName = $customerRow->lastName;
		$orderModel->mobile = $customerRow->mobile;
		$orderModel->email = $customerRow->email;
		$orderModel->shippingId = $shippingMethod->shippingId;
		$orderModel->shippingAmount = $shippingMethod->amount;
		$orderModel->createdDate = date('Y-m-d H:i:s');
		$orderModel->paymentId = $cartRow->paymentMethod;
		$orderModel->state = Model_Order::STATE_ENABLED;
		$orderModel->grandTotal = $this->getRequest()->getPost('total');
		$orderModel->status = Model_Order::STATUS_ENABLED;
		$saveRow = $orderModel->save();
		if(!$saveRow)
		{
			throw new Exception("System can't save ", 1);	
		}
		return $saveRow;
	
	}

	public function saveOrderAddressAction($orderRow)
	{
		$orderAddressModel = Ccc::getModel('Order_Address');
		$billingRow = $orderRow->getCustomer()->getCart()->getShippingAddresses();
		$shippingRow = $orderRow->getCustomer()->getCart()->getBillingAddresses();

		$orderAddressModel->orderId = $orderRow->orderId;
		$orderAddressModel->firstName = $orderRow->firstName;
		$orderAddressModel->lastName = $orderRow->lastName;
		$orderAddressModel->mobile = $orderRow->mobile;
		$orderAddressModel->email = $orderRow->email;


		if ($billingRow->addressId)
		{
			$orderAddressModel->address = $billingRow->address;
			$orderAddressModel->postalCode = $billingRow->postalCode;
			$orderAddressModel->city = $billingRow->city;
			$orderAddressModel->state = $billingRow->state;
			$orderAddressModel->country = $billingRow->country;
			$orderAddressModel->type = 1;
			$orderAddressModel->createdDate = date('Y-m-d H:i:s');
			$save = $orderAddressModel->save();
		}
		
		if ($shippingRow->addressId) 
		{
			$orderAddressModel->address = $shippingRow->address;
			$orderAddressModel->postalCode = $shippingRow->postalCode;
			$orderAddressModel->city = $shippingRow->city;
			$orderAddressModel->state = $shippingRow->state;
			$orderAddressModel->country = $shippingRow->country;
			$orderAddressModel->type = 2;
			$orderAddressModel->createdDate = date('Y-m-d H:i:s');
			$save = $orderAddressModel->save();
		}
		return $save;
	}

	public function saveOrderItemAction($orderRow)
	{
		$items = $orderRow->getCustomer()->getCart()->getItems();
		$orderId = $orderRow->orderId;

		$orderItemModel = Ccc::getModel('Order_Item');
		$orderItemModel->orderId = $orderId;

		foreach ($items as $key => $item) 
		{
		   	$orderItemModel->quantity = $item->quantity;
			$product = $item->getProduct();
		    $orderItemModel->productId = $product->productId;
		    $orderItemModel->name = $product->name;
		    $orderItemModel->sku = $product->sku;
		    $orderItemModel->cost = $product->costPrice;
		    $orderItemModel->price = $product->price;
		    $orderItemModel->discount = $product->discount;
		    $orderItemModel->taxPercentage = $product->tax;
		    $orderItemModel->taxAmount = $product->taxAmount;
		    $orderItemModel->createdDate = date('Y-m-d H:i:s');
		    $save = $orderItemModel->save();
		}
		return $save;
		
	}

	public function saveAction()
	{
		try 
		{
			$orderRow = $this->saveOrderAction();
			$addressRow = $this->saveOrderAddressAction($orderRow);
			$this->saveOrderItemAction($orderRow);
		 	$this->redirect($this->getLayout()->getUrl('grid','cart'));
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('grid','cart'));
		}
	}
}