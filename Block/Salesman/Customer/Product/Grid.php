<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Salesman_Customer_Product_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/salesman/customer/product/grid.php");
    }

    public function getProducts()
    {
        $product = Ccc::getModel('Product');
        $products = $product->fetchAll("SELECT p.productId, p.name, p.sku, p.price as productPrice, p.map, c.entityId, c.customerId, c.price as customerPrice FROM `product` AS p LEFT JOIN `customer_price` AS c ON p.productId = c.productId");
        return $products;
    }


     public function getDiscount($salesmanId)
    {
        $salesmanModel = Ccc::getModel('Salesman');
        $salesmen = $salesmanModel->fetchAll("SELECT `discount` FROM `salesman` WHERE `salesmanId` = '{$salesmanId}'");
        foreach ($salesmen as $key => $value) 
        {
            return $value->discount;
        }  
        return false; 
    }

    public function getSalesmanPrice($price, $discount)
    {
        $salesmanPrice = $price - ($price * $discount / 100);
        return $salesmanPrice;
    }

}