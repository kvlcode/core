
<?php
echo "<pre>";

include "Adapter.php";

$adapter=new Adapter();


$result=$adapter->fetchAll("select * from product_info");


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
   

    <title>Product Grid</title>
</head>

<body>
                        
    <div>
          <form method='post' action='product_add.php'>

                <input type='submit' name='add_product' Value='Add New'>
                
        </form>
        
        <table border='1' class="table" width='100%'>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Updated Date</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>


                </tr>
            </thead>
            <tbody>

                <?php 
                
                foreach ($result as $row) {
                 
                        echo"<tr>
                            <td >".$row['id']."</td>
                            <td>".$row['name']."</td>
                            <td>".$row['price']."</td>
                            <td>".$row['quantity']."</td>
                            <td>".$row['status']."</td>
                            <td>".$row['created_date']."</td>
                            <td>".$row['updated_date']."</td>
                            <td><a href='product_edit.php?id= $row[id]'>Edit</a></td>
                            <td><a href='product_delete.php?id= $row[id]'>Delete</a></td>
                        </tr>";
                        
                }
                

                    
                ?>

            </tbody>
        </table>
    </div>

   
</body>

</html>