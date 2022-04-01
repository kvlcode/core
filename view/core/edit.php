<!-- <form action="<?php //echo $this->getEditUrl() ?>" method="POST"> -->
<?php
    echo $this->getTab()->toHtml();
    echo $this->getTabContent()->toHtml();
?>
<!-- </form> -->