<?php $salesman = $this->getSalesman();	?>
<div class="card card-info">
    <div class="card-body">
      <div class="form-group row">
        <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="salesman[firstName]" id="firstName" value="<?php echo $salesman->firstName ?>" placeholder="First Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="salesman[lastName]" id="lastName" value="<?php echo $salesman->lastName ?>" placeholder="Last Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control"  name="salesman[email]" id="email" value="<?php echo $salesman->email ?>" placeholder="Email">
        </div>
      </div>
      <div class="form-group row">
        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
        <div class="col-sm-10">
            <input type="mobile" class="form-control"  name="salesman[mobile]" id="mobile" value="<?php echo $salesman->mobile ?>" placeholder="Mobile">
        </div>
      </div>
      <div class="form-group row">
        <label for="discount" class="col-sm-2 col-form-label">Discount</label>
        <div class="col-sm-10">
            <input type="discount" class="form-control"  name="salesman[discount]" id="discount" value="<?php echo $salesman->discount ?>" placeholder="Password">
        </div>
      </div>
      <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <select class="form-control" name="salesman[status]" id="pageSelect">
            	<?php foreach ($salesman->getStatus() as $key => $value):?> 
						<option value="<?php echo $key?>" <?php if($salesman->status == $key){?> selected <?php }?> ><?php echo $value; ?></option>
					<?php endforeach; ?>
			</select>
		</div>
      </div>	
		<div class="card-footer">
			<button id="salesmanFormSaveBtn" class="btn btn-info" type="button" name="Save">Save</button>
			<button id="salesmanFormCancelBtn" class="btn btn-default" type="button" value="cancel" name="cancel">Cancel</button> 
		</div>
	</div>
</div>			

<script type="text/javascript">
	jQuery('#salesmanFormCancelBtn').click(function() {
		admin.setUrl("<?php echo $this->getUrl('gridBlock','salesman', ['id' => null]);?>");
		admin.load();
	});

	jQuery('#salesmanFormSaveBtn').click(function() {
		admin.setForm(jQuery("#indexForm"));
		admin.setUrl("<?php echo $this->getUrl('save');?>");
		admin.load();
	});
</script>

