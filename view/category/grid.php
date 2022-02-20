<?php $categories = $this->getCategories(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Categories Grid</title>
</head>
<body>
	<button type="button" name="addNew"><a href="<?php echo $this->getAction()->getUrl('category','add')?>"> Add New </a></button>
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
					<td><?php echo $this->path($category['path']);  ?></td>
					<td><?php echo $category['name']  ?></td>
					<td><?php echo $category['status']; ?></td>
					<td><?php echo $category['createdDate']; ?></td>
					<td><?php echo $category['updatedDate']; ?></td>
					<td><a href="<?php echo $this->getAction()->getUrl('category','edit',['id' => $category['categoryId']])?>">Edit</a></td>
					<td><a href="<?php echo $this->getAction()->getUrl('category','delete',['id' => $category['categoryId']])?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
		
	</table> 
</body>
</html>