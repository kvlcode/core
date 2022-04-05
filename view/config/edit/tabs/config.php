<?php $config = $this->getConfig();?>
<div class="card card-info">
    <div class="card-body">
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="config[name]" id="name" value="<?php echo $config->name ?>" placeholder="Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="code" class="col-sm-2 col-form-label">Code</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="config[code]" id="code" value="<?php echo $config->code ?>" placeholder="Code">
        </div>
      </div>
      <div class="form-group row">
        <label for="value" class="col-sm-2 col-form-label">Value</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="config[value]" id="value" value="<?php echo $config->value ?>" placeholder="value">
        </div>
      </div>
      <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <select class="form-control" name="config[status]" id="pageSelect">
            	<?php foreach ($config->getStatus() as $key => $value):?> 
						<option value="<?php echo $key?>" <?php if($config->status == $key){?> selected <?php }?> ><?php echo $value; ?></option>
					<?php endforeach; ?>
			</select>
		</div>
      </div>				

	<div class="card-footer">
		<button type="button"  class="btn btn-info" id="configFormSaveBtn">Save</button> 
		<button type="button"  class="btn btn-default" id="configFormCancelBtn">Cancel</button> 
	</div>
</div>
</div>	 

<script type="text/javascript">
	jQuery('#configFormCancelBtn').click(function() {
		admin.setUrl("<?php echo $this->getUrl('gridBlock','config', ['id' => null]);?>");
		admin.load();
	});

	jQuery('#configFormSaveBtn').click(function() {
		admin.setForm(jQuery("#indexForm"));
		admin.setUrl("<?php echo $this->getUrl('save');?>");
		admin.load();
	});
</script>