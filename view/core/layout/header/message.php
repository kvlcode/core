<?php $message = $this->getMessage()->getMessages(); ?>
<?php if($message): ?>
	<?php foreach ($message as $key => $value):?>
		<?php if($key == 'success'): ?>
			<label style="color: #00ff00;text-align: center;font-size: 25px;"><?php echo $value; ?><br> </label>
		<?php endif; ?>

		<?php if($key == 'error'): ?>
			<label style="color:#ff471a;text-align: center;font-size: 25px;"><?php echo $value; ?> <br> </label>
		<?php endif; ?>

		<?php if($key == 'warning'): ?>
			<label style="color:yellow;text-align: center;font-size: 25px;"><?php echo $value; ?> <br> </label>
		<?php endif ?>
		
	<?php endforeach; ?>
<?php endif; ?>
<?php $this->getMessage()->unsetMessages(); ?>


