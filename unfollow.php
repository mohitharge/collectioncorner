<?php
include("includes\connection.php");
session_start();
include("checksession.php");
if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
extract($_POST);
if(isset($_POST['followed_user']) && isset($_POST['current_user'])){

	$query = "Delete from follow where follower_id = '$current_user' and following_id = '$followed_user' ";

	$run_query = mysqli_query($con,$query);
	if($run_query){
		echo "sucessfully unfollow";
	}
	else{
		mysql_error($run_query);
	}
}

?>