<?php

$id = $_GET['id'];
global $adapter;

$row = $adapter->fetchRow("SELECT * FROM categories WHERE categoryId='$id'");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Category Edit</title>
</head>
<body>

	<form method="Post" action="index.php?a=save&c=categories">
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
					<select name="category[status]">
					<?php if ($row['status']==1):?>
						<option value="1" selected>Active</option>
						<option value="2">Inactive</option>
					<?php else:?>
						<option value="1">Active</option>
						<option value="2" selected>Inactive</option>
					<?php endif; ?>	
					</select>
				</td>
				<input type="hidden" name="category[hiddenId]" value="<?php echo $row['categoryId'] ?>">
			</tr>
			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="index.php?a=grid&c=categories">Cancel</a></button> 

				</td>
			</tr>
			

		</table>
	</form>

</body>
</html>