<?php 
require_once ('Adapter.php');
$adapter=new Adapter();
$categories=$adapter->fetchAll('select * from categories');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Categories Grid</title>
</head>
<body>
	<button type="button" name="addNew"><a href="categories.php?a=addAction"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>CategoryId</th>
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
					<td><?php echo $category['name']; ?></td>
					<td><?php echo $category['status']; ?></td>
					<td><?php echo $category['createdDate']; ?></td>
					<td><?php echo $category['updatedDate']; ?></td>
					<td><a href="categories.php?a=editAction&id=<?php echo $category['categoryId']; ?>">Edit</a></td>
					<td><a href="categories.php?a=deleteAction&id=<?php echo $category['categoryId']; ?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	

		
	</table>

</body>
</html>