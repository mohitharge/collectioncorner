
<?php

session_start();
include("checksession.php");
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_name = $row['user_name'];
		
	?>
<!DOCTYPE html>
<html>
<head>

	<title>Edit Profile</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="icon" type="image/x-icon" href="images/favico.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style>
    .table{
        box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
        border-radius: 1rem;
    }
</style>
<body>
    
<div class="row" style="margin-top: 5rem">
	<div class="col-sm-4">		
	</div>
	<div class="col-sm-4">
		<!-- <form action="" method="post" enctype="multipart/form-data"> -->
			<table class="table table-bordered table-hover">
				<tr align="center">
					<td colspan="6" class="active">
						<h2>Edit Your Profile</h2>
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" class="form-control" id="f_name" name="f_name" required value="<?php echo $first_name ?>">
					</td>					
				</tr>
				<tr>
					<td>
						<input type="text" class="form-control" id="l_name" name="l_name" required value="<?php echo $last_name ?>">
					</td>					
				</tr>

					<td>
						<input type="text" class="form-control" name="u_name" id="u_name" required value="<?php echo $user_name ?>">
					</td>					
				</tr>

					<td>
						<input type="text" class="form-control" name="describe_user" id="describe_user" required value="<?php echo $describe_user ?>">
					</td>					
				</tr>
				<tr>
					<td>
						<input type="text" class="form-control" name="collection_name" id="collection_name" required value="<?php echo $collection_name ?>">
					</td>					
				</tr>
				
				<tr>
					<td>
						<select class="form-control" name="u_country" id="u_country">
							<option><?php echo $user_country ?></option>
							<option>United States</option>
							<option>India</option>
							<option>UAE</option>
							<option>Brazil</option>
							<option>UK</option>
							<option>Japan</option>
							
						</select>
					</td>					
				</tr>

					<td>
						<select class="form-control" name="u_gender" id="u_gender">
							<option><?php echo $user_gender ?></option>
							<option>Male</option>
							<option>Female</option>
							<option>Other</option>
							
							
						</select>
					</td>					
				</tr>
				<tr>
					<td>
						<input class="form-control input-md" type="date" name="birthday" id="birthday" required value="<?php echo $user_birthday ?>">
					</td>					
				</tr>
				<tr align="center">
					<td colspan="6">
						<input type="hidden" name="email" id="email" value="<?php echo $user ?>">
						<!-- <input type="submit" class="btn btn-info" name="update" style="width: 25rem;" value="Update"> -->
						<button onclick="updateProfile()" class="btn btn-info" name="update" style="width: 25rem;">Update</button>

						
					</td>
					
				</tr>
				
			</table>
			
		<!-- </form>		 -->
	</div>
	<div class="col-sm-4">		
	</div>
	
</div>

</body>
<?php include ("includes/footer.php"); ?>
</html>

<script>
	<?php $usere=$_SESSION['user_email'];
// echo $usere;

 ?>
	$(document).ready(function(){
			
	
		});

	

	function updateProfile(){
		
		var user = $("#email").val();
		var f_name = $("#f_name").val();
		var l_name = $("#l_name").val();

		var country = $("#u_country").val();
		var gender = $("#u_gender").val();
		var birthday = $("#birthday").val();
		var u_name = $("#u_name").val();
		var describe_user = $("#describe_user").val();
		var collection_name = $("#collection_name").val();

		if(f_name == "" || l_name == "" || country == "" || gender == "" || birthday == "" || u_name == "" || describe_user == "" || collection_name == "" ){
			alert("Please fill all the fields");

		}
		else{


		// alert(user); 

		$.ajax({
			url: "updateprofile.php",
			type: "POST",
			data:{
				user:user,f_name:f_name,l_name:l_name,
				country:country,
				gender:gender,
				birthday:birthday,
				u_name:u_name,
				describe_user:describe_user,
				collection_name:collection_name



			},
			success:function(data,status){
				alert(data);

			}

		})
	}

	} 
</script>

<?php

if(isset($_POST['update'])){
		$f_name = htmlentities(mysqli_real_escape_string($con,$_POST['f_name']));
		$l_name = htmlentities(mysqli_real_escape_string($con,$_POST['l_name']));
		
		
		$country = htmlentities(mysqli_real_escape_string($con,$_POST['u_country']));
		$gender = htmlentities(mysqli_real_escape_string($con,$_POST['u_gender']));
		$birthday = htmlentities(mysqli_real_escape_string($con,$_POST['birthday']));
		$u_name = htmlentities(mysqli_real_escape_string($con,$_POST['u_name']));
		$describe_user = htmlentities(mysqli_real_escape_string($con,$_POST['describe_user']));
		$collection_name = htmlentities(mysqli_real_escape_string($con,$_POST['collection_name']));


		$update = "update users set f_name = '$f_name',l_name='$l_name',user_name='$u_name',describe_user='$describe_user',collection_name='$collection_name',user_birthday='$birthday',user_gender='$gender',user_country='$country' where user_email ='$user'";

		$run_update = mysqli_query($con,$update);

		if($run_update){
			echo "<script>alert('Profile Updated sucessfully')</script>";
			echo "<script>window.open('edit_profile.php?u_id=$user_id' , '_self')</script>";
		}	
		else{
			mysqli_error();
		}




}

 ?>
