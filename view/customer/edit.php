<?php $customer = $this->getCustomer();	?>
<?php $billingAddress = $customer->getBillingAddresses();?>
<?php $shippingAddress = $customer->getShippingAddresses();?>

<form method="Post" action="<?php echo $this->getUrl('save', null, ['id' => $customer->customerId], true)?>">
	<table border="1" width="100%" cellspacing="4">
		
		<tr>
			<td colspan="2"><b>Personal Information</b></td>
		</tr>

		<tr>
			<td width="10%">First Name</td>
			<td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName ?>"></td>
		</tr>

		<tr>
			<td width="10%">Last Name</td>
			<td><input type="text" name="customer[lastName]" value="<?php echo $customer->lastName ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Email</td>
			<td><input type="text" name="customer[email]" value="<?php echo $customer->email ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Mobile</td>
			<td><input type="text" name="customer[mobile]" value="<?php echo $customer->mobile ?>"></td>
		</tr>
		
		<tr>
			<td>Status</td>
			<td width="10%">
				<select name="customer[status]">
				<?php foreach ($customer->getStatus() as $key => $value):?>
					<option value="<?php echo $key ?>" <?php if($customer->status == $key){?> selected <?php }?>> <?php echo $value ?> </option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>

		<tr>
			<td colspan="2"><b>Billing Address</b></td>
		</tr>

		<tr>
			<td width="10%">Address</td>
			<td><input type="text" name="billingAddress[address]" value="<?php echo $billingAddress->address ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Postal Code</td>
			<td><input type="text" name="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode ?>"></td>
		</tr>

		<tr>
			<td width="10%">City</td>
			<td><input type="text" name="billingAddress[city]" value="<?php echo $billingAddress->city ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">State</td>
			<td><input type="text" name="billingAddress[state]" value="<?php echo $billingAddress->state ?>"></td>
		</tr>

		<tr>
			<td width="10%">Country</td>
			<td><input type="text" name="billingAddress[country]" value="<?php echo $billingAddress->country ?>"></td>
		</tr>

		<tr>
			<td colspan="2"><b>Shipping Address</b></td>
		</tr>

		<tr>
			<td width="10%">Address</td>
			<td><input type="text" name="shippingAddress[address]" value="<?php echo $shippingAddress->address ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Postal Code</td>
			<td><input type="text" name="shippingAddress[postalCode]" value="<?php echo $shippingAddress->postalCode ?>"></td>
		</tr>

		<tr>
			<td width="10%">City</td>
			<td><input type="text" name="shippingAddress[city]" value="<?php echo $shippingAddress->city ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">State</td>
			<td><input type="text" name="shippingAddress[state]" value="<?php echo $shippingAddress->state ?>"></td>
		</tr>

		<tr>
			<td width="10%">Country</td>
			<td><input type="text" name="shippingAddress[country]" value="<?php echo $shippingAddress->country ?>"></td>
		</tr>

		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="Save">
				<button type="button"><a href="<?php echo $this->getUrl(null, null, null, true)?>">Cancel</a></button> 
			</td>
		</tr>
		

	</table>
</form>