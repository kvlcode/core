<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php
class Block_Config_Edit_Tabs_Config extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/config/edit/tabs/config.php');
	}

	public function getConfig()
	{
		return Ccc::getRegistry('config');
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
		return $this->getUrl('save','config');
	}

	
}
