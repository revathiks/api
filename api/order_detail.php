<?php
header("Access-Control-Allow-Origin: *");
include_once '../class/product.php';
$orderid=$_GET['orderid'];
$order=new Product;

	$response=$order->orderDetail($orderid);	
	echo json_encode($response,true);
	

?>