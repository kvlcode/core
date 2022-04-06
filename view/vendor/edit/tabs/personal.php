<?php $vendor = $this->getVendor();?>
<div class="card card-info">
    <div class="card-body">
		<div class="form-group row">
			<label for="firstName" class="col-sm-2 col-form-label">First Name</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="vendor[firstName]" id="firstName" value="<?php echo $vendor->firstName ?>" placeholder="First Name">
			</div>
		</div>
		<div class="form-group row">
			<label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="vendor[lastName]" id="lastName" value="<?php echo $vendor->lastName ?>" placeholder="Last Name">
			</div>
		</div>
		<div class="form-group row">
			<label for="email" class="col-sm-2 col-form-label">Email</label>
			<div class="col-sm-10">
			    <input type="email" class="form-control"  name="vendor[email]" id="email" value="<?php echo $vendor->email ?>" placeholder="Email">
			</div>
		</div>

		<div class="form-group row">
			<label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
			<div class="col-sm-10">
			    <input type="mobile" class="form-control"  name="vendor[mobile]" id="mobile" value="<?php echo $vendor->mobile ?>" placeholder="Mobile">
			</div>
		</div>

		<div class="form-group row">
			<label for="status" class="col-sm-2 col-form-label">Status</label>
			<div class="col-sm-10">
			    <select class="form-control" name="vendor[status]">
					<?php foreach ($vendor->getStatus() as $key => $value): ?>
						<option value="<?php echo $key?>"<?php if($vendor->status == $key){?> selected <?php }?>> <?php echo $value; ?> </option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

      	<div class="card-footer">
			<button id="vendorFormSaveBtn" class="btn btn-info" type="button" name="Save">Save</button>
			<button id="vendorFormCancelBtn" class="btn btn-default" type="button" value="cancel" name="cancel">Cancel</button> 
		</div>	 
	</div>
</div>	

<script type="text/javascript">
	jQuery('#vendorFormCancelBtn').click(function() {
		admin.setUrl("<?php echo $this->getUrl('gridBlock','vendor', ['id' => null]);?>");
		admin.load();
	});

	jQuery('#vendorFormSaveBtn').click(function() {
		admin.setForm(jQuery("#indexForm"));
		admin.setUrl("<?php echo $this->getUrl('save');?>");
		admin.load();
	});
</script>