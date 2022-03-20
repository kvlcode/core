<?php $pages = $this->getPages();?>

<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit', null, ['p' => $this->pager->getCurrent()])?>"> Add New </a></button>
    <table border="1" width="100%" cellspacing="4">
        <tr>
            <script type="text/javascript"> 
            function count() 
            {
                const countValue = document.getElementById('ppr').selectedOptions[0].value;
                let language = window.location.href;
                if(!language.includes('ppr'))
                {
                    language+='&ppr=20';
                }
                const myArray = language.split("&");
                for (i = 0; i < myArray.length; i++)
                {
                  if(myArray[i].includes('p='))
                  {
                      myArray[i]='p=1';
                  }
                  if(myArray[i].includes('ppr='))
                  {
                      myArray[i]='ppr='+countValue;
                  }
                }
                const str = myArray.join("&");  
                location.replace(str);
            }

            </script>   
            <select onchange="count()" id="ppr">
                <option>select</option>
                <?php foreach($this->getPager()->getPerPageCountOption() as $perPageCount) :?>  
                    <option value="<?php echo $perPageCount ?>"><?php echo $perPageCount ?></option>
                <?php endforeach;?>
            </select>
        </tr>

        <tr>
            <button><a style="<?php ($this->pager->getStart()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getStart()]) ?>">Start</a></button></tr>
            <tr><button><a style="<?php ($this->pager->getPrev()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getPrev()]) ?>">Prev</a></button>
            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<b>".$this->pager->getCurrent()."</b>"?>&nbsp;&nbsp;&nbsp;&nbsp;</tr>
            <tr><button><a style="<?php ($this->pager->getNext()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getNext()]) ?>">Next</a></button></tr>
            <tr><button><a style="<?php ($this->pager->getEnd()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getEnd()]) ?>">End</a></button>
        </tr>
        <tr>
           <td colspan="9"><b>Page Information</b></td>
        </tr>
        <tr>
            <th><input type="checkbox" name="main" value="">Select</th>
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
                    <td><input type="checkbox" name="check[]" value="<?php echo $page->pageId ?>"></td>
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

