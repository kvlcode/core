<?php $products = $this->getProducts();?>

<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit')?>"> Add New </a></button>
<table border="1" width="100%" cellspacing="4">
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
       <td colspan="16"><b>Product Information</b></td>
    </tr>
    <tr>
        <th>Product Id</th>
        <th>Name</th>
        <th>Sku</th>
        <th>Map</th>
        <th>Cost Price</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Status</th>
        <th>Created Date</th>
        <th>Updated Date</th>
        <th>Base</th>
        <th>Thumbnail</th>
        <th>Small</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Media</th>
    </tr>

    <?php if(!$products):?>
        <tr>
            <td colspan="10">No record Available</td>
        </tr>   
    <?php else:?>
        
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product->productId  ?></td>
                <td><?php echo $product->name       ?></td>
                <td><?php echo $product->sku        ?></td>
                <td><?php echo $product->map        ?></td>
                <td><?php echo $product->costPrice  ?></td>
                <td><?php echo $product->price      ?></td>
                <td><?php echo $product->quantity   ?></td>
                <td><?php echo $product->getStatus($product->status) ?></td>
                <td><?php echo $product->createdDate ?></td>
                <td><?php echo $product->updatedDate ?></td>
                
                <td> <img src="<?php echo 'Media/Product/'.$product->getBase()->name; ?>" width = "50px" hieght = "50px" alt = "Image not found"></td>
                <td><img src="<?php echo 'Media/Product/'.$product->getThumbnail()->name; ?>" width = "50px" hieght = "50px" alt = "Image not found"></td>
                <td><img src="<?php echo 'Media/Product/'.$product->getSmall()->name ?>" width = "50px" hieght = "50px" alt = "Image not found"></td>
                <td><a href="<?php echo $this->getUrl('edit', null, ['id' =>  $product->productId], true)?>">Edit</a></td>
                <td><a href="<?php echo $this->getUrl('delete', null, ['id' => $product->productId], true);?>">Delete</a></td>
                <td><a href="<?php echo $this->getUrl('grid', 'product_media', ['id' => $product->productId]);?>">Media</a></td>
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