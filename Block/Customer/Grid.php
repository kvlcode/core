<?php
Ccc::loadClass('Block_Core_Template');
class Block_Customer_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
	}

	public function getCustomers()
	{
		$customerTable = Ccc::getModel('Customer');
		$customers = $customerTable->fetchAll("SELECT c.*,a.*
					                            FROM customer c
					                            JOIN address a
					                            ON a.customerId = c.customerId");
		return $customers;
	}

}