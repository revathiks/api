<?php
//header("Access-Control-Allow-Origin: *");
include_once 'conn.php';
class Product extends Dbconfig
{
	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function listProducts()
	{       $response=array();
		$query = "select * from products order by id desc";		
		if($result = mysqli_query($this->connection,$query))
		{
			$rowcount=mysqli_num_rows($result);
			if($rowcount >0)
			{   while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
				{
					$productlist[]=$row;
				}
		        $response['products']=$productlist;
		        $response['noRecords']=$rowcount;
			}else{
                      $response['noRecords']=0;}			
		}
		else{
			$response['noRecords']=0;
		}
		return $response;
		
		
	}
}
?>