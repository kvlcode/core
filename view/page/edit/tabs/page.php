<?php $page = $this->getPage();?>



<div class="card card-info">
    <div class="card-body">
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Page Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="page[name]" id="name" value="<?php echo $page->name ?>" placeholder="Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="code" class="col-sm-2 col-form-label">Code</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="page[code]" id="code" value="<?php echo $page->code ?>" placeholder="Code">
        </div>
      </div>
      <div class="form-group row">
        <label for="content" class="col-sm-2 col-form-label">Content</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="page[content]" id="content" value="<?php echo $page->content ?>" placeholder="content">
        </div>
      </div>
      <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <select class="form-control" name="page[status]" id="pageSelect">
            	<?php foreach ($page->getStatus() as $key => $value):?> 
						<option value="<?php echo $key?>" <?php if($page->status == $key){?> selected <?php }?> ><?php echo $value; ?></option>
					<?php endforeach; ?>
			</select>
		</div>
      </div>				

	   <div class="card-footer">
			<button id="pageFormSaveBtn" class="btn btn-info" type="button" name="Save">Save</button>
			<button id="pageFormCancelBtn" class="btn btn-default" type="button" value="cancel" name="cancel">Cancel</button> 
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery('#pageFormCancelBtn').click(function() {
		admin.setUrl("<?php echo $this->getUrl('gridBlock','page', ['id' => null]);?>");
		admin.load();
	});

	jQuery('#pageFormSaveBtn').click(function() {
		admin.setForm(jQuery("#indexForm"));
		admin.setUrl("<?php echo $this->getUrl('save');?>");
		admin.load();
	});
</script>
