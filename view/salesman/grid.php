<?php $salesmen = $this->getSalesman();?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salesman Grid</title>
</head>

<body>
                      
    <button name="Add"><a href="<?php echo $this->getUrl('edit','salesman')?>">Add</a></button>
    <table border='1' class="table" width='100%' cellspacing="4">
            
        <tr>
            <td colspan="10"><b>Salesman Information</b></td>
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
                    <td><?php echo $salesman->status     ?></td>
                    <td><?php echo $salesman->createdDate?></td>
                    <td><?php echo $salesman->updatedDate?></td>
                    <td><a href="<?php echo $this->getUrl('edit', 'salesman',['id' => $salesman->salesmanId])?>">Edit</a></td>
                    <td><a href="<?php echo $this->getUrl('delete','salesman',['id' => $salesman->salesmanId])?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

    </table>
   
</body>
</html>