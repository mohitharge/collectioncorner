<?php 
include("includes/connection.php");
extract($_POST);
if(isset($_POST['collection_name']) && isset($_POST['describe_user']) && isset($_POST['u_name']) && isset($_POST['birthday']) && isset($_POST['gender']) && isset($_POST['l_name']) && isset($_POST['country']) && isset($_POST['f_name'])){
$update = "update users set f_name = '$f_name',l_name='$l_name',user_name='$u_name',describe_user='$describe_user',collection_name='$collection_name',user_birthday='$birthday',user_gender='$gender',user_country='$country' where user_email ='$user'";

		$run_update = mysqli_query($con,$update);

		if($run_update){
			echo "Profile Updated sucessfully!!";
		}	
		else{
			mysqli_error();
		}
	}
	else{
		echo "Empty value not accepted";
	}
?>