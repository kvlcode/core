<?php $pages = $this->getPages();?>

    <button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit')?>"> Add New </a></button>
    <table border="1" width="100%" cellspacing="4">
        <tr>
           <td colspan="9"><b>page Information</b></td>
        </tr>
        <tr>
            <th>Page Id</th>
            <th>Name</th>
            <th>Code</th>
            <th>Content</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php if(!$pages):?>
            <tr>
                <td colspan="10">No record Available</td>
            </tr>   
        <?php else:?>
            
            <?php foreach ($pages as $page): ?>
                <tr>
                    <td><?php echo $page->pageId ?></td>
                    <td><?php echo $page->name ?></td>
                    <td><?php echo $page->code ?></td>
                    <td><?php echo $page->content ?></td>
                    <td><?php echo $page->getStatus($page->status) ?></td>
                    <td><?php echo $page->createdDate ?></td>
                    <td><?php echo $page->updatedDate ?></td>
                    <td><a href="<?php echo $this->getUrl('edit', null, ['id' =>  $page->pageId], true)?>">Edit</a></td>
                    <td><a href="<?php echo $this->getUrl('delete', null, ['id' => $page->pageId], true);?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?> 
  
    </table>