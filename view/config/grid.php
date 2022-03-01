<?php $configs = $this->getConfigs(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Config Grid</title>
</head>
<body>
    <button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit', 'config')?>"> Add New </a></button>
    <table border="1" width="100%" cellspacing="4">
        <tr>
           <td colspan="9"><b>Config Information</b></td>
        </tr>
        <tr>
            <th>Config Id</th>
            <th>Name</th>
            <th>Code</th>
            <th>Value</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php if(!$configs):?>
            <tr>
                <td colspan="10">No record Available</td>
            </tr>   
        <?php else:?>
            
            <?php foreach ($configs as $config): ?>
                <tr>
                    <td><?php echo $config->configId ?></td>
                    <td><?php echo $config->name ?></td>
                    <td><?php echo $config->code ?></td>
                    <td><?php echo $config->value ?></td>
                    <td><?php echo $config->status ?></td>
                    <td><?php echo $config->createdDate ?></td>
                    <td><a href="<?php echo $this->getUrl('edit', 'config',['id' =>  $config->configId])?>">Edit</a></td>
                    <td><a href="<?php echo $this->getUrl('delete', 'config',['id' => $config->configId]);?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?> 
  
    </table>

</body>
</html>