<?php $tabs = $this->getTabs(); ?>
<?php foreach ($tabs as $key => $value): ?>
	<button type="button" class="btn btn-default" onclick="tab('<?php if($this->getCurrentTab() != $key){ echo $value['url']; }?>')"><?php echo $value['title'] ?></button>
<?php endforeach; ?>

<script type="text/javascript">
	function tab(url){
		admin.setUrl(url);
		admin.load();
	}
</script>
