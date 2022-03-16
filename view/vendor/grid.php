<?php $vendors = $this->getVendors();?>

<button name="Add"><a href="<?php echo $this->getUrl('edit')?>">Add</a></button>
<table border='1' class="table" width='100%' cellspacing="4">
    <tr>
        <script type="text/javascript"> function count() 
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
        <td colspan="17"><b>Vendor Information</b></td>
    </tr>

    <tr>
        <th>Vendor Id</th>
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
        <th>Created Date</th>
        <th>Updated Date</th>
        <th>Edit</th>
        <th>Delete</th>

    </tr>
    <?php if (!$vendors): ?>
        <tr><td colspan="17">No data</td></tr>
    <?php else:  ?>      
        <?php foreach($vendors as $vendor): ?>
         
            <tr>
                <td><?php echo $vendor->vendorId?></td>
                <td><?php echo $vendor->firstName  ?></td>
                <td><?php echo $vendor->lastName   ?></td>
                <td><?php echo $vendor->email      ?></td>
                <td><?php echo $vendor->mobile     ?></td>
                <td><?php echo $vendor->getStatus($vendor->status) ?></td>
                <?php $address = $vendor->getVendorAddress();?>
                <td><?php echo $address->address    ?></td>
                <td><?php echo $address->postalCode ?></td>
                <td><?php echo $address->city       ?></td>
                <td><?php echo $address->state      ?></td>
                <td><?php echo $address->country    ?></td>
                <td><?php echo $vendor->createdDate?></td>
                <td><?php echo $vendor->updatedDate?></td>
                <td><a href="<?php echo $this->getUrl('edit', null, ['id' => $vendor->vendorId], true)?>">Edit</a></td>
                <td><a href="<?php echo $this->getUrl('delete', null, ['id' => $vendor->vendorId], true)?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

</table>
