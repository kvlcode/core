<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php
class Block_Admin_Edit_Tabs_Personal extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/admin/edit/tabs/personal.php');
	}

	public function getAdmin()
	{
		return Ccc::getRegistry('admin');
	}

	public function setEdit($edit)
    {
        $this->edit = $edit;
        return $this;
    }

    public function getEdit()
    {
        return $this->edit;
    }

    public function getSaveUrl()
	{
		return $this->getUrl('save','admin');
	}

	
}
