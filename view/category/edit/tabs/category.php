<?php $categoryRow = $this->getCategory();?>       		
<?php if ($categoryRow->categoryId):?>
	<?php $parentList = $this->getParent();?>
<?php else: ?>
	<?php $category = $this->getCategories();?>
<?php endif;?>	

<table class="table table-bordered table-striped">
	<tr>
		<td colspan="2"><b>Category Information</b></td>
	</tr>

	<tr>
		<td>Parent</td>
		<td>
			<?php if ($categoryRow->categoryId):?>
				<select name="category[parentPath]" class="form-control">
					<?php foreach ($parentList as $key => $value): ?>
						<?php $path = $this->path($parentList[$key]->path);?>
						<option value="<?php echo $parentList[$key]->path; ?>"><?php echo $path;?></option>
					<?php endforeach;?>
			    </select>
			<?php else: ?>
				<select name="category[path]" class="form-control">
			      <option value="0">Root</option>
			        <?php
			        if(!$categories): 
			          echo 'No data';
			        endif;
			          foreach($category as $row) :?>
			            <?php echo "<option value='". $row->name ."'>" .$this->path($row->path) ."</option>" ;
			          endforeach;?>
	      		</select>
	      	<?php endif; ?>	

		</td>

	</tr>

	<tr>
		<?php if ($categoryRow):?>
			<td width="10%">Name</td>
			<td><input type="text" name="category[name]" value="<?php echo $categoryRow->name ?>"></td>
		<?php else: ?>
			<td width="10%">Name</td>
			<td><input type="text" name="category[name]" value=""></td>	
		<?php endif;?>
	</tr>

	<tr>
		<td>Status</td>
		<td width="10%">

			<select class="form-control" name="category[status]" id="pageSelect">
					<?php foreach ($categoryRow->getStatus() as $key => $value): ?>
					<option value="<?php echo $key?>"<?php if($categoryRow->status == $key){?> selected <?php }?>> <?php echo $value; ?> </option>
					<?php endforeach; ?>
			</select>
		</td>
		<input type="hidden" name="category[categoryId]" value="<?php echo $categoryRow->categoryId ?>">
	</tr>
	<tr>
		<td width="10%">&nbsp;</td>
		<td>
			<button type="button" class="btn btn btn-info" id="categoryFormSaveBtn">Save</button>
			<button type="button" class="btn btn btn-default" id="categoryFormCancelBtn">Cancel</button> 

		</td>
	</tr>
</table>

<script type="text/javascript">
			jQuery('#categoryFormCancelBtn').click(function() {
				admin.setUrl("<?php echo $this->getUrl('gridBlock', 'category', ['id' => null]); ?>");
				admin.load();
			});

			$('#categoryFormSaveBtn').click(function() {
				admin.setForm(jQuery("#indexForm"));
				admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
				admin.load();
			});
		</script>

