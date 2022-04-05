<?php 	$order =  $this->getOrder();
		$billingAddress = $order->getBillingAddresses();
		$shippingAddress = $order->getShippingAddresses();
		$paymentMethod = $order->getPaymentMethod();
		$shippingMethod = $order->getShippingMethod();
		$items = $order->getItems();
?>

<table class="table table-bordered table-striped">
	<tr>
		<td>	
			<table border="1" width="100%" cellspacing="4">	
				<tr>
					<td><b>Billing Address</b></td>
					<td>
						<?php echo $billingAddress->address ?>,
						<?php echo $billingAddress->city ?>,
						<?php echo $billingAddress->state ?>,
						<?php echo $billingAddress->postalCode ?>,
						<?php echo $billingAddress->country ?>.
					</td>
				</tr>
			</table>
		</td>

		<td>	
			<table class="table table-bordered table-striped">	
				<tr>
					<td><b>Shipping Address</b></td>
					<td>
						<?php echo $shippingAddress->address ?>,
						<?php echo $shippingAddress->city ?>,
						<?php echo $shippingAddress->state ?>,
						<?php echo $shippingAddress->postalCode ?>,
						<?php echo $shippingAddress->country ?>.
					</td>
				</tr>
			</table>
		</td>
	</tr>			

	<tr>
		<td>
			<table class="table table-bordered table-striped">	
				<tr>
					<td><b>Payment Method</b></td>
					<td><?php echo $paymentMethod->name?></td>
				</tr>
			</table>
		</td>

		<td>
			<table class="table table-bordered table-striped">
				<tr>
					<td><b>Shipping Method</b></td>
					<td><?php echo $shippingMethod->name;?>:<?php echo $shippingMethod->amount?>$</td>

				</tr>
			</table>
		</td>
	</tr>
</table>
		
<table class="table table-bordered table-striped">
	<tr>
        <th>Quantity</th>
        <th>Price</th>
        <th>Row Total</th>
    </tr>

    <?php if(!$items):?>
        <tr>
            <td colspan="10">No record Available</td>
        </tr>   
    <?php else:?>
    	<?php foreach ($items as $item):?>
            <tr>
                <td><?php echo $item->quantity ?></td>
                <td><?php echo $item->price ?></td>
                <td><?php echo $rowTotal = ($item->price)*($item->quantity);?></td>
            </tr>
    	<?php endforeach;?>
	<?php endif; ?> 
</table>

<table class="table table-bordered table-striped">
	<tr>
		<td>Sub Total:</td>
		<td><?php echo $this->getSubTotal();?></td>
	</tr>

	<tr>
		<td>Shipping Charge:</td>
		<td><?php echo $order->shippingAmount; ?></td>
	</tr>

	<tr>
		<td>Tax:</td>
		<td><?php echo $this->getTax();?></</td>
	</tr>

	<tr>
		<td>Discount:</td>
		<td><?php echo $this->getDiscount();?></td>
	</tr>

	<tr>
		<td>Grand Total:</td>
		<td><?php echo $order->grandTotal;?></td>
	</tr>	
</table>
