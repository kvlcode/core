<?php $admin = $this->getAdmin();?>

	<form method="POST" action="<?php echo $this->getUrl('save', null, ['id'=> $admin->adminId], true)?>">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Admin Information</b></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="admin[firstName]" value="<?php echo $admin->firstName ?>"></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="admin[lastName]" value="<?php echo $admin->lastName ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Email</td>
				<td><input type="text" name="admin[email]" value="<?php echo $admin->email ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Password</td>
				<td><input type="text" name="admin[password]"></td>
				
			</tr>
			
			<tr>
				<td>Status</td>
				<td width="10%">

					<select name="admin[status]">
					<?php foreach ($admin->getStatus() as $key => $value): ?>
					<option value="<?php echo $key?>"<?php if($admin->status == $key){?> selected <?php }?>> <?php echo $value; ?> </option>
					<?php endforeach; ?>
					</select>					

				</td>
			</tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="<?php echo $this->getUrl(null,null, null, true)?>">Cancel</a></button> 

				</td>
			</tr>
		</table>
	</form>