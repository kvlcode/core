<?php echo $this->getMessage()->toHtml();?>
<?php foreach ($this->getChildren() as $key => $child):?>
	<?php echo $child->toHtml();?>
<?php endforeach;?>	
