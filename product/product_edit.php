<?php

include "Adapter.php";

$id = $_GET["id"];

$adapter=new Adapter();

$result = $adapter->fetchAll("select * from product_info where id =$id");

            foreach ($result as $row){
                
                echo "
        				<form method='post' action ='product_save.php'>
	        				<table>
	            
		           				<tr>
					                <td>Id</td>
					                <td><input type='number' name='id' value=".$row['id']."></td>
					            </tr>


					            <tr>
					                <td>Name</td>
					                <td><input type='text' name='name' value=".$row['name']."></td>
					            </tr>

					            <tr>
					                <td>Price</td>
					                <td><input type='number' name='price' value=".$row['price']."></td>
					            </tr>   

					          
					            <tr>
					                <td>Quantity</td>
					                <td><input type='number' name='quantity' value=".$row['quantity']."></td>
					            </tr>

					             <tr>
					                <td>Status</td>
					                <td><input type='number' name='status' value=".$row['status']."></td>
					            </tr>

					            <tr>
                
                					<td><input type='hidden' name='hid' value=".$row['id']."></td>
            					</tr>
					           

				        	</table>
				        	  
				        	<input type='submit' name='update' value ='Update'> 
			    		</form>

				";
            } 

?>