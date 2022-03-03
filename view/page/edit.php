<?php $page = $this->getPage();?>
	<form method="post" action="<?php echo $this->getUrl('save', null, null, true)?>">
		<table border="1" width="100%" cellspacing="4">

			<tr>
				<td colspan="2"><b>Page Information</b></td>
			</tr>

			<tr>
				<td width="10%">Page Name</td>
				<td><input type="text" name="page[name]" value="<?php echo $page->name ?>"></td>
			</tr>

			<tr>
				<td width="10%">Code</td>
				<td><input type="text" name="page[code]" value="<?php echo $page->code ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Content</td>
				<td><input type="text" name="page[content]" value="<?php echo $page->content ?>"></td>
				<input type="hidden" name="page[pageId]" value="<?php echo $page->pageId ?>">
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
					<input type="submit" name="Save">
					<button type="button"><a href="<?php echo $this->getUrl(null, null, null, true)?>">Cancel</a></button> 

				</td>
			</tr>
		</table>
	</form>