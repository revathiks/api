<?php
header("Access-Control-Allow-Origin: *");
include_once '../class/product.php';
$product=new Product;
if(isset($_POST))
{	
	$response=$product->productupdate($_POST);	
	echo json_encode($response,true);
}
?>