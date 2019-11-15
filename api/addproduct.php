<?php
header("Access-Control-Allow-Origin: *");
include_once '../class/product.php';
$addProduct=new Product;
//print_r($_POST);
if(isset($_POST))
{	
	$response=$addProduct->add_product($_POST);
	//print_r($response);
	//echo "<br>";
	
	echo json_encode($response,true);
}
?>