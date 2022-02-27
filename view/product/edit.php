<?php $product = $this->getProduct();?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Edit Page</title>
</head>
<body>

	<form method="post" action="<?php echo $this->getUrl('save', 'product')?>">
		<table border="1" width="100%" cellspacing="4">

			<tr>
				<td colspan="2"><b>Edit Product Information</b></td>
			</tr>

			<tr>
				<td width="10%">Product Name</td>
				<td><input type="text" name="product[name]" value="<?php echo $product->name ?>"></td>
			</tr>

			<tr>
				<td width="10%">Price</td>
				<td><input type="text" name="product[price]" value="<?php echo $product->price ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Quantity</td>
				<td><input type="text" name="product[quantity]" value="<?php echo $product->quantity ?>"></td>
				<input type="hidden" name="product[productId]" value="<?php echo $product->productId ?>">
			</tr>
					
			<tr>
				<td>Status</td>
				<td width="10%">

					<select name="product[status]">
						<?php foreach ($product->getStatus() as $key => $value): ?>
						<option value="<?php echo $key?>"<?php if($product->status == $key){?> selected <?php }?>> <?php echo $value; ?> </option>
						<?php endforeach; ?>
					</select>					

				</td>
			</tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="<?php echo $this->getUrl('grid', 'product')?>">Cancel</a></button> 

				</td>
			</tr>
		</table>
	</form>

</body>
</html>