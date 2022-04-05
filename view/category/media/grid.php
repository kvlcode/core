<?php $medias = $this->getMediaData(); ?>
<?php $id = Ccc::getFront()->getRequest()->getRequest('id');?>

<form method="POST" action="<?php echo $this->getUrl('save', 'category_media', ['id' => $id]);?>">
	<div class="card-footer">
		<button type="submit" name="update" class="btn btn-success"> Update </a></button>
		<button type="button" name="cancel"  class="btn btn-default"><a href="<?php echo $this->getUrl('grid','category')?>"> Cancel </a></button>
	</div>
	<table class="table table-bordered table-striped">
		<tr>
			<th>Image Id</th>
			<th>Category Id</th>
			<th>Image</th>
			<th>Base</th>
			<th>Thumbnail</th>
			<th>Small</th>
			<th>Gallery</th>
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
					<td><?php echo $media->categoryId ?></td>
					<td><?php if($media->gallery == 1):?>
							<img src="<?php echo 'Media/Category/'.$media->name?>" width = "50px" hieght = "50px">
						<?php else:?>
							<?php echo "Image not found";?>
						<?php endif;?>	
					</td>
					<td><input type="radio" name="image[base]" value= "<?php echo $media->imageId?>"<?php if ($media->base == 1):?> checked <?php endif;?> ></td>
					<td><input type="radio" name="image[thumbnail]" value="<?php echo $media->imageId?>"<?php if ($media->thumbnail == 1):?> checked <?php endif;?> ></td>
					<td><input type="radio" name="image[small]" value="<?php echo $media->imageId?>"<?php if ($media->small == 1):?> checked <?php endif;?> ></td>
					<td><input type="checkbox" name="image[gallery][]" value="<?php echo $media->imageId?>" <?php if ($media->gallery == 1):?> checked <?php endif;?>></td>
					<td><input type="checkbox" name="image[remove][]" value="<?php echo $media->imageId?>"<?php if ($media->remove == 1):?> checked <?php endif;?>></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>			
	</table>
</form>
	
	<form method="POST" action="<?php echo $this->getUrl('save', 'category_media', ['id' =>  $id]);?>" enctype="multipart/form-data">
		<table class="table table-bordered table-striped">
			
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
					<button type="submit" class="btn btn-success">Upload</button> 
				</td>
			</tr>
		</table>
	</form>