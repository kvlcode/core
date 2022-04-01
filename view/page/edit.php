<?php $page = $this->getPage();?>
	<script type="text/javascript">
		page = {
			form : null,

			setForm : function(form){
				this.form = jQuery("#"+form);
				return this;
			},
			getForm : function(){
				return this.form;
			},
			setData : function(data) {
				this.data = data;
				return this;
			},
			getData : function(){
				return this.data;
			},
			validate : function() {
				var canSubmit = true;
				if(!jQuery("#name").val()){
					alert("Please Enter Name");
					canSubmit = false;
				}
				if (!jQuery("#code").val()) {
					alert("Please Enter Code");
					canSubmit = false;

				}
				if(!jQuery("#content").val()){
					alert("Please Enter Content");
					canSubmit = false;
				}
				if(canSubmit == true){
					// alert("Submitted");
					this.callAjax();
				}
				return false;
			},
			callAjax : function() {
				$.ajax({
					type: "POST",
					url: "<?php echo $this->getUrl('save');?>",
					data: jQuery('#page-form').serializeArray(),
					sucess: function(data) {
							alert(data);
					},
					dataType : "json"
				})
			}
		};
	</script>
	<form id="page-form">
		<table border="1" width="100%" cellspacing="4">

			<tr>
				<td colspan="2"><b>Page Information</b></td>
			</tr>

			<tr>
				<td width="10%">Page Name</td>
				<td><input type="text" id="name" name="page[name]" value="<?php echo $page->name ?>"></td>
			</tr>

			<tr>
				<td width="10%">Code</td>
				<td><input type="text" id="code" name="page[code]" value="<?php echo $page->code ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Content</td>
				<td><input type="text" id="content" name="page[content]" value="<?php echo $page->content ?>"></td>
			</tr>
					
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="page[status]">
					<?php foreach ($page->getStatus() as $key => $value):?>
						<option value="<?php echo $key;?>" <?php if($page->status == $key){?> selected <?php }?>> <?php echo $value;?></option>

					<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="button" onclick="admin.setForm('#page-form').load()" name="Save" value="save">
					<button type="button"><a href="<?php echo $this->getUrl(null, null, null, true)?>">Cancel</a></button> 

				</td>
			</tr>
		</table>
	</form>
	<script type="text/javascript">
		page.setForm('page-form');
	</script>