<?php $medias = $this->getMediaData(); ?>
<?php $id = Ccc::getFront()->getRequest()->getRequest('id');?>

	<form method="POST" action="<?php echo $this->getUrl('save', 'product_media', ['id' => $id]);?>">
		<button type="submit" name="update"> Update </a></button>
		<button type="button" name="cancel"><a href="<?php echo $this->getUrl('grid','product')?>"> Cancel </a></button>
			<table border="1" width="100%" cellspacing="4">
				<tr>
					<th>Image Id</th>
					<th>Product Id</th>
					<th>Image</th>
					<th>Base</th>
					<th>Thumbnail</th>
					<th>Small</th>
					<th>Gallery</th>
					<th>Status</th>
					<th>Remove</th>	
				</tr>
					<?php if(!$medias):?>
				<tr>
					<td colspan="11">No record Available</td>
				</tr>	
				<?php else:?>
					
					<?php foreach ($medias as $media): ?>
						<tr>
							<td><?php echo $media->imageId  ?></td>
							<td><?php echo $media->productId ?></td>
							<td><?php  if($media->gallery == 1): ?>
									<img src="<?php echo 'Media/Product/'.$media->name?>" width = "50px" hieght = "50px">
								<?php else:?>
									<?php echo "Image not found";?>
								<?php endif;?>	
							</td>
							<td><input type="radio" name="image[base]" value= "<?php echo $media->imageId?>"<?php if ($media->base == 1):?> checked <?php endif;?> ></td>
							<td><input type="radio" name="image[thumbnail]" value="<?php echo $media->imageId?>"<?php if ($media->thumbnail == 1):?> checked <?php endif;?> ></td>
							<td><input type="radio" name="image[small]" value="<?php echo $media->imageId?>"<?php if ($media->small == 1):?> checked <?php endif;?> ></td>
							<td><input type="checkbox" name="image[gallery][]" value="<?php echo $media->imageId?>" <?php if ($media->gallery == 1):?> checked <?php endif;?>></td>
							<td><input type="checkbox" name="image[status][]" value="<?php echo $media->imageId?>"<?php if ($media->status == 1):?> checked <?php endif;?> ></td>
							<td><input type="checkbox" name="image[remove][]" value="<?php echo $media->imageId?>"<?php if ($media->remove == 1):?> checked <?php endif;?>></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>			
			</table>
	</form>
	
	<form method="POST" action="<?php echo $this->getUrl('save', 'product_media', ['id' =>  $id]);?>" enctype="multipart/form-data">
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
