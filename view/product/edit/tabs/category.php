<?php $categories = $this->getCategories();?>

<table class="table table-bordered table-striped">
	
	<tr>
		<td width="10%">CategoryId</td>
		<td>CategoryName</td>
		<td>Select</td>	
	</tr>

	<?php foreach ($categories as $category): ?>
		<tr>
			<td><input type="text" name="category[categoryId]" value="<?php echo $category->categoryId ?>" disabled></td>
			<td><input type="text" name="category[path]" value="<?php echo $this->path($category->path) ?>" disabled></td>

			<td><input type="checkbox" name="category[categoryId][]" value="<?php echo $category->categoryId; ?>" <?php echo $this->getSelect($category->categoryId);?>></td>		
		</tr>
	<?php endforeach;?>

	<tr>	
		<td>&nbsp;</td>
		<td>
			<input type="submit" name="Save" class="btn btn-info">
			<button type="button" class="btn btn-default"><a href="<?php echo $this->getUrl(null, null, null, true)?>">Cancel</a></button> 

		</td>
	</tr>
</table>