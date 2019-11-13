<?php
header("Access-Control-Allow-Origin: *");
include_once '../class/product.php';
$userid=$_GET['userid'];
$orders=new Product;

	$response=$orders->myorders($userid);	
	echo json_encode($response,true);
	

?>