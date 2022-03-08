<?php $product = $this->getProduct();?>
<?php $categories = $this->getCategories();?>
<?php $selects = $this->getSelect();?>

	<form method="post" action="<?php echo $this->getUrl('save', null, null, true)?>">
		<table border="1" width="100%" cellspacing="4">

			<tr>
				<td colspan="2"><b>Edit Product Information</b></td>
			</tr>

			<tr>
				<td width="10%">Product Name</td>
				<td><input type="text" name="product[name]" value="<?php echo $product->name ?>"></td>
			</tr>

			<tr>
				<td width="10%">Sku</td>
				<td><input type="text" name="product[sku]" value="<?php echo $product->sku ?>"></td>
			</tr>

			<tr>
				<td width="10%">Map</td>
				<td><input type="text" name="product[map]" value="<?php echo $product->map ?>"></td>
			</tr>


			<tr>
				<td width="10%">Cost Price</td>
				<td><input type="text" name="product[costPrice]" value="<?php echo $product->costPrice ?>"></td>
			</tr>

			<tr>
				<td width="10%">Price</td>
				<td><input type="text" name="product[price]" value="<?php echo $product->price ?>"></td>
			</tr>

			
			<tr>
				<td width="10%">Quantity</td>
				<td><input type="text" name="product[quantity]" value="<?php echo $product->quantity ?>"></td>
				<input type="hidden" name="product[productId]" value="<?php echo $product->productId ?>">
			</tr>
					
			<tr>
				<td>Status</td>
				<td width="10%">

					<select name="product[status]">
						<?php foreach ($product->getStatus() as $key => $value): ?>
						<option value="<?php echo $key?>"<?php if($product->status == $key){?> selected <?php }?>> <?php echo $value; ?> </option>
						<?php endforeach; ?>
					</select>					

				</td>
			</tr>
			<tr>
				<table border="1" width="100%" cellspacing="4">
					<tr>
						<td width="10%">CategoryId</td>
						<td>CategoryName</td>
						<td>Select</td>	
					</tr>

					<?php foreach ($categories as $category): ?>
						<tr>
							<td><input type="text" name="category[categoryId]" value="<?php echo $category->categoryId ?>" disabled></td>
							<td><input type="text" name="category[path]" value="<?php echo $this->path($category->path) ?>" disabled></td>
							<?php if($selects):?>
								<td><input type="checkbox" name="category[categoryId][]" value="<?php echo $category->categoryId?>" 
									<?php foreach ($selects as $select):?>
										<?php if ($category->categoryId == $select->categoryId):?> checked <?php endif;?>
									<?php endforeach;?>></td>
							<?php else: ?>
								<td><input type="checkbox" name="category[categoryId][]" value="<?php echo $category->categoryId?>"></td>
							<?php endif; ?>			
						</tr>
					<?php endforeach;?>
				</table>
			</tr>

			<tr>	
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="<?php echo $this->getUrl(null, null, null, true)?>">Cancel</a></button> 

				</td>
			</tr>
		</table>
	</form>