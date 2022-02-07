<?php  require_once('Adapter.php');  ?>

<?php 

$id = $_GET['id'];

//echo $id;

$adapter=new Adapter();

$result = $adapter->fetchAll("SELECT * FROM product WHERE productId ='$id'");

	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Product Edit Page</title>
</head>
<body>

	<?php foreach ($result as $row): ?>


	<form method="post" action="product.php?a=saveAction">
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
				<input type="hidden" name="hiddenId" value="<?php echo $row['productId'] ?>">
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
	<?php endforeach; ?>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="product.php?a=gridAction">Cancel</a></button> 

				</td>
			</tr>
			

		</table>
	</form>

</body>
</html>