<?php
header("Access-Control-Allow-Origin:*");
include_once '../class/user.php';
$user=new User;
if(isset($_POST))
{	
	$response=$user->login($_POST);
	echo json_encode($response,true);
}
?>