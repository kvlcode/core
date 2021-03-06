<?php $categories = $this->getCategories(); ?>

<script type="text/javascript">
	function categoryAction(url)
	{
		admin.setUrl(url);
		alert(admin.getUrl());
        admin.load();
	}
</script>
<div class="row">
	<div class="col-md-2">
    <div class="card card-primary">
			<button type="button" name="addCategory" class="btn btn-block btn-primary" id="addCategoryBtn">Add New</button>
		</div>
	</div>
</div>

<table class="table table-bordered table-striped">
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
		<th>CategoryId</th>
		<th>Path</th>
		<th>Name</th>
		<th>Status</th>
		<th>Created_Date</th>
		<th>Updated_Date</th>
		<th>Base</th>
    <th>Thumbnail</th>
    <th>Small</th>
		<th>Edit</th>
		<th>Delete</th>
		<th>Media</th>
	</tr>

	<?php if(!$categories):?>
		<tr>
			<td colspan="7">No record Available</td>
		</tr>	
	<?php else:?>
		
		<?php foreach ($categories as $category): ?>
			<tr>
				<td><?php echo $category->categoryId ?></td>
				<td><?php echo $this->path($category->path)  ?></td>
				<td><?php echo $category->name  ?></td>
				<td><?php echo $category->getStatus($category->status) ?></td>
				<td><?php echo $category->createdDate ?></td>
				<td><?php echo $category->updatedDate ?></td>
        <td><img src="<?php echo $category->getBase()->getImageUrl(); ?>" width = "50px" height = "50px" alt = "Image not found"></td>
        <td><img src="<?php echo $category->getThumbnail()->getImageUrl();?>" width = "50px" height = "50px" alt = "Image not found"></td>
        <td><img src="<?php echo $category->getSmall()->getImageUrl(); ?>" width = "50px" height = "50px" alt = "Image not found"></td>
				<td><button class="btn btn-block btn-success" onclick="<?php echo $this->getUrl('edit', null, ['id' => $category->categoryId], true)?>">Edit</button></td>
				<td><a class="btn btn-block btn-success" href="<?php echo $this->getUrl('delete', null, ['id' => $category->categoryId], true)?>">Delete</a></td>
				<td><a class="btn btn-block btn-success" href="<?php echo $this->getUrl('grid', 'category_media', ['id' => $category->categoryId]);?>">Media</a></td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>	
</table>

<script type="text/javascript">
	$("#addCategoryBtn").click(function(){
		admin.setType("GET");
		admin.setData({'id' : null});
	  admin.setUrl("<?php echo $this->getUrl('edit'); ?>");
	  admin.load();
	});
</script>

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