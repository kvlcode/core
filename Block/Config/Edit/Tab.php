<?php Ccc::loadClass('Block_Core_Edit_Tab'); ?>
<?php
class Block_Config_Edit_Tab extends Block_Core_Edit_Tab
{	
	function __construct()
	{
		parent::__construct();
		$this->setcurrentTab('config');
	}

	public function prepareTabs()
	{
		$this->addTab([
			'title' => 'Config Information',
			'block' =>	'Config_Edit_Tabs_Config',
			'url' =>	$this->getUrl(null,null,['tab'=>'config'])
		],'config');
	}
}	
	