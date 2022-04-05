<?php 	$vendor = $this->getVendor();?>
<?php $vendorAddress = $vendor->getAddress();?>


<div class="card card-info">
    <div class="card-body">
		<div class="form-group row">
			<label for="address" class="col-sm-2 col-form-label">Address</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="address[address]" id="address" value="<?php echo $vendorAddress->address ?>" placeholder="Address">
			</div>
		</div>
		<div class="form-group row">
			<label for="postalCode" class="col-sm-2 col-form-label">Postal Code</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="address[postalCode]" id="postalCode" value="<?php echo $address->postalCode ?>" placeholder="Postal Code">
			</div>
		</div>
		<div class="form-group row">
			<label for="city" class="col-sm-2 col-form-label">City</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="address[city]" id="city" value="<?php echo $address->city ?>" placeholder="City">
			</div>
		</div>

		<div class="form-group row">
			<label for="state" class="col-sm-2 col-form-label">State</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="address[state]" id="state" value="<?php echo $address->state ?>" placeholder="State">
			</div>
		</div>

		<div class="form-group row">
			<label for="country" class="col-sm-2 col-form-label">Country</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="address[country]" id="country" value="<?php echo $address->country ?>" placeholder="Country">
			</div>
		</div>

      	<div class="card-footer">
			<button id="addressFormSaveBtn" class="btn btn-info" type="button" name="Save">Save</button>
			<button id="addressFormCancelBtn" class="btn btn-default" type="button" value="cancel" name="cancel">Cancel</button> 
		</div>	 
	</div>
</div>

<script type="text/javascript">
	jQuery('#addressFormCancelBtn').click(function() {
		admin.setUrl("<?php echo $this->getUrl('gridBlock','vendor', ['id' => null]);?>");
		admin.load();
	});

	jQuery('#addressFormSaveBtn').click(function() {
		admin.setForm(jQuery("#indexForm"));
		admin.setUrl("<?php echo $this->getUrl('save');?>");
		admin.load();
	});
</script>