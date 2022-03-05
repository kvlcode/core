<?php $products = $this->getProducts();?>

    <button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit')?>"> Add New </a></button>
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
                    <td><?php echo $product->getStatus($product->status) ?></td>
                    <td><?php echo $product->createdDate ?></td>
                    <td><?php echo $product->updatedDate ?></td>

                    <td> <img src="<?php echo 'Media/Product/'.$product->baseImage ?>" width = "50px" hieght = "50px" alt = "Image not found"></td>
                    <td><img src="<?php echo 'Media/Product/'.$product->thumbImage ?>" width = "50px" hieght = "50px" alt = "Image not found"></td>
                    <td><img src="<?php echo 'Media/Product/'.$product->smallImage ?>" width = "50px" hieght = "50px" alt = "Image not found"></td>
                    <td><a href="<?php echo $this->getUrl('edit', null, ['id' =>  $product->productId], true)?>">Edit</a></td>
                    <td><a href="<?php echo $this->getUrl('delete', null, ['id' => $product->productId], true);?>">Delete</a></td>
                    <td><a href="<?php echo $this->getUrl('grid', 'product_media', ['id' => $product->productId]);?>">Media</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?> 
  
    </table>