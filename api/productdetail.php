<?php
header("Access-Control-Allow-Origin: *");
include_once '../class/product.php';

$product=new Product;
(isset($_GET['id'])) ? $uid=$_GET['id']:$uid=0;
if( $uid > 0)
	{
	$response=$product->productdetail($uid);	
	}else
	{
		$response=array('msg'=>'no user found to edit');
	}
	
	echo json_encode($response,true);
	

?>