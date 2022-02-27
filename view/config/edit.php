<?php $config = $this->getConfig();?>
<!DOCTYPE html>
<html>
<head>
	<title>Config Edit Page</title>
</head>
<body>

	<form method="post" action="<?php echo $this->getUrl('save', 'config')?>">
		<table border="1" width="100%" cellspacing="4">

			<tr>
				<td colspan="2"><b>Edit config Information</b></td>
			</tr>

			<tr>
				<td width="10%">Config Name</td>
				<td><input type="text" name="config[name]" value="<?php echo $config->name ?>"></td>
			</tr>

			<tr>
				<td width="10%">Code</td>
				<td><input type="text" name="config[code]" value="<?php echo $config->code ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Value</td>
				<td><input type="text" name="config[value]" value="<?php echo $config->value ?>"></td>
				<input type="hidden" name="config[configId]" value="<?php echo $config->configId ?>">
			</tr>
					
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="config[status]">
					<?php foreach ($config->getStatus() as $key => $value):?>
						<option value="<?php echo $key;?>" <?php if($config->status == $key){?> selected <?php }?>> <?php echo $value;?></option>

					<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="<?php echo $this->getUrl('grid', 'config')?>">Cancel</a></button> 

				</td>
			</tr>
		</table>
	</form>

</body>
</html>