<?php $admin = $this->getAdmin();?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Grid</title>
</head>

<body>               
    <div>    
        <button name="Add"><a href="<?php echo $this->getUrl('edit', 'admin')?>">Add</a></button>    
        <table border='1' class="table" width='100%' cellspacing="4">
                
                <tr>
                    <td colspan="10"><b>Admin Information</b></td>
                </tr>

                <tr>
                    <th>Admin Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <?php if (!$admin): ?>
                    <tr><td colspan="8">No data</td></tr>
                <?php else:  ?>      
                    <?php foreach($admin as $row): ?>
                     
                        <tr>
                            <td><?php echo $row->adminId     ?></td>
                            <td><?php echo $row->firstName   ?></td>
                            <td><?php echo $row->lastName    ?></td>
                            <td><?php echo $row->email       ?></td>
                            <td><?php echo $row->password    ?></td>
                            <td><?php echo $row->status      ?></td>
                            <td><?php echo $row->createdDate ?></td>
                            <td><?php echo $row->updatedDate ?></td>
                            <td><a href="<?php echo $this->getUrl('edit','admin',['id' => $row->adminId])?>">Edit</a></td>
                            <td><a href="<?php echo $this->getUrl('delete','admin',['id' => $row->adminId])?>">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

        </table>
    </div>

</body>
</html>