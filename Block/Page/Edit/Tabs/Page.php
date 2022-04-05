<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php
class Block_Page_Edit_Tabs_Page extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/page/edit/tabs/page.php');
	}

	public function getPage()
	{
		return Ccc::getRegistry('page');
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
		return $this->getUrl('save','page');
	}

	
}