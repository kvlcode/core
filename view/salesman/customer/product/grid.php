<?php $products = $this->getProducts();?>
<?php $customerId = Ccc::getFront()->getRequest()->getRequest('id')?>

<form method="post" action="<?php echo $this->getUrl('save', 'salesman_customer_product', ['id' => $customerId])?>">
    <table border="1" width="100%" cellspacing="4">
        <tr>
           <td colspan="16"><b>Select Customer Price</b></td>
        </tr>
        <tr>
            <th>customerId</th>
            <th>Product Id</th>
            <th>Name</th>
            <th>Sku</th>
            <th>Map</th>
            <th>Price</th>
            <th>Customer Price</th>
        </tr>

        <?php if(!$products):?>
            <tr>
                <td colspan="10">No record Available</td>
            </tr>   
        <?php else:?>
            
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $customerId          ?></td>
                    <td><?php echo $product->productId  ?></td>
                    <td><?php echo $product->name       ?></td>
                    <td><?php echo $product->sku        ?></td>
                    <td><?php echo $product->map        ?></td>
                    <td><?php echo $product->productPrice   ?></td>
                    <td><input type="text" name="product[<?php if($product->entityId){echo 'exist';} else{echo 'new';}?>][<?php if($product->entityId){echo $product->entityId;} else{echo $product->productId;} ?>]" value="<?php echo $product->customerPrice ?>"></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>   
    </table>
    <input type="submit" value="Save">
    <button><a href="<?php echo $this->getUrl('grid','salesman'); ?>">Cancel</a></button>
</form>