<?php
include_once '../class/career.php';
$career=new Career;
if(isset($_POST,$_FILES))
{	
	$response=$career->careerPost($_POST);
	echo json_encode($response,true);
}
?>