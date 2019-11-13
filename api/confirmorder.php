<?php
header("Access-Control-Allow-Origin: *");
include_once '../class/product.php';
$products=new Product;
if(isset($_POST))
{	
	$response=$products->confirmOrder($_POST);	
	echo json_encode($response,true);
}
	

?>