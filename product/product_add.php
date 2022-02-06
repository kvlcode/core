<!DOCTYPE html>
<html>
<head>
	<title>Product Add</title>
</head>
<body>

	<form action="product.php?a=saveAction" method="POST">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Add Product Information</b></td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="product[name]"></td>
			</tr>

			<tr>
				<td width="10%">Price</td>
				<td><input type="text" name="product[price]"></td>
			</tr>
			
			<tr>
				<td width="10%">Quantity</td>
				<td><input type="text" name="product[quantity]"></td>
			</tr>
			
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="product[status]">
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit">
					<button type="button"><a href="product.php?a=gridAction"></a>Cancel</button> 
				</td>
			</tr>
			

		</table>
	</form>

</body>
</html>