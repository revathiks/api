<?php
header("Access-Control-Allow-Origin: *");
include_once '../class/product.php';
$order=new Product;
if(isset($_POST))
{	(isset($_POST['id'])) ? $id=$_POST['id']:$id=0;

    if( $id > 0)
	{
	 $response=$order->cancelOrder($id);		
	}
	else
	{
		$response=array('msg'=>'no order found to cancel');
	}
	echo json_encode($response,true);
}
?>