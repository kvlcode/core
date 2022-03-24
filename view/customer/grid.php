<?php $customers = $this->getCustomers();?>
                      
<button name="Add Cart"><a href="<?php echo $this->getUrl('grid','cart'); ?>">Add Cart</a></button>                      
<button name="Add"><a href="<?php echo $this->getUrl('edit')?>">Add Customer</a></button>
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
        <td colspan="6"><b>Personal Information</b></td>
        <td colspan="5"><b>Billing Address</b></td>
        <td colspan="5"><b>Shipping Address</b></td>
        <td colspan="5"><b>Date & Action</b></td>
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
                <?php $billingAddress = $customer->getBillingAddresses();?>
                <td><?php echo $billingAddress->address    ?></td>
                <td><?php echo $billingAddress->postalCode ?></td>
                <td><?php echo $billingAddress->city       ?></td>
                <td><?php echo $billingAddress->state      ?></td>
                <td><?php echo $billingAddress->country    ?></td>
                <?php $shippingAddress = $customer->getShippingAddresses();?>
                <td><?php echo $shippingAddress->address    ?></td>
                <td><?php echo $shippingAddress->postalCode ?></td>
                <td><?php echo $shippingAddress->city       ?></td>
                <td><?php echo $shippingAddress->state      ?></td>
                <td><?php echo $shippingAddress->country    ?></td>     
                <td><?php echo $customer->createdDate?></td>
                <td><?php echo $customer->updatedDate?></td>
                <td><a href="<?php echo $this->getUrl('edit', null, ['id' => $customer->customerId], true)?>">Edit</a></td>
                <td><a href="<?php echo $this->getUrl('delete', null, ['id' => $customer->customerId], true)?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

</table>