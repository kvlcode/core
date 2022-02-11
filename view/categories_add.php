<?php
global $adapter;
$categories = $adapter->fetchAll("SELECT name 
									FROM categories");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Categories Add</title>
</head>
<body>

	<form method="post" action="index.php?a=test&c=categories">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Categories Information</b></td>
			</tr>

			<tr>
			    <td width="10%">Parent Id</td>
			      <td>
			      <select name="category[parentName]" class="form-control">
			      <option value="0">Root</option>
			        <?php
			        if(!$categories): 
			          echo 'No data';
			        endif;
			          foreach($categories as $category) :?>
			            <?php
			            echo "<option value='". $category['name'] ."'>" .$category['name'] ."</option>" ;
			          endforeach;
			        ?>
			      </select>
			    </td>
			 </tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="category[name]"></td>
			</tr>
			
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="category[status]">
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit">
					<button type="button"><a href="index.php?a=grid&c=categories">Cancel</a></button> 
				</td>
			</tr>
			

		</table>
	</form>



</body>
</html>