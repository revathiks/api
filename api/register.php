<?php
header("Access-Control-Allow-Origin: *");
include_once '../class/user.php';
$userRegister=new User;
if(isset($_POST))
{	
	$response=$userRegister->register($_POST);
	//print_r($response);
	//echo "<br>";
	//print_r($_POST);
	echo json_encode($response,true);
}
?>