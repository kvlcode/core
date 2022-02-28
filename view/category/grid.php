<?php $categories = $this->getCategories(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Categories Grid</title>
</head>
<body>
	<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','category')?>"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>CategoryId</th>
			<th>Path</th>
			<th>Name</th>
			<th>Status</th>
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Base</th>
            <th>Thumbnail</th>
            <th>Small</th>
			<th>Edit</th>
			<th>Delete</th>
			<th>Media</th>
		</tr>

		<?php if(!$categories):?>
			<tr>
				<td colspan="7">No record Available</td>
			</tr>	
		<?php else:?>
			
			<?php foreach ($categories as $category): ?>
				<tr>
					<td><?php echo $category->categoryId ?></td>
					<td><?php echo $this->path($category->path)  ?></td>
					<td><?php echo $category->name  ?></td>
					<td><?php echo $category->status ?></td>
					<td><?php echo $category->createdDate ?></td>
					<td><?php echo $category->updatedDate ?></td>
					<td><?php echo $category->baseImage ?></td>
                    <td><?php echo $category->thumbImage ?></td>
                    <td><?php echo $category->smallImage ?></td>
					<td><a href="<?php echo $this->getUrl('edit','category',['id' => $category->categoryId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','category',['id' => $category->categoryId])?>">Delete</a></td>
					<td><a href="<?php echo $this->getUrl('grid', 'category_media', ['id' => $category->categoryId]);?>">Media</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
		
	</table> 
</body>
</html>