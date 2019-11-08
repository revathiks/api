<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods:GET, PUT, POST, DELETE, OPTIONS");
class Dbconfig
{
private $host="localhost";
private $user="root";
private $pass="";
private $database="react_learn";
public  $connection;
public function __construct()
{
	if(!isset($this->connection))
	{
		$this->connection=mysqli_connect($this->host,$this->user,$this->pass,$this->database);		
		if(!$this->connection)
		{
			die("could not connect". mysqli_error());
		}
		
		return $this->connection;
	}	
	
}
}
?>