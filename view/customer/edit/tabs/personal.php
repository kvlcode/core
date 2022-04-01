<?php $customer = $this->getCustomer();	?>
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
		<td width="10%">&nbsp;</td>
		<td>
			<input type="submit" name="Save" value="Save">
			<button type="button"><a href="<?php echo $this->getUrl(null, null, null, true)?>">Cancel</a></button> 
		</td>
	</tr>

</table>