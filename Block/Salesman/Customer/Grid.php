<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Salesman_Customer_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/salesman/customer/grid.php");
    }

    public function getCustomers()
    {
        $salesmanId = Ccc::getFront()->getRequest()->getRequest('id');
        $customer = Ccc::getModel('Customer');
        $customers = $customer->fetchAll("SELECT * FROM `customer` WHERE (`salesmanId` is NULL OR `salesmanId` = {$salesmanId}) AND `status` = '1' ");
        return $customers;
    }

    public function getSelect($customerId)
    {
        $salesmanId = Ccc::getFront()->getRequest()->getRequest('id');
        $customerModel = Ccc::getModel('Customer');
        $selectedValues = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `salesmanId` = {$salesmanId} AND `customerId` = {$customerId}");

        if($selectedValues){
            return "checked";
        }
        return null;
    }
}
 