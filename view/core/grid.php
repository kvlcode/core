<?php $actions = $this->getActions(); ?>
<?php $collections = $this->getCollection(); ?>
<?php $columns = $this->getColumns(); ?>
<?php $columnCount = count($this->getColumns()) + 1; ?>
<?php $controller = Ccc::getFront()->getRequest()->getRequest('c'); ?>

<table>
	<tr>
		<script type="text/javascript">
			$("#addAdminBtn").click(function(){
				admin.setUrl("<?php echo $this->getUrl('addBlock'); ?>");
				admin.load();
			});

			function action(url){
				alert(url);
			}

		</script>

		<script type="text/javascript"> 
    	function ppr() 
      	{
	        const value = document.getElementById('ppr').selectedOptions[0].value;
	        var url = window.location.href;

	        if(!url.includes('ppr'))
	        {
	            url+='&ppr=20';
	        }
	        const myArray = url.split("&");
	        for (i = 0; i < myArray.length; i++)
	        {
	          if(myArray[i].includes('p='))
	          {
	              myArray[i]='p=1';
	          }
	          if(myArray[i].includes('ppr='))
	          {
	              myArray[i]='ppr='+value;
	          }
	        }
	         const str = myArray.join("&");  
	         location.replace(str);
      	}
    	</script>
    <select onchange="ppr()" id="ppr">
      <option selected>select</option>
      <?php foreach($this->getPager()->getPerPageCountOption() as $perPageCount) :?>  
      <option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></option>
      <?php endforeach;?>
    </select>
	<button type="button" name="Next">
     	<a href="<?php echo $this->getUrl('grid','admin',['page' => $this->getPager()->getNext()])?>"> Next </a>
    </button>
	<button type="button" name="End">
		<a href="<?php echo $this->getUrl('grid','admin',['page' => $this->getPager()->getEnd()])?>"> End </a>
	</button>
	<button type="button" name="Current">
		<a href="<?php echo $this->getUrl('grid','admin',['page' => $this->getPager()->getCurrent()])?>"> Current </a>
	</button>
	<button type="button" name="Start">
		<a href="<?php echo $this->getUrl('grid','admin',['page' => $this->getPager()->getStart()])?>"> Start </a>
	</button>
	<button type="button" name="Prev">
		<a href="<?php echo $this->getUrl('grid','admin',['page' => $this->getPager()->getPrev()])?>"> Prev </a>
	</button>
	</tr>
</table>

<div>
	<form method="post" action="">
		<button id="addAdminBtn" type="button">Add New</button>
		<table border="1" width="100%" cellspacing="4">
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
									<button onclick ="action('<?php echo $this->$url($collection);?>')"><?php echo $action['title']; ?></button>&nbsp;
								<?php endforeach;?>
							</td>
						</tr>
					<?php endforeach;?>
				<?php endif;  ?>
			
			</tbody>
		</table>
	</form>
</div>

