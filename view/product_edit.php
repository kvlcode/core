<?php $row = $this->getData('productEdit'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Edit Page</title>
</head>
<body>

	<form method="post" action="index.php?a=save&c=product">
		<table border="1" width="100%" cellspacing="4">

			<tr>
				<td colspan="2"><b>Edit Product Information</b></td>
			</tr>

			<tr>
				<td width="10%">Product Name</td>
				<td><input type="text" name="product[name]" value="<?php echo $row['name'] ?>"></td>
			</tr>

			<tr>
				<td width="10%">Price</td>
				<td><input type="text" name="product[price]" value="<?php echo $row['price'] ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Quantity</td>
				<td><input type="text" name="product[quantity]" value="<?php echo $row['quantity'] ?>"></td>
				<input type="hidden" name="product[hiddenId]" value="<?php echo $row['productId'] ?>">
			</tr>
					
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="product[status]">
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
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="index.php?a=grid&c=product">Cancel</a></button> 

				</td>
			</tr>
		</table>
	</form>

</body>
</html>