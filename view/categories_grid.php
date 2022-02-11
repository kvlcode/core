<?php 

global $adapter;

try
{
	$categories = $adapter->fetchAll('SELECT * FROM categories');

		if(!$categories)
		{
			throw new Exception("System Can't fetch", 1);
		}
}
catch(Exception $e)
{
	throw new Exception("System Can't fetch", 1);
}

	 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Categories Grid</title>
</head>
<body>
	<button type="button" name="addNew"><a href="index.php?a=add&c=categories"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>CategoryId</th>
			<th>Path</th>
			<th>Name</th>
			<th>Status</th>
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>

		<?php if(!$categories):?>
			<tr>
				<td colspan="7">No record Available</td>
			</tr>	
		<?php else:?>
			
			<?php foreach ($categories as $category): ?>
				<tr>
					<td><?php echo $category['categoryId']; ?></td>
					<td><?php echo $category['path']  ?></td>
					<td><?php echo $category['name']  ?></td>
					<td><?php echo $category['status']; ?></td>
					<td><?php echo $category['createdDate']; ?></td>
					<td><?php echo $category['updatedDate']; ?></td>
					<td><a href="index.php?a=edit&c=categories&id=<?php echo $category['categoryId']; ?>">Edit</a></td>
					<td><a href="index.php?a=delete&c=categories&id=<?php echo $category['categoryId']; ?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	

		
	</table>
 
</body>
</html>