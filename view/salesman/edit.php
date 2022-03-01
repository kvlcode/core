<?php $salesman = $this->getSalesman();	?>
<!DOCTYPE html>
<html>
<head>
	<title>Salesman Edit</title>
</head>
<body>
	<form method="Post" action="<?php echo $this->getUrl('save', 'salesman')?>">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Salesman Information</b></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="salesman[firstName]" value="<?php echo $salesman->firstName ?>"></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="salesman[lastName]" value="<?php echo $salesman->lastName ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Email</td>
				<td><input type="text" name="salesman[email]" value="<?php echo $salesman->email ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Mobile</td>
				<td><input type="text" name="salesman[mobile]" value="<?php echo $salesman->mobile ?>"></td>
				<input type="hidden" name="salesman[salesmanId]" value="<?php echo $salesman->salesmanId ?>">
			</tr>
			
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="salesman[status]">
					<?php foreach ($salesman->getStatus() as $key => $value):?>
						<option value="<?php echo $key ?>" <?php if($salesman->status == $key){?> selected <?php }?>> <?php echo $value ?> </option>
					<?php endforeach;?>
					</select>
				</td>
			</tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="<?php echo $this->getUrl('grid', 'salesman')?>">Cancel</a></button> 
				</td>
			</tr>
		</table>
	</form>
</body>
</html>