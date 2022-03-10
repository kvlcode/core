<?php $salesmen = $this->getSalesman();?>
             
    <button name="Add"><a href="<?php echo $this->getUrl('edit')?>">Add</a></button>
    <table border='1' class="table" width='100%' cellspacing="4">
            
        <tr>
            <td colspan="11"><b>Salesman Information</b></td>
        </tr>

        <tr>
            <th>Salesman Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Assign Customer</th>

        </tr>
        <?php if (!$salesmen): ?>
            <tr><td colspan="17">No data</td></tr>
        <?php else:  ?>      
            <?php foreach($salesmen as $salesman): ?>
             
                <tr>
                    <td><?php echo $salesman->salesmanId?></td>
                    <td><?php echo $salesman->firstName  ?></td>
                    <td><?php echo $salesman->lastName   ?></td>
                    <td><?php echo $salesman->email      ?></td>
                    <td><?php echo $salesman->mobile     ?></td>
                    <td><?php echo $salesman->getStatus($salesman->status) ?></td>
                    <td><?php echo $salesman->createdDate?></td>
                    <td><?php echo $salesman->updatedDate?></td>

                    <td><a href="<?php echo $this->getUrl('edit', null, ['id' => $salesman->salesmanId], true)?>">Edit</a></td>
                    <td><a href="<?php echo $this->getUrl('delete', null, ['id' => $salesman->salesmanId], true)?>">Delete</a></td>
                    <td><a href="<?php echo $this->getUrl('grid', 'salesman_customer', ['id' => $salesman->salesmanId])?>">Assign</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

    </table>