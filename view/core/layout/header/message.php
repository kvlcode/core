<?php $message = $this->getMessage()->getMessages(); ?>
<?php if($message): ?>
	<?php foreach ($message as $key => $value):?>
		<?php if($key == 'sucess'): ?>
			<label style="color:green;text-align: center"><?php echo $value; ?><br> </label>
		<?php endif; ?>

		<?php if($key == 'error'): ?>
			<label style="color:red;text-align: center"><?php echo $value; ?> <br> </label>
		<?php endif; ?>

		<?php if($key == 'warning'): ?>
			<label style="color:yellow;text-align: center"><?php echo $value; ?> <br> </label>
		<?php endif ?>
		
	<?php endforeach; ?>
<?php endif; ?>
<?php $this->getMessage()->unsetMessages(); ?>


