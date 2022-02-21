<?php $products = $this->getProducts(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Grid</title>
</head>
<body>
    <button type="button" name="addNew"><a href="<?php echo $this->getUrl('product','add')?>"> Add New </a></button>
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

        <?php if(!$products):?>
            <tr>
                <td colspan="10">No record Available</td>
            </tr>   
        <?php else:?>
            
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['productId']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td><?php echo $product['status']; ?></td>
                    <td><?php echo $product['createdDate']; ?></td>
                    <td><?php echo $product['updatedDate']; ?></td>
                    <td><a href="<?php echo $this->getUrl('product','edit',['id' =>  $product['productId']])?>">Edit</a></td>
                    <td><a href="<?php echo $this->getUrl('product','delete',['id' => $product['productId']]);?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?> 
  
    </table>

</body>
</html>