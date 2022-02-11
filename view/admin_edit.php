<?php 

$id = $_GET['id'];
global $adapter;

$row = $adapter->fetchRow("SELECT *
	                            FROM admin
	                            WHERE adminId = $id");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Edit</title>
</head>
<body>

	<form method="POST" action="index.php?a=save&c=admin">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Admin Information</b></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="admin[firstName]" value="<?php echo $row['firstName'] ?>"></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="admin[lastName]" value="<?php echo $row['lastName'] ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Email</td>
				<td><input type="text" name="admin[email]" value="<?php echo $row['email'] ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Password</td>
				<td><input type="text" name="admin[password]" value="<?php echo $row['password'] ?>"></td>
				<input type="hidden" name="admin[hiddenId]" value="<?php echo $row['adminId'] ?>">
			</tr>
			
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="admin[status]">
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
					<button type="button"><a href="index.php?a=grid&c=admin">Cancel</a></button> 

				</td>
			</tr>
		</table>
	</form>

</body>
</html>