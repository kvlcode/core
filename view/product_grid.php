<?php 

global $adapter;
$product = $adapter->fetchAll('SELECT * FROM product');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Grid</title>
</head>
<body>
    <button type="button" name="addNew"><a href="index.php?a=add&c=product"> Add New </a></button>
    <table border="1" width="100%" cellspacing="4">
        <tr>
           <td colspan="9"><b>Product Information</b></td>
        </tr>
        <tr>
            <th>Product Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php if(!$product):?>
            <tr>
                <td colspan="10">No record Available</td>
            </tr>   
        <?php else:?>
            
            <?php foreach ($product as $row): ?>
                <tr>
                    <td><?php echo $row['productId']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['createdDate']; ?></td>
                    <td><?php echo $row['updatedDate']; ?></td>
                    <td><a href="index.php?a=edit&c=product&id=<?php echo $row['productId']; ?>">Edit</a></td>
                    <td><a href="index.php?a=delete&c=product&id=<?php echo $row['productId']; ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?> 

        
    </table>

</body>
</html>