<?php $actions = $this->getActions(); ?>
<?php $collections = $this->getCollection(); ?>
<?php $columns = $this->getColumns(); ?>


<script type="text/javascript">
	
	function funAction(url){
		admin.setUrl(url);
		admin.load();

	}
</script>


<select id="ppr">
	<option selected>select</option>
	<?php foreach($this->getPager()->getPerPageCountOption() as $perPageCount) :?>  
		<option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></option>
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
      <button class="btn btn-block btn-primary" type="button" id="addAdminBtn">Add New</button>
    </div>
  </div>
</div>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<?php foreach ($columns as $column) : ?>
				<?php foreach ($column as $key => $value) : ?>
					<?php if ($key == 'title' && $value) : ?>
						<th><?php echo $value ?></th>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!$collections): ?>
			<tr><td colspan="<?php echo $columnCount ?>">No Record available.</td></tr>
		<?php else:  ?>
			<?php foreach ($collections as $collection) : ?>
				<tr>
					<?php foreach ($collection->getData() as $columnName => $value) : ?>
						<?php foreach ($columns as $key => $column) : ?>
							<?php if ($key == $columnName) : ?>
								<td><?php echo $this->getColumnValue($collection, $key, $value); ?></td>
							<?php endif;  ?>
						<?php endforeach;?>
					<?php endforeach;?>
					<td>
						<?php foreach ($actions as $action) : ?>
							<?php $url = $action['method']; ?>
							<button type="button" class="btn btn-block btn-success" onclick ="funAction('<?php echo $this->$url($collection);?>')"><?php echo $action['title']; ?></button>&nbsp;
						<?php endforeach;?>
					</td>
				</tr>
			<?php endforeach;?>
		<?php endif;  ?>
	</tbody>
</table>

<script type="text/javascript"> 
	
	$("#ppr").click(function(){
        var data = $(this).val();
        admin.setUrl("<?php echo $this->getUrl('gridBlock',null,['p'=>1,'ppr'=>null]); ?>&ppr="+data);
        admin.setType('GET');
        admin.load();
  });
  $(".pagerBtn").click(function(){
    var data = $(this).val();
    admin.setUrl(data);
    admin.setType('GET');
    admin.load();
	});		

	$("#addAdminBtn").click(function(){
		admin.setType("GET");
		admin.setData({'id' : null});
		admin.setUrl("<?php echo $this->getUrl('edit');?>");
		admin.load();
	});
</script>