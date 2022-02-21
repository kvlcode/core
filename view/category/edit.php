<?php $row = $this->getCategory();?>  		
<?php $parentList = $this->getParent();?>

<!DOCTYPE html>
<html>
<head>
	<title>Category Edit</title>
</head>
<body>

	<form method="Post" action="<?php echo $this->getUrl('category','save')?>">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Category Information</b></td>
			</tr>

			<tr>
				<td>Parent</td>
				<td>
					<select name="category[parentPath]" class="form-control">

						<?php foreach ($parentList as $key => $value): ?>
							<?php $path = $this->path($parentList[$key]['path']);?>

							<option value="<?php echo $parentList[$key]['path']; ?>"><?php echo $path;?></option>
							
						<?php endforeach;?>
				    </select>

				</td>

			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="category[name]" value="<?php echo $row['name'] ?>"></td>
			</tr>

			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="category[status]">
					<?php if ($row['status']==1):?>
						<option value="1" selected>Active</option>
						<option value="2">Inactive</option>
					<?php else:?>
						<option value="1">Active</option>
						<option value="2" selected>Inactive</option>
					<?php endif; ?>	
					</select>
				</td>
				<input type="hidden" name="category[hiddenId]" value="<?php echo $row['categoryId'] ?>">
			</tr>
			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="<?php echo $this->getUrl('category','grid')?>">Cancel</a></button> 

				</td>
			</tr>
			

		</table>
	</form>

</body>
</html>