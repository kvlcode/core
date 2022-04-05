<?php $customer = $this->getCustomer();?>
<?php $billingAddress = $customer->getBillingAddresses();?>
<?php $shippingAddress = $customer->getShippingAddresses();?>





<div class="card card-info">
    <div class="card-body">
		<div class="form-group row">
			<label for="billingAddress" class="col-sm-2 col-form-label">Billing Address</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="billingAddress[address]" id="billingAddress" value="<?php echo $billingAddress->address ?>" placeholder="Address">
			</div>
		</div>
		<div class="form-group row">
			<label for="postalCode" class="col-sm-2 col-form-label">Postal Code</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="billingAddress[postalCode]" id="postalCode" value="<?php echo $billingAddress->postalCode ?>" placeholder="Postal Code">
			</div>
		</div>
		<div class="form-group row">
			<label for="city" class="col-sm-2 col-form-label">City</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="billingAddress[city]" id="city" value="<?php echo $billingAddress->city ?>" placeholder="City">
			</div>
		</div>

		<div class="form-group row">
			<label for="state" class="col-sm-2 col-form-label">State</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="billingAddress[state]" id="state" value="<?php echo $billingAddress->state ?>" placeholder="State">
			</div>
		</div>

		<div class="form-group row">
			<label for="country" class="col-sm-2 col-form-label">Country</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="billingAddress[country]" id="country" value="<?php echo $billingAddress->country ?>" placeholder="Country">
			</div>
		</div>

		<div class="form-group row">
			<label for="shippingAddress" class="col-sm-2 col-form-label">Shipping Address</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="shippingAddress[address]" id="shippingAddress" value="<?php echo $shippingAddress->address ?>" placeholder="Address">
			</div>
		</div>
		<div class="form-group row">
			<label for="postalCode" class="col-sm-2 col-form-label">Postal Code</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="shippingAddress[postalCode]" id="postalCode" value="<?php echo $shippingAddress->postalCode ?>" placeholder="Postal Code">
			</div>
		</div>
		<div class="form-group row">
			<label for="city" class="col-sm-2 col-form-label">City</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="shippingAddress[city]" id="city" value="<?php echo $shippingAddress->city ?>" placeholder="City">
			</div>
		</div>

		<div class="form-group row">
			<label for="state" class="col-sm-2 col-form-label">State</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="shippingAddress[state]" id="state" value="<?php echo $shippingAddress->state ?>" placeholder="State">
			</div>
		</div>

		<div class="form-group row">
			<label for="country" class="col-sm-2 col-form-label">Country</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="shippingAddress[country]" id="country" value="<?php echo $shippingAddress->country ?>" placeholder="Country">
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
		admin.setUrl("<?php echo $this->getUrl('gridBlock','customer', ['id' => null]);?>");
		admin.load();
	});

	jQuery('#addressFormSaveBtn').click(function() {
		admin.setForm(jQuery("#indexForm"));
		admin.setUrl("<?php echo $this->getUrl('save');?>");
		admin.load();
	});
</script>