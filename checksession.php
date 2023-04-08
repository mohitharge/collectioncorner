<?php 
  if (!isset($_SESSION['user_email']))
  {
  	header('location:index.php');
  	exit();
  }

?>