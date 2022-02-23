<?php
 Ccc::loadClass('Model_Core_Table_Row');
class Model_Product extends Model_Core_Table_Row{

	public function __construct()
	{	
		$this->setTableClassName('Product_Resource');
	}
}