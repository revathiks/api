<?php
header("Access-Control-Allow-Origin: *");
include_once '../class/user.php';

$users=new User;
(isset($_GET['uid'])) ? $uid=$_GET['uid']:$uid=0;
if( $uid > 0)
	{
	$response=$users->userdetail($uid);	
	}else
	{
		$response=array('msg'=>'no user found to edit');
	}
	
	echo json_encode($response,true);
	

?>