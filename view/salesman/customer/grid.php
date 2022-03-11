<?php $customers = $this->getCustomers();?>
<?php $salesmanId = Ccc::getFront()->getRequest()->getRequest('id');?>
<form action="<?php echo $this->getUrl('save','salesman_customer',['id'=> $salesmanId]) ?>" method="post">
    
    <table border="1" width="100%">
        <tr>
            <th>Select</th>
            <th>Customer Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Set Price</th>
        </tr>
        <?php if(!$customers): ?>
                <tr>
                    <td colspan="4">No Recored </td>
                </tr>
        <?php else: ?>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><input type="checkbox" name="customer[]" value="<?php echo $customer->customerId; ?>" <?php echo $this->getSelect($customer->customerId);?>></td>
                    <td><?php echo $customer->customerId; ?></td>
                    <td><?php echo $customer->firstName; ?></td>
                    <td><?php echo $customer->lastName; ?></td>
                    <td><a href="<?php echo $this->getUrl('grid', 'salesman_customer_product', ['id' => $salesmanId]);?>">set price</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <input type="submit" value="Update">
    <button><a href="<?php echo $this->getUrl('grid','salesman'); ?>">Cancel</a></button>
</form>