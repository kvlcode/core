<?php $row = $this->getData('categoriesEdit');?>
<?php 

function editPath(){
	echo "<pre>";
	// echo $categoryId;

		global $adapter;

		$categoryName=$adapter->fetchPair("SELECT categoryId,name FROM categories ORDER BY `path` ASC");
        $categoryPath=$adapter->fetchPair("SELECT categoryId,`path` FROM categories ORDER BY `path` ASC");
       
        $categories=[];
        foreach ($categoryPath as $key => $value) {
                $explodeArray=explode('/', $value);
                $tempArray = [];

                foreach ($explodeArray as $keys => $value) {
                    if(array_key_exists($value,$categoryName)){
                        array_push($tempArray,$categoryName[$value]);
                    }
                }

                $implodeArray = implode('/', $tempArray);
                $categories[$key]= $implodeArray;
        }
        return $categories;
}
		// $list = $adapter->fetchAll("SELECT path FROM categories WHERE path NOT LIKE '%$categoryId%' ");	
		// print_r($list);
		// $pathArray = [];
		// $temp1 = [];
		// foreach ($list as $value) {
		// 	$pathArray[] = explode("/", $value['path']);
		// 	print_r($pathArray);
			
		// }
		// foreach ($pathArray as $key => $value2) {
			
		// 	$finalPath = implode("=>", $pathArray);
		// 	print_r($finalPath);
		// }
		



$path2 = editPath();
print_r($path2);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Category Edit</title>
</head>
<body>

	<form method="Post" action="index.php?a=save&c=categories">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Category Information</b></td>
			</tr>

			<tr>
				<td>Parent</td>
				<td>
					<select name="row[parentName]" class="form-control">

				        <?php echo "<option value='". $row['name'] ."'>" . $row['categoryId'] ."</option>" ;?>
				    
				    </select>

				</td>

			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="category[name]" value="<?php echo $row['name'] ?>"></td>
			</tr>

			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="category[status]">
					<?php if ($row['status']==1):?>
						<option value="1" selected>Active</option>
						<option value="2">Inactive</option>
					<?php else:?>
						<option value="1">Active</option>
						<option value="2" selected>Inactive</option>
					<?php endif; ?>	
					</select>
				</td>
				<input type="hidden" name="category[hiddenId]" value="<?php echo $row['categoryId'] ?>">
			</tr>
			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="index.php?a=grid&c=categories">Cancel</a></button> 

				</td>
			</tr>
			

		</table>
	</form>

</body>
</html>