<?php 

$id = $_GET['id'];
global $adapter;

$result = $adapter->fetchAll("SELECT c.*,a.*
	                            FROM customer c
	                            JOIN address a
	                            ON a.customerId = c.customerId
	                            WHERE c.customerId = $id");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Edit</title>
</head>
<body>

	<?php foreach ($result as $row): ?>

	<form method="Post" action="index.php?a=save&c=customer">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Personal Information</b></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="customer[firstName]" value="<?php echo $row['firstName'] ?>"></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="customer[lastName]" value="<?php echo $row['lastName'] ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Email</td>
				<td><input type="text" name="customer[email]" value="<?php echo $row['email'] ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Mobile</td>
				<td><input type="text" name="customer[mobile]" value="<?php echo $row['mobile'] ?>"></td>
				<input type="hidden" name="customer[hiddenId]" value="<?php echo $row['customerId'] ?>">
			</tr>
			
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="customer[status]">
					<?php if ($row['status']==1):?>
						<option value="1" selected>Active</option>
						<option value="2">Inactive</option>
					<?php else:?>
						<option value="1">Active</option>
						<option value="2" selected>Inactive</option>
					<?php endif; ?>	
					</select>
				</td>
			</tr>

			<tr>
				<td colspan="2"><b>Address Information</b></td>
			</tr>
			
			<tr>
				<td width="10%">Address</td>	
				<td><input type="text" name="address[address]" value="<?php echo $row['address'] ?>"></td>
			</tr>

			<tr>
				<td width="10%">Postal Code</td>	
				<td><input type="text" name="address[postalCode]" value="<?php echo $row['postalCode'] ?>"></td>
			</tr>

			<tr>
				<td width="10%">City</td>	
				<td><input type="text" name="address[city]" value="<?php echo $row['city'] ?>"></td>
			</tr>

			<tr>
				<td width="10%">State</td>	
				<td><input type="text" name="address[state]" value="<?php echo $row['state'] ?>"></td>
			</tr>

			<tr>
				<td width="10%">Country</td>	
				<td><input type="text" name="address[country]" value="<?php echo $row['country'] ?>"></td>
			</tr>

			<tr>
				<td width="10%">Address Type</td>
				<td>
					<?php if($row['billing']==1):?>
					<input type="checkbox" name="address[billing]" value="1" checked>
					<?php else:?>
					<input type="checkbox" name="address[billing]" value="1">
					<?php endif;?>
					<label>Billing</label>	

					<?php if($row['shipping']==1):?>
					<input type="checkbox" name="address[shipping]" value="1" checked>
					<?php else:?>
					<input type="checkbox" name="address[shipping]" value="1">
					<?php endif;?>
					<label>Shipping</label>	

				</td>
			</tr>


	<?php endforeach; ?>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="index.php?a=grid&c=customer">Cancel</a></button> 

				</td>
			</tr>
			

		</table>
	</form>

</body>
</html>