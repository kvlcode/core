<?php if ($this->getMessages()):?>
	<?php foreach ($this->getMessages() as $key => $value):?>
		<?php echo $value;?>
	<?php endforeach;?>	
<?php endif;?>	
<?php $this->unsetMessages();?>