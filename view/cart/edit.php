<?php $cartItems = $this->getCartItems();?>
<?php $products = $this->getProducts();?>
<?php $customers = $this->getCustomers();?>
<?php $customerId = Ccc::getFront()->getRequest()->getRequest('customerId');?>
<?php $shippings = $this->getShipping();?>
<?php $cartShippingMethod = $this->getCartShippingMethod();?>
<?php $payments = $this->getPayment();?>
<?php
	// $cartId = $this->getCart()->getCart();
	$cartId = $this->getCart()->getCart()['cartId'];
	$cartModel = $this->getCart();
	$cartModel->cartId = $cartId;
 	$billingAddress = $cartModel->getBillingAddresses();
 	$shippingAddress = $cartModel->getShippingAddresses();
?>

<select id="customerId" name="customer[customerId]" onchange="customer()">
	<option>Select Customer</option>
	<?php foreach($customers as $customer): ?>
		<option value="<?php echo $customer->customerId;?>"><?php echo $customer->customerId.'=>'.$customer->firstName; ?></option>
	<?php endforeach;?>
</select>

<table border="1" width="100%" cellspacing="4">
	<tr>
		<td>	
			<form method="Post" action="<?php echo $this->getUrl('saveBillingAddress')?>">
				<table border="1" width="100%" cellspacing="4">	
					<tr>
						<td colspan="2"><b>Billing Address</b></td>
					</tr>

					<tr>
						<td width="50%">Address</td>
						<td><input type="text" name="billingAddress[address]" value="<?php echo $billingAddress->address ?>"></td>
					</tr>
					
					<tr>
						<td width="50%">Postal Code</td>
						<td><input type="text" name="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode ?>"></td>
					</tr>

					<tr>
						<td width="50%">City</td>
						<td><input type="text" name="billingAddress[city]" value="<?php echo $billingAddress->city ?>"></td>
					</tr>
					
					<tr>
						<td width="50%">State</td>
						<td><input type="text" name="billingAddress[state]" value="<?php echo $billingAddress->state ?>"></td>
					</tr>

					<tr>
						<td width="50%">Country</td>
						<td><input type="text" name="billingAddress[country]" value="<?php echo $billingAddress->country ?>"></td>
					</tr>

					<tr>
						<td width="50%"><input type="checkbox" name="billingAddress[addressBook]"></td>
						<td><p>Save To Address Book</p></td>
					</tr>

					<tr>
						<td width="50%"><input type="checkbox" name="billingAddress[shipping]" value="shipping" id="mark" onchange="shipping()"></td>
						<td><p>Mark as Shipping</p></td>
					</tr>
					<tr>
						<td width="50%">&nbsp;</td>
						<td>
							<input type="submit" name="save" value="Save">
						</td>
					</tr>
				</table>
			</form>
		</td>

		<td id="shipping">	
			<form method="Post" action="<?php echo $this->getUrl('saveShippingAddress')?>">

				<table border="1" width="100%" cellspacing="4">
					
					<tr>
						<td colspan="2"><b>Shipping Address</b></td>
					</tr>

					<tr>
						<td width="50%">Address</td>
						<td><input type="text" name="shippingAddress[address]" value="<?php echo $shippingAddress->address ?>"></td>
					</tr>
					
					<tr>
						<td width="50%">Postal Code</td>
						<td><input type="text" name="shippingAddress[postalCode]" value="<?php echo $shippingAddress->postalCode ?>"></td>
					</tr>

					<tr>
						<td width="50%">City</td>
						<td><input type="text" name="shippingAddress[city]" value="<?php echo $shippingAddress->city ?>"></td>
					</tr>
					
					<tr>
						<td width="50%">State</td>
						<td><input type="text" name="shippingAddress[state]" value="<?php echo $shippingAddress->state ?>"></td>
					</tr>

					<tr>
						<td width="50%">Country</td>
						<td><input type="text" name="shippingAddress[country]" value="<?php echo $shippingAddress->country ?>"></td>
					</tr>
					
					<tr>
						<td width="50%"><input type="checkbox" name="shippingAddress[addressBook]"></td>
						<td><p>Save To Address Book</p></td>
					</tr>
					
					<tr>
						<td width="50%">&nbsp;</td>
						<td>
							<input type="submit" name="save" value="Save">
						</td>
					</tr>
				</table>
			</form>	
		</td>
	</tr>			

	<tr>
		<td>
			<form method="Post" action="<?php echo $this->getUrl('savePaymentMethod')?>">
				<table border="1" width="100%" cellspacing="4">	
					<tr>
						<td colspan="2"><b>Payment Method</b></td>
					</tr>

					<?php foreach ($cartShippingMethod as $cartPaymentId):?>
	 						<?php $cartPaymentId = $cartPaymentId->paymentMethod; ?>
	 				<?php endforeach; ?>
					<?php foreach ($payments as $payment): ?>		
						<tr>
							<td><input type="radio" name="paymentMethod" <?php if($cartPaymentId == $payment->paymentId){echo('checked');} ?> value="<?php echo $payment->paymentId;?>"></td>
							<td><?php echo $payment->name;?></td>
						</tr>
					<?php endforeach ?>

					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="submit" name="update" value="Update">
						</td>
					</tr>
				</table>
			</form>	
		</td>

		<td>
			<form method="Post" action="<?php echo $this->getUrl('saveShippingMethod')?>">
				<table border="1" width="100%" cellspacing="4">
					<tr>
						<td colspan="2"><b>Shipping Method</b></td>
					</tr>
					<?php foreach ($cartShippingMethod as $cartShippingId):?>
	 					<?php $cartShippingId = $cartShippingId->shippingMethod; ?>
	 				<?php endforeach; ?>
					<?php foreach ($shippings as $shipping):?>	
						<tr>
							<td><input type="radio" name="shippingMethod" <?php if($cartShippingId == $shipping->shippingId){echo('checked');} ?> value="<?php echo $shipping->shippingId;?>">
							</td>
							<td><?php echo $shipping->name;?> : <?php echo $shipping->amount;?></td>
						</tr>
					<?php endforeach ?>

						<td>&nbsp;</td>
						<td>
							<input type="submit" name="update" value="Update">
						</td>
					</tr>
				</table>
			</form>	
		</td>
	</tr>

	<tr id="addItem" style="display: none;">
		<td>
			<form method="Post" action="<?php echo $this->getUrl('addItem')?>">
				<table border="1" width="100%" cellspacing="4">
					<tr>
						<td><input type="button" name="cancel" value="CANCEL" onclick="hideTable()"></td>
						<td><input type="submit" name="save" value="ADD SELECTED ITEM"></td>
					</tr>
					<tr>
				        <th>Image</th>
				        <th>Quantity</th>
				        <th>Price</th>
				        <th>Row Total</th>
				        <th>Action</th>
				    </tr>

				    <?php if(!$products):?>
				        <tr>
				            <td colspan="10">No record Available</td>
				        </tr>   
				    <?php else:?>
				        <?php foreach ($products as $product): ?>
				            <tr>
				                <td><img src="<?php echo $product->getBase()->getImageUrl();?>" width = "50px" height = "50px" alt = "Image not found"></td>
				                <td><input type="text" name="produc[quantity][]" value="<?php echo $product->quantity ?>"></td>
				                <td><?php echo $product->price ?></td>
				                <td><?php echo ($product->price)*($product->quantity);?></td>
				                <td><input type="checkbox" name="product[<?php echo $product->productId ?>]" value="<?php echo $product->productId ?>"></td>
				            </tr>    
				        <?php endforeach; ?>
				    <?php endif; ?> 
				</table>
			</form>
		</td>
	</tr>

	<tr>
		<td>
			<form method="Post" action="<?php echo $this->getUrl('removeItem')?>">
				<table border="1" width="100%" cellspacing="4">
					<tr>
						<td><input type="submit" name="save" value="UPDATE"></td>
						<td><input type="button" name="save" value="NEW ITEM" onclick="showTable()"></td>
					</tr>
					<tr>
				        <th>Image</th>
				        <th>Quantity</th>
				        <th>Price</th>
				        <th>Row Total</th>
				        <th>Action</th>
				    </tr>

				    <?php if(!$cartItems):?>
				        <tr>
				            <td colspan="10">No record Available</td>
				        </tr>   
				    <?php else:?>
				    <?php $subTotal = 0;?>    
				    <?php $finalDiscount = 0;?>    
				    <?php $totalTax = 0;?>    
				        <?php foreach ($products as $product):?>
				        	<?php foreach ($cartItems as $item):?>
					        	<?php if($product->productId == $item->productId): ?>
						            <tr>
						                <td><img src="<?php echo $product->getBase()->getImageUrl();?>" width = "50px" height = "50px" alt = "Image not found"></td>
						                <td><input type="text" name="item[quantity][<?php echo $item->itemId ?>]" value="<?php echo $item->quantity ?>"></td>
						                <td><?php echo $product->price ?></td>
						                <td><?php echo $rowTotal = ($product->price)*($product->quantity);?></td>
						                <?php $finalDiscount = $this->getDiscount($product->productId, $rowTotal) + $finalDiscount;?>
						                <?php $totalTax = $this->getTax($product->productId, $rowTotal) + $totalTax;?>
						                <td><input type="checkbox" name="item[<?php echo $item->itemId ?>]" value="<?php echo $item->itemId ?>"></td>
						           		<?php $subTotal = $rowTotal + $subTotal; ?>	
						            </tr>
						        <?php endif;?>
				        	<?php endforeach;?>
				        <?php endforeach; ?>
					<?php endif; ?> 
				</table>
			</form>
		</td>
	</tr>
