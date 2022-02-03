<?php

include "Adapter.php";

$id = $_GET["id"];

$adapter=new Adapter();

$result = $adapter->delete("delete from product_info where id = $id ");

header('Location: '.$_SERVER['localhost'].'product_grid.php');


?>