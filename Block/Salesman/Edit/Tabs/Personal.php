<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php
class Block_Salesman_Edit_Tabs_Personal extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/salesman/edit/tabs/personal.php');
	}

	public function getSalesman()
	{
		return Ccc::getRegistry('salesman');
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
		return $this->getUrl('save','salesman');
	}
}