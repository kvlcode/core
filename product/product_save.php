<?php

date_default_timezone_set("Asia/Kolkata");
include "Adapter.php";

echo "<pre>";

$adapter=new Adapter();


//Update
	$h_id = NULL;
	$h_id = $_POST["hid"];
	$u_id = $_POST["id"];
	$u_name = $_POST["name"];
	$u_price = $_POST["price"];
	$u_quantity = $_POST["quantity"];
	$u_status = $_POST["status"];
	$date = date('Y-m-d H:i:s');


	if($h_id){


			$adapter->update("update product_info set name ='$u_name', price ='$u_price', quantity ='$u_quantity', status ='$u_status',updated_date ='$date' where id = '$u_id'");

			header('Location: '.$_SERVER['localhost'].'product_grid.php');	

	}
	else{

		$result = $adapter->insert("insert into product_info(`name`, `price`, `quantity`, `status`, `created_date`) values('$u_name','$u_price','$u_quantity','$u_status','$date')");

		header('Location: '.$_SERVER['localhost'].'product_grid.php');

	}
		

?>