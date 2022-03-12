<?php $salesmanId = Ccc::getFront()->getRequest()->getRequest('salesmanId')?>
<?php $customerId = Ccc::getFront()->getRequest()->getRequest('id')?>
<?php $products = $this->getProducts($customerId);?>
<?php $discount = $this->getDiscount($salesmanId);?>

<form method="post" action="<?php echo $this->getUrl('save', 'salesman_customer_product', ['salesmanId' => $salesmanId])?>">
    <table border="1" width="100%" cellspacing="4">
        <tr>
           <td colspan="16"><b>Select Customer Price</b></td>
        </tr>
        <tr>
            <th>Product Id</th>
            <th>Name</th>
            <th>Sku</th>
            <th>MRP</th>
            <th>Salesman Price</th>
            <th>Customer Price</th>
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
                    <td><?php echo $product->sku        ?></td>
                    <td><?php echo $product->productPrice   ?></td>
                    <td><?php echo $ce = $this->getSalesmanPrice($product->productPrice, $discount)?></td>
                    <td><input type="number" name="product[<?php if($product->entityId){echo 'exist';} else{echo 'new';}?>][<?php if($product->entityId){echo $product->entityId;} else{echo $product->productId;} ?>]" value="<?php echo $product->customerPrice ?>" min="<?php echo $ce; ?>" max="<?php echo $product->productPrice; ?>" step="0.01" ></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>   
    </table>
    <input type="submit" value="Save">
    <button><a href="<?php echo $this->getUrl('grid','salesman'); ?>">Cancel</a></button>
</form>