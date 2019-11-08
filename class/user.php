<?php
//header("Access-Control-Allow-Origin: *");
include_once 'conn.php';
class User extends Dbconfig
{
	public function __construct()
	{
		parent::__construct();
	}
	public function login($data)
	{  
	    $response=array();
		
		isset($data['email']) ? $email=$data['email'] :$email="";
		isset($data['password']) ? $password=$data['password'] :$password="";
				
		$query = "select id from users WHERE email = '".$email."' and password='".$password."'";		
		$result = mysqli_query($this->connection,$query);
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_assoc($result);
			$response=$row;
			$response['status']="success";
			$response['actionState']=1;
			
		}
		else
		{
			$response['status']="failure";
		}
       return $response;		
		
	}
	public function register($data)
	{   $response=array();
	    $response['actionState']=0;
		$email=$data['email'];		
		$password=$data['password'];	
        $fname=$data['fname'];
        $lname=$data['lname'];	
        $grade=$data['grade'];		
        isset($data['fname']) ? $name=$data['fname'] :$fname="";
        isset($data['lname']) ? $name=$data['lname'] :$lname="";
		isset($data['email']) ? $email=$data['email'] :$email="";	
        isset($data['grade']) ? $city=$data['grade'] :$grade="";
		isset($data['password']) ? $password=$data['password'] :$password="";		
		$query = "select * from users WHERE email = '".$email."'";		
		if($result = mysqli_query($this->connection,$query))
		{
			$rowcount=mysqli_num_rows($result);
			if($rowcount >0)
			{
				$response['registerstatus']="failed";
				$response['Msg']="Email ID already used";
				
			}
			else
			{   
		       $insertQry="INSERT INTO users (fname,lname,email,grade,password)
                VALUES ('$fname','$lname', '$email', '$grade','$password')";
				if(mysqli_query($this->connection,$insertQry))
				{
		
		        $response['registerstatus']="success";
				$response['Msg']="User Registered successfully";
				$response['actionState']=1;
				}
				else{
			     $response['registerstatus']="failed";
		       }
				
		     }
		}
		else{
			$response['registerstatus']="failed";
		}
		return $response;
		
		
	}
	
	public function listUsers()
	{   $response=array();	    
		$response['noRecords']="";			
				
		$query = "select * from users order by id desc";		
		if($result = mysqli_query($this->connection,$query))
		{
			$rowcount=mysqli_num_rows($result);
			if($rowcount >0)
			{   while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
				{
					$userlist[]=$row;
				}
		        $response['users']=$userlist;
		        $response['noRecords']=$rowcount;
			}else{
            $response['noRecords']=0;}			
		}
		else{
			$response['noRecords']=0;
		}
		return $response;
		
		
	}
	
	public function deleteUser($uid)
	{   $response=array();	
		$response['actionState']=0;
		$query = "delete from users where id=".$uid;		
		if($result = mysqli_query($this->connection,$query))
		{
			
		        $response['msg']="user deleted successfully";
		        $response['status']='success';
				$response['actionState']=1;
						
		}
		else{
			$response['status']='failed';
		}
		return $response;
		
		
	}
	
	public function userdetail($uid)
	{   $response=array();	    
		$response['noRecords']="";			
				
		$query = "select * from users where id=".$uid;		
		if($result = mysqli_query($this->connection,$query))
		{
			$rowcount=mysqli_num_rows($result);
			if($rowcount >0)
			{   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
				
		        $response['noRecords']=$rowcount;
				$response['user']=$row;
			}else{
            $response['noRecords']=0;}			
		}
		else{
			$response['noRecords']=0;
		}
		return $response;
		
		
	}
	
	public function userUpdate($data)
	{   $response=array();
	    $response['actionState']=0;
		$email=$data['email'];				
        $fname=$data['fname']; 
        $lname=$data['lname'];  		
        $grade=$data['grade'];	
        $id=$data['id'];		
		$query = "select * from users WHERE email = '".$email."'";		
		if($result = mysqli_query($this->connection,$query))
		{
			$rowcount=mysqli_num_rows($result);
			if($rowcount >0)
			{
				 $updateQry="update users set fname='$fname',lname='$lname',email='$email',grade='$grade' where id=".$id;
				if(mysqli_query($this->connection,$updateQry))
				{		
		        $response['updatestatus']="success";
				$response['Msg']="User updated successfully";
				$response['actionState']=1;
				}
				else{
			     $response['updatestatus']="failed";
		       };
				
			}
			else
			{   
		         $response['updatestatus']="failed";
				
		     }
		}
		else{
			$response['updatestatus']="failed";
		}
		return $response;
		
		
	}
}
?>