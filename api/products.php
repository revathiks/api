<?php
header("Access-Control-Allow-Origin: *");
include_once '../class/product.php';

$products=new Product;

	$response=$products->listProducts();	
	echo json_encode($response,true);
	

?>