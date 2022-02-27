<?php $products = $this->getProducts(); 
      
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Grid</title>
</head>
<body>
    <button type="button" name="addNew"><a href="<?php echo $this->getUrl('add','product')?>"> Add New </a></button>
    <table border="1" width="100%" cellspacing="4">
        <tr>
           <td colspan="13"><b>Product Information</b></td>
        </tr>
        <tr>
            <th>Product Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Base</th>
            <th>Thumbnail</th>
            <th>Small</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Media</th>
        </tr>

        <?php if(!$products):?>
            <tr>
                <td colspan="10">No record Available</td>
            </tr>   
        <?php else:?>
            
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product->productId  ?></td>
                    <td><?php echo $product->name       ?></td>
                    <td><?php echo $product->price      ?></td>
                    <td><?php echo $product->quantity   ?></td>
                    <td><?php echo $product->status     ?></td>
                    <td><?php echo $product->createdDate ?></td>
                    <td><?php echo $product->updatedDate ?></td>
                    <td><?php echo $product->baseImage ?></td>
                    <td><?php echo $product->thumbImage ?></td>
                    <td><?php echo $product->smallImage ?></td>
                    <td><a href="<?php echo $this->getUrl('edit', 'product', ['id' =>  $product->productId])?>">Edit</a></td>
                    <td><a href="<?php echo $this->getUrl('delete', 'product', ['id' => $product->productId]);?>">Delete</a></td>
                    <td><a href="<?php echo $this->getUrl('grid', 'product_media', ['id' => $product->productId]);?>">Media</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?> 
  
    </table>

</body>
</html>