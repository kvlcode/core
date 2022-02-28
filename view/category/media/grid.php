<?php $media = $this->getMediaData(); 
  $id = Ccc::getFront()->getRequest()->getRequest('id');
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Media Grid</title>
</head>
<body>
	<br><br>
	<form method="POST" action="<?php echo $this->getUrl('save', 'category_media', ['id' => $id]);?>">
		<button type="submit" name="update"> Update </a></button>
		<button type="button" name="cancel"><a href="<?php echo $this->getUrl('grid','category')?>"> Cancel </a></button>
			<table border="1" width="100%" cellspacing="4">
				<tr>
					<th>Image Id</th>
					<th>Category Id</th>
					<th>Name</th>
					<th>Base</th>
					<th>Thumbnail</th>
					<th>Small</th>
					<th>Gallery</th>
					<th>Status</th>
					<th>Remove</th>	
				</tr>
					<?php if(!$media):?>
				<tr>
					<td colspan="11">No record Available</td>
				</tr>	
				<?php else:?>
					
					<?php foreach ($media as $row): ?>
						<tr>
							<td><?php echo $row->imageId  ?></td>
							<td><?php echo $row->categoryId ?></td>
							<td><?php echo $row->name  ?></td>
							<td><input type="radio" name="image[base]" value= "<?php echo $row->imageId?>"<?php if ($row->base == 1):?> checked <?php endif;?> ></td>
							<td><input type="radio" name="image[thumbnail]" value="<?php echo $row->imageId?>"<?php if ($row->thumbnail == 1):?> checked <?php endif;?> ></td>
							<td><input type="radio" name="image[small]" value="<?php echo $row->imageId?>"<?php if ($row->small == 1):?> checked <?php endif;?> ></td>
							<td><input type="checkbox" name="image[gallery][]" value="<?php echo $row->imageId?>" <?php if ($row->gallery == 1):?> checked <?php endif;?>></td>
							<td><input type="checkbox" name="image[status][]" value="<?php echo $row->imageId?>"<?php if ($row->status == 1):?> checked <?php endif;?> ></td>
							<td><input type="checkbox" name="image[remove][]" value="<?php echo $row->imageId?>"<?php if ($row->remove == 1):?> checked <?php endif;?>></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>			
			</table>
	</form>
	<br>
	
	<form method="POST" action="<?php echo $this->getUrl('save', 'category_media', ['id' =>  $id]);?>" enctype="multipart/form-data">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Image Upload</b></td>
			</tr>

			<tr>
				<td width="10%">Browse</td>
				<td><input type="file" name="image" ></td>
			</tr>
			
			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<button type="submit">Upload</button> 
				</td>
			</tr>
		</table>
	</form>

</body>
</html>
