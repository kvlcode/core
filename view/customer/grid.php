<?php $customers = $this->getCustomers();?>
                      
        <button name="Add"><a href="<?php echo $this->getUrl('edit')?>">Add</a></button>
        
        <table border='1' class="table" width='100%' cellspacing="4">
                
            <tr>
                <td colspan="17"><b>Customer Information</b></td>
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
                <th>Billing</th>
                <th>Shipping</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
            <?php if (!$customers): ?>
                <tr><td colspan="17">No data</td></tr>
            <?php else:  ?>      
                <?php foreach($customers as $customer): ?>
                 
                    <tr>
                        <td><?php echo $customer->customerId?></td>
                        <td><?php echo $customer->firstName  ?></td>
                        <td><?php echo $customer->lastName   ?></td>
                        <td><?php echo $customer->email      ?></td>
                        <td><?php echo $customer->mobile     ?></td>
                        <td><?php echo $customer->getStatus($customer->status) ?></td>
                        <td><?php echo $customer->address    ?></td>
                        <td><?php echo $customer->postalCode ?></td>
                        <td><?php echo $customer->city       ?></td>
                        <td><?php echo $customer->state      ?></td>
                        <td><?php echo $customer->country    ?></td>
                        <td><?php echo $customer->billing    ?></td>
                        <td><?php echo $customer->shipping   ?></td>
                        <td><?php echo $customer->createdDate?></td>
                        <td><?php echo $customer->updatedDate?></td>
                        <td><a href="<?php echo $this->getUrl('edit', null, ['id' => $customer->customerId], true)?>">Edit</a></td>
                        <td><a href="<?php echo $this->getUrl('delete', null, ['id' => $customer->customerId], true)?>">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </table>