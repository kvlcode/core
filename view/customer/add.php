<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Customer Add</title>
</head>
<body>

	<form action="<?php echo $this->getUrl('customer','save')?>" method="post">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"><b>Personal Information</b></td>
			</tr>
			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="customer[firstName]"></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="customer[lastName]"></td>
			</tr>

			<tr>
				<td width="10%">Email</td>
				<td><input type="text" name="customer[email]"></td>
			</tr>
			<tr>
				<td width="10%">Mobile</td>
				<td><input type="text" name="customer[mobile]"></td>
			</tr>
			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="customer[status]">
						<option value="1" selected>Active</option>
						<option value="2">Inactive</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td colspan="2"><b>Address Information</b></td>
			</tr>
			<tr>
				<td width="10%">Address</td>
				<td><input type="text" name="address[address]"></td>
			</tr>
			
			<tr>
			<tr>
				<td width="10%">Postal Code</td>
				<td><input type="text" name="address[postalCode]"></td>
			</tr>
				<td width="10%">City</td>
				<td><input type="text" name="address[city]"></td>
			</tr>
			<tr>
				<td width="10%">State</td>
				<td><input type="text" name="address[state]"></td>
			</tr>
			<tr>
				<td width="10%">Country</td>
				<td><input type="text" name="address[country]"></td>
			</tr>

			<tr>
				<td width="10%">Address Type</td>
				<td>
					<input type="checkbox" name="address[billing]" value="1">Billing
					<input type="checkbox" name="address[shipping]" value="1">Shipping 
				</td>
			</tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="<?php echo $this->getUrl('customer','grid')?>"style ="text-decoration: none;" >Cancel</a></button> 
				</td>
			</tr>
		</table>
	</form>
</body>
</html>