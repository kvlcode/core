<?php

require_once('Adapter.php');  
$id = $_GET['id'];
$adapter=new Adapter();

$result = $adapter->fetchAll("SELECT * FROM categories WHERE categoryId='$id'");


?>

<!DOCTYPE html>
<html>
<head>
	<title>Category Edit</title>
</head>
<body>

	<?php foreach ($result as $row): ?>

	<form method="Post" action="categories.php?a=saveAction">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Category Information</b></td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="category[name]" value="<?php echo $row['name'] ?>"></td>
			</tr>

			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="category[status]" value="<?php echo $row['status'] ?>" >
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
				</td>
				<input type="hidden" name="hiddenId" value="<?php echo $row['categoryId'] ?>">
			</tr>
	<?php endforeach; ?>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="categories.php?a=gridAction">Cancel</a></button> 

				</td>
			</tr>
			

		</table>
	</form>

</body>
</html>