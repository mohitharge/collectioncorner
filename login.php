<?php
session_start();

include("includes/connection.php");

	if (isset($_POST['login'])) {

		$email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
		$pass = htmlentities(mysqli_real_escape_string($con, $_POST['pass']));

		$select_user = "select * from users where user_email='$email' ";
		$query= mysqli_query($con, $select_user);
		$check_user = mysqli_num_rows($query);

		if($check_user == 1){
			
			$email_pass = mysqli_fetch_assoc($query);
			$db_pass = $email_pass['user_pass'];
			$status = $email_pass['status'];
			echo $status;
			$_SESSION['user_email'] = $email;
			//$_SESSION['user_name'] = $fname." ".$lname;
			$pass_decode = password_verify($pass, $db_pass);

			if($pass_decode){

				echo "<script>window.open('home.php', '_self')</script>";
			}
			else{
			echo"<script>alert('Your Email or Password is incorrect')</script>";
		}

			
		}
	}
?>