<?php $orders = $this->getOrders();?>
<form method="post" action="<?php echo $this->getUrl('edit', 'cart')?>">
	<input type="submit" name="Add New" value="Add New">
</form>

<table border="1" width="100%" cellspacing="4">

	<tr>
		<th>Order Id</th>
		<th>First Name</th>
        <th>Last Name</th>
        <th>Shipping Id</th>
        <th>Payment Id</th>
        <th>Status</th>
        <th>State</th>
        <th>View</th>
        <th>Delete</th>
	</tr>


	<?php if (!$orders): ?>
        <tr><td colspan="17">No data</td></tr>
    <?php else:  ?>      
        <?php foreach($orders as $order): ?>
         
            <tr>
                <td><?php echo $order->orderId?></td>
                <td><?php echo $order->firstName  ?></td>
                <td><?php echo $order->lastName   ?></td>
                <td><?php echo $order->shippingId   ?></td>
                <td><?php echo $order->paymentId   ?></td>
                <td><?php echo $order->getStatus($order->status) ?></td>
                <td><?php echo $order->getState($order->state) ?></td>
                <td><a href="<?php echo $this->getUrl('edit', 'order', ['orderId' => $order->orderId])?>">View</a></td>
                <td><a href="<?php echo $this->getUrl('delete', null, ['orderId' => $order->orderId], true)?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>