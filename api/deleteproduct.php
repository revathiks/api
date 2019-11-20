<?php
header("Access-Control-Allow-Origin: *");
include_once '../class/product.php';
$pDelete=new Product;
if(isset($_POST))
{	(isset($_POST['id'])) ? $id=$_POST['id']:$id=0;

    if( $id > 0)
	{
	 $response=$pDelete->deleteProduct($id);		
	}
	else
	{
		$response=array('msg'=>'no product found to delete');
	}
	echo json_encode($response,true);
}
?>