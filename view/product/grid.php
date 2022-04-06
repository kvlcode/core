<?php $products = $this->getProducts();?>

<script type="text/javascript">  
    function productAction(url){
        admin.setUrl(url);
        admin.load();
    }
</script>

<select onchange="count()" id="count">
    <option selected>select</option>
    <?php foreach($this->getPager()->getPerPageCountOption() as $perPageCount) :?>  
        <option value="<?php echo $perPageCount ?>"><?php echo $perPageCount ?></a></option>
    <?php endforeach;?>
</select>

<nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item">
            <button  type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $this->getPager()->getStart()])?>">Start</button>
        </li>
        <li class="page-item">
            <button  type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $this->getPager()->getPrev()])?>">Prev</button>
        </li>
        <li class="page-item">
            <button type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $this->getPager()->getCurrent()])?>">Current</button>
        </li>
        <li class="page-item">
            <button type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $this->getPager()->getNext()])?>">Next</button>
        </li>
        <li class="page-item">
            <button type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $this->getPager()->getEnd()])?>">End</button>
        </li>
      </ul>
</nav>


<div class="row">
    <div class="col-md-2">
        <div class="card card-primary">
            <button type="button" class="btn btn-block btn-primary" name="addNew" id="addProductBtn">Add New</button>
        </div>
    </div>
</div>            
<table class="table table-bordered table-striped">
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
                
                <td><img src="<?php echo $product->getBase()->getImageUrl(); ?>" width = "50px" height = "50px" alt = "Image not found"></td>
                <td><img src="<?php echo $product->getThumbnail()->getImageUrl();?>" width = "50px" height = "50px" alt = "Image not found"></td>
                <td><img src="<?php echo $product->getSmall()->getImageUrl(); ?>" width = "50px" height = "50px" alt = "Image not found"></td>
                <td><button type="button" class="btn btn-block btn-success" onclick="productAction('<?php echo $this->getUrl('edit','product',['id' => $product->productId])?>')">Edit</button></td>
                <td><button type="button" class="btn btn-block btn-success" onclick="productAction('<?php echo $this->getUrl('delete','product',['id' => $product->productId])?>')">Delete</button></td>
                <td><a class="btn btn-block btn-success" href="<?php echo $this->getUrl('grid', 'product_media', ['id' => $product->productId]);?>">Media</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?> 
</table>


<script type="text/javascript"> 
    $("#addProductBtn").click(function(){
        admin.setType("GET");
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('edit');?>");
        admin.load();
    });

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