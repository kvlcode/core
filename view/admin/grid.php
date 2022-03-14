<?php $admins = $this->getAdmins();?>
   
<button name="Add"><a href="<?php echo $this->getUrl('edit')?>">Add</a></button>    
<table border='1' class="table" width='100%' cellspacing="4">

        <tr>
            <td colspan="10">
                <button><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getStart()], true); ?>">Start</a></button>
                <button><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getPrev()], true); ?>">Previous</a></button>
                <b><?php echo $this->getPager()->getCurrent();?></b>
                <button><a href="<?php if($this->getPager()->getEnd() != null){ echo $this->getUrl(null,null,['p'=>$this->getPager()->getNext()], true);} ?>">Next</a></button>
                <button><a href="<?php if($this->getPager()->getEnd() != null){ echo $this->getUrl(null,null,['p'=>$this->getPager()->getEnd()], true);} ?>">End</a></button>
            </td>
        </tr>
        
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

        <?php if (!$admins): ?>
            <tr><td colspan="8">No data</td></tr>
        <?php else:  ?>      
            <?php foreach($admins as $admin): ?>
             
                <tr>
                    <td><?php echo $admin->adminId     ?></td>
                    <td><?php echo $admin->firstName   ?></td>
                    <td><?php echo $admin->lastName    ?></td>
                    <td><?php echo $admin->email       ?></td>
                    <td><?php echo $admin->password    ?></td>
                    <td><?php echo $admin->getStatus($admin->status);?></td>
                    <td><?php echo $admin->createdDate ?></td>
                    <td><?php echo $admin->updatedDate ?></td>
                    <td><a href="<?php echo $this->getUrl('edit', null, ['id' => $admin->adminId], true)?>">Edit</a></td>
                    <td><a href="<?php echo $this->getUrl('delete', null, ['id' => $admin->adminId], true)?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

</table>