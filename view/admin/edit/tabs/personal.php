<?php $admin = $this->getAdmin();?>

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
			<button id="adminFormSaveBtn" type="button" name="Save">Save</button>
			<button id="adminFormCancelBtn" type="button" value="cancel" name="cancel">Cancel</button> 

		</td>
	</tr>
</table>

<script type="text/javascript">
	jQuery('#adminFormCancelBtn').click(function() {
		admin.setUrl("<?php echo $this->getUrl('gridBlock','admin', ['id' => null]);?>");
		admin.load();
	});

	jQuery('#adminFormSaveBtn').click(function() {
		admin.setForm(jQuery("#indexForm"));
		admin.setUrl("<?php echo $this->getUrl('save');?>");
		admin.load();
	});
</script>
