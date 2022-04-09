<?php Ccc::loadClass('Block_Core_Edit'); ?>
<?php Ccc::loadClass('Block_Admin_Edit_Tab'); ?>

<?php
class Block_Admin_Edit extends Block_Core_Edit
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getSaveUrl()
	{
		return $this->getUrl('save','admin');
	}
}