<?php if ($this->getMessages()):?>
	<?php foreach ($this->getMessages() as $key => $value):?>
		<?php $textColor;
			if ($key == "error") {
				$textColor = "red";
			}
			elseif ($key == "success") {
				$textColor = "green";
			}
			elseif($key == "warning"){
				$textColor = "yellow";
			}
		?>
		<label style="color:<?php echo $textColor;?>"><?php echo $value; ?> <br></label>
	<?php endforeach;?>	
<?php endif;?>	
<?php $this->unsetMessages();?>