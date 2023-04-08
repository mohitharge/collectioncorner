<?php
  session_start();
  include("includes/connection.php");
  if(isset($_GET['token'])){
  	$token = $_GET['token'];

  	$update = "update users set status = 'verified' where token = '$token'";

  	$query = mysqli_query($con,$update);
  	if($query){
  		$_SESSION['alert_msg'] = "Account verified";
  		header('location: signin.php');
  	}
  	else{
  		echo "<script>alert('not verified')</script>";
  		header('location: signup.php');
  	}
  }
?>