</table>

<form method="Post" action="<?php echo $this->getUrl('save')?>">
	<table border="1" cellspacing="4">
		<tr>
			<td>Sub Total:</td>
			<td><?php echo $subTotal;?></td>
		</tr>

		<?php foreach ($cartShippingMethod as $charge): ?>
		<tr>
			<td>Shipping Charge:</td>
			<td><?php echo $deliveryCharge = $charge->deliveryCharge ?></td>
		</tr>
		<?php endforeach; ?>

		<tr>
			<td>Tax:</td>
			<td><?php echo $totalTax;?></</td>
		</tr>

		<tr>
			<td>Discount:</td>
			<td><?php echo $finalDiscount;?></td>
		</tr>

		<tr>
			<td>Grand Total:</td>
			<td><?php echo $grandTotal = $subTotal + $deliveryCharge + $totalTax - $finalDiscount;?></td>
			<input type="hidden" name="total" value="<?php echo $grandTotal ?>">
		</tr>	
		<tr><td><input type="submit" name="Save" value="Place Order"></td></tr>

	</table>
</form>

<script>

	function shipping() {
		if(document.getElementById('mark').checked) {
           document.getElementById('shipping').style.display = "none";
		}
		else{
           document.getElementById('shipping').style.display = "block";
		}	
	}


	function customer() 
	{
		var customerId = document.getElementById('customerId').value;
		var url = new URL(window.location.href);
		var search_parameter = url.searchParams;
		search_parameter.set('customerId', customerId);
		search_parameter.set('a', 'getCart');
		url.search = search_parameter.toString();
		var newUrl = url.toString();
		window.location = newUrl; 
	}

	function showTable()
	{
		document.getElementById('addItem').style.display = "block";
	}
	function hideTable()
	{
		document.getElementById('addItem').style.display = "none";
	}


</script>