<?php $customer = $this->getCustomer();	?>

	<form method="Post" action="<?php echo $this->getUrl('save', null, null, true)?>">
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
				<input type="hidden" name="customer[customerId]" value="<?php echo $customer->customerId ?>">
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
				<td colspan="2"><b>Address Information</b></td>
			</tr>
			
			<tr>
				<td width="10%">Address</td>	
				<td><input type="text" name="address[address]" value="<?php echo $customer->address ?>"></td>
			</tr>

			<tr>
				<td width="10%">Postal Code</td>	
				<td><input type="text" name="address[postalCode]" value="<?php echo $customer->postalCode ?>"></td>
			</tr>

			<tr>
				<td width="10%">City</td>	
				<td><input type="text" name="address[city]" value="<?php echo $customer->city ?>"></td>
			</tr>

			<tr>
				<td width="10%">State</td>	
				<td><input type="text" name="address[state]" value="<?php echo $customer->state ?>"></td>
			</tr>

			<tr>
				<td width="10%">Country</td>	
				<td><input type="text" name="address[country]" value="<?php echo $customer->country ?>"></td>
			</tr>

			<tr>
				<td width="10%">Address Type</td>
				<td>
					<?php if($customer->billing==1):?>
					<input type="checkbox" name="address[billing]" value="1" checked>
					<?php else:?>
					<input type="checkbox" name="address[billing]" value="1">
					<?php endif;?>
					<label>Billing</label>	

					<?php if($customer->shipping==1):?>
					<input type="checkbox" name="address[shipping]" value="1" checked>
					<?php else:?>
					<input type="checkbox" name="address[shipping]" value="1">
					<?php endif;?>
					<label>Shipping</label>	

				</td>
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