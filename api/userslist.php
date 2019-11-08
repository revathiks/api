<?php
header("Access-Control-Allow-Origin: *");
include_once '../class/user.php';

$users=new User;

	$response=$users->listUsers();	
	echo json_encode($response,true);
	

?>