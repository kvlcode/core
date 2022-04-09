<?php $product = $this->getProduct();?>

<div class="card card-info">
    <div class="card-body">
		<div class="form-group row">
			<label for="name" class="col-sm-2 col-form-label">Product Name</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="product[name]" id="name" value="<?php echo $product->name ?>" placeholder="Product Name">
			</div>
		</div>
		<div class="form-group row">
			<label for="sku" class="col-sm-2 col-form-label">Sku</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control"  name="product[sku]" id="sku" value="<?php echo $product->sku ?>" placeholder="Sku">
			</div>
		</div>
		<div class="form-group row">
			<label for="map" class="col-sm-2 col-form-label">Map</label>
			<div class="col-sm-10">
			    <input type="number" class="form-control"  name="product[map]" id="map" value="<?php echo $product->map ?>" placeholder="Map">
			</div>
		</div>

		<div class="form-group row">
			<label for="costPrice" class="col-sm-2 col-form-label">Cost Price</label>
			<div class="col-sm-10">
			    <input type="number" class="form-control"  name="product[costPrice]" id="costPrice" value="<?php echo $product->costPrice ?>" placeholder="Cost Price">
			</div>
		</div>
		<div class="form-group row">
			<label for="price" class="col-sm-2 col-form-label">Price</label>
			<div class="col-sm-10">
			    <input type="number" class="form-control"  name="product[price]" id="price" value="<?php echo $product->price ?>" placeholder="Price">
			</div>
		</div>
		<div class="form-group row">
			<label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
			<div class="col-sm-10">
			    <input type="number" class="form-control"  name="product[quantity]" id="quantity" value="<?php echo $product->quantity ?>" placeholder="Quantity">
			</div>
		</div>

		<div class="form-group row">
			<label for="status" class="col-sm-2 col-form-label">Status</label>
			<div class="col-sm-10">
			    <select class="form-control" name="product[status]">
					<?php foreach ($product->getStatus() as $key => $value): ?>
						<option value="<?php echo $key?>"<?php if($product->status == $key){?> selected <?php }?>> <?php echo $value; ?> </option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

      	<div class="card-footer">
			<button id="productFormSaveBtn" class="btn btn-info" type="button" name="Save">Save</button>
			<button id="productFormCancelBtn" class="btn btn-default" type="button" value="cancel" name="cancel">Cancel</button> 
		</div>	 
	</div>
</div>

<script type="text/javascript">
	jQuery('#productFormCancelBtn').click(function() {
		admin.setUrl("<?php echo $this->getUrl('gridBlock','product', ['id' => null]);?>");
		admin.load();
	});

	jQuery('#productFormSaveBtn').click(function() {
		admin.setForm(jQuery("#indexForm"));
		admin.setUrl("<?php echo $this->getUrl('save');?>");
		admin.load();
	});
</script>