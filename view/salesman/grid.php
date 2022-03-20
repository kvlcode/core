<?php $salesmen = $this->getSalesman();?>
             
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
            <option>select</option>
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