<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Form</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body >

	<div class="container">
		 <form id="product_form" method="post" action="product_save.php">

			<div class="mb-3">
			  <label for="formGroupExampleInput" class="form-label">Product Name</label>
			  <input type="text" class="form-control" id="formGroupExampleInput" name="name" placeholder="Enter Name">
			</div>

			<div class="mb-3">
			  <label for="formGroupExampleInput2" class="form-label">Price</label>
			  <input type="text" class="form-control" id="formGroupExampleInput2" name="price" placeholder="Enter Price">
			</div>

			<div class="mb-3">
			  <label for="formGroupExampleInput" class="form-label">Quantity</label>
			  <input type="text" class="form-control" id="formGroupExampleInput" name="quantity" placeholder="Enter Quantity">
			</div>

			<div class="form-check">
			  <label for="formGroupExampleInput" class="form-label">Status</label><br>		
			  <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="1" checked>
			  <label class="form-check-label" for="flexRadioDefault1">
			    Active
			  </label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="2">
			  <label class="form-check-label" for="flexRadioDefault2">
			    Inactive
			  </label>
			</div>

			<button type="submit" class="btn btn-primary">Add Product</button>

		</form>
	</div>


</body>
</html>

