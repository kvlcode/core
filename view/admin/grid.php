<?php $admins = $this->getAdmins();?>   
<button name="Add"><a href="<?php echo $this->getUrl('edit')?>">Add</a></button>    
<table border='1' class="table" width='100%' cellspacing="4">
    <tr> 
        <select onchange="count()" id="count">
            <option selected>select</option>
            <?php foreach($this->getPager()->getPerPageCountOption() as $perPageCount) :?>  
                <option value="<?php echo $perPageCount ?>"><?php echo $perPageCount ?></a></option>
            <?php endforeach;?>
        </select>
    </tr>

    <tr>
        <button><a style="<?php ($this->pager->getStart()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getStart()]) ?>">Start</a></button></tr>
        <tr><button><a style="<?php ($this->pager->getPrev()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getPrev()]) ?>">Prev</a></button>
        &nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<b>".$this->pager->getCurrent()."</b>"?>&nbsp;&nbsp;&nbsp;&nbsp;</tr>
        <tr><button><a style="<?php ($this->pager->getNext()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getNext()]) ?>">Next</a></button></tr>
        <tr><button><a style="<?php ($this->pager->getEnd()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getEnd()]) ?>">End</a></button>
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
<script type="text/javascript"> 
    function count() 
    {
        const countValue = document.getElementById('count').selectedOptions[0].value;
        let language = window.location.href;
        if(!language.includes('count'))
        {
            language+='&count=20';
        }
        const myArray = language.split("&");
        for (i = 0; i < myArray.length; i++)
        {
          if(myArray[i].includes('p='))
          {
              myArray[i]='p=1';
          }
          if(myArray[i].includes('count='))
          {
              myArray[i]='count='+countValue;
          }
        }
         const str = myArray.join("&");  
         location.replace(str);
    }
</script>  