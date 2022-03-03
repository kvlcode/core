<?php $vendor = $this->getVendor();?>

	<form method="Post" action="<?php echo $this->getUrl('save', null, null, true)?>">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Vendor Information</b></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="vendor[firstName]" value="<?php echo $vendor->firstName ?>"></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="vendor[lastName]" value="<?php echo $vendor->lastName ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Email</td>
				<td><input type="text" name="vendor[email]" value="<?php echo $vendor->email ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Mobile</td>
				<td><input type="text" name="vendor[mobile]" value="<?php echo $vendor->mobile ?>"></td>
				<input type="hidden" name="vendor[vendorId]" value="<?php echo $vendor->vendorId ?>">
			</tr>
			
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="vendor[status]">
					<?php foreach ($vendor->getStatus() as $key => $value):?>
						<option value="<?php echo $key ?>" <?php if($vendor->status == $key){?> selected <?php }?>> <?php echo $value ?> </option>
					<?php endforeach;?>
					</select>
				</td>
			</tr>

			<tr>
				<td colspan="2"><b>Vendor Address Information</b></td>
			</tr>
			
			<tr>
				<td width="10%">Address</td>	
				<td><input type="text" name="address[address]" value="<?php echo $vendor->address ?>"></td>
			</tr>

			<tr>
				<td width="10%">Postal Code</td>	
				<td><input type="text" name="address[postalCode]" value="<?php echo $vendor->postalCode ?>"></td>
			</tr>

			<tr>
				<td width="10%">City</td>	
				<td><input type="text" name="address[city]" value="<?php echo $vendor->city ?>"></td>
			</tr>

			<tr>
				<td width="10%">State</td>	
				<td><input type="text" name="address[state]" value="<?php echo $vendor->state ?>"></td>
			</tr>

			<tr>
				<td width="10%">Country</td>	
				<td><input type="text" name="address[country]" value="<?php echo $vendor->country ?>"></td>
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