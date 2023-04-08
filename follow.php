<?php
include("includes\connection.php");
session_start();
include("checksession.php");
if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
extract($_POST);
$data = "";
if(isset($_POST['followed_user']) && isset($_POST['current_user'])){

	$query = "Insert into follow (following_id,follower_id,status) values('$followed_user','$current_user',1)";

	$run_query = mysqli_query($con,$query);
	if($run_query){
		$data.= "sucessfully follow";
	}
	else{
		$data.= mysql_error($run_query);
	}
}
echo $data;

?>