<?php

require_once('Adapter.php');
$adapter=new Adapter();

// $customer =$adapter->fetchAll("select*from customer");

$customer = $adapter->fetchAll("SELECT c.*,a.*
                            FROM customer c
                            JOIN address a
                            ON a.customerId = c.customerId");

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Grid</title>
</head>

<body>
                        
    <div>
            <button name="Add"><a href="customer.php?a=addAction">Add</a></button>
        
        <table border='1' class="table" width='100%' cellspacing="4">
                
                <tr>
                    <td colspan="15"><b>Customer Information</b></td>
                </tr>

                <tr>
                    <th>Customer Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
                <?php if (!$customer): ?>
                    <tr><td colspan="13">No data</td></tr>
                <?php else:  ?>      
                    <?php foreach($customer as $row): ?>
                     
                        <tr>
                            <td><?php echo $row['customerId']?></td>
                            <td><?php echo $row['firstName']  ?></td>
                            <td><?php echo $row['lastName']   ?></td>
                            <td><?php echo $row['email']      ?></td>
                            <td><?php echo $row['mobile']     ?></td>
                            <td><?php echo $row['status']     ?></td>
                            <td><?php echo $row['address']    ?></td>
                            <td><?php echo $row['postalCode'] ?></td>
                            <td><?php echo $row['city']       ?></td>
                            <td><?php echo $row['state']      ?></td>
                            <td><?php echo $row['country']    ?></td>
                            <td><?php echo $row['createdDate']?></td>
                            <td><?php echo $row['updatedDate']?></td>
                            <td><a href="customer.php?a=editAction&id=<?php echo $row['customerId']?>">Edit</a></td>
                            <td><a href="customer.php?a=deleteAction&id=<?php echo $row['customerId']?>">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

        </table>
    </div>

</body>
</html>