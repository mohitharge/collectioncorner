

<!DOCTYPE html>
<html>
<?php include ("includes/head.php"); ?>
<style>
       
		.swal2-popup {
		width: 45rem;
		height: 28rem;
	}
		.swal2-html-container {
		font-size: 1.8rem;
	}
	.input-group {
    position: relative;
    display: table;
    border-collapse: separate;
    z-index: 0!important;
}
	body{
		overflow-x: hidden;
		/*overflow-y: hidden;*/

	}
	@media only screen and (max-width: 767px) {
    .main-content{
		width: 90% !important;
		height: 40%;
		margin: 10px auto;
	    background-color: #98c9dfb0;
        padding: 40px 50px;
        border-radius: 4rem;
	}
}
	.main-content {
        width: 50%;
        height: 40%;
        margin: 10px auto;
        background-color: #98c9dfb0;
        padding: 40px 50px;
        border-radius: 4rem;
    }
	.header{
		border: 0px solid #000;
		margin-bottom: 5px;
	}
	.well{
		background-color: #187FAB;
	}
	#signup{
		width: 60%;
		border-radius: 30px;
	}


</style>
<body>
<?php include("includes/navbar.php"); ?>
<div class="row">
	<div class="col-sm-12">
		<div class="main-content">
			<div class="header">
				<h3 style="text-align: center;"><strong>Create Your Account</strong></h3>
				<hr>
			</div>
			<div class="l-part">
				<form action="" method="post">
					<div class="row">
						<div class="col-md-6">
							<label>First Name:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="first_name" type="text" class="form-control" placeholder="Enter your first name" name="first_name" required="required" value="<?php if(isset($_POST['first_name'])){echo $_POST['first_name']; } ?>">
								<small id="first_name_error"></small>
							</div>
						</div>
						<div class="col-md-6">
							<label>Last Name:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="last_name" type="text" class="form-control" placeholder="Enter your last name" name="last_name" required="required" value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name']; } ?>">
								<small  id="last_name_error"></small>
							</div><br>
						</div>
						
					</div>				
					
					
					<label>Email:</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input id="email" type="email" class="form-control" placeholder="Enter your email" name="u_email" required="required" value="<?php if(isset($_POST['u_email'])){echo $_POST['u_email']; } ?>">
						<small id="email_error"></small>
					</div><br>

					<label>Password:</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="password" type="password" class="form-control" placeholder="Enter Password" name="u_pass" required="required" value="<?php if(isset($_POST['u_pass'])){echo $_POST['u_pass']; } ?>">
						<small id="create_password_error"></small>
					</div><br>
					
					<label>Country:</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
						<select class="form-control" name="u_country" required="required" value="<?php if(isset($_POST['u_country'])){echo $_POST['u_country']; } ?>">
							<option disabled>Select your Country</option>
							<option >India</option>
							<option >United States of America</option>
							<option >Japan</option>
							<option >UK</option>
							<option >France</option>
							<option >Germany</option>
						</select>
					</div><br>
					<label>Gender:</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<select class="form-control input-md" name="u_gender" required="required" value="<?php if(isset($_POST['u_gender'])){echo $_POST['u_gender']; } ?>">
							<option disabled>Select your Gender</option>
							<option>Male</option>
							<option>Female</option>
							<option>Others</option>
						</select>
					</div><br>
					<label>Date of Birth:</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<input type="date" class="form-control input-md" placeholder="Email" name="u_birthday" required="required" value="<?php if(isset($_POST['u_birthday'])){echo $_POST['u_birthday']; } ?>">
					</div><br>
					<a style="text-decoration: none;float: right;color: #187FAB;" data-toggle="tooltip" title="Signin" href="signin.php">Already have an account?</a><br><br>

					<center><button id="signup" type="submit" class="btn btn-info btn-lg" name="sign_up">Signup</button></center>
					
				</form>
			</div>
		</div>
	</div>
</div>
</body>
<?php include ("includes/footer.php"); ?>
</html>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style type="text/css">
	.swal2-popup {
		width:auto;
		height: 28rem;
	}
		.swal2-html-container {
		font-size: 1.8rem;
	}
	
</style>
<?php
include("includes/connection.php");

	if(isset($_POST['sign_up'])){

		$first_name = htmlentities(mysqli_real_escape_string($con,$_POST['first_name']));
		$last_name = htmlentities(mysqli_real_escape_string($con,$_POST['last_name']));
		$pass = htmlentities(mysqli_real_escape_string($con,$_POST['u_pass']));
		$email = htmlentities(mysqli_real_escape_string($con,$_POST['u_email']));
		$country = htmlentities(mysqli_real_escape_string($con,$_POST['u_country']));
		$gender = htmlentities(mysqli_real_escape_string($con,$_POST['u_gender']));
		$birthday = htmlentities(mysqli_real_escape_string($con,$_POST['u_birthday']));
		$status = "notverified";
		$posts = "no";
		$newgid = sprintf('%05d', rand(0, 999999));
		$password = password_hash($pass, PASSWORD_BCRYPT);
		$token = bin2hex(random_bytes(15));
		$regex = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/"; 

		$username = strtolower($first_name . "_" . $last_name . "_" . $newgid);
		$check_username_query = "select user_name from users where user_email='$email'";
		$run_username = mysqli_query($con,$check_username_query);

		if(strlen($pass) <5 ){
			?>
				<script type="text/javascript">
					Swal.fire({
									  icon: 'warning',
									  title: 'Password should be minimum 5 characters!',
									  // text: 'Something went wrong!'
									  // text: 'Check your mail: <?php echo $email; ?> to activate your account.'
									  
									})
				</script>
				<?php

			// echo"<script>alert('Password should be minimum 5 characters!')</script>";
			exit();
		}

		$check_email = "select * from users where user_email='$email'";
		$run_email =  mysqli_query($con,$check_email);

		$check = mysqli_num_rows($run_email);

		if($check == 1){

			echo "<script>alert('Email already exist, Please try using another email')</script>";
			// echo "<script>window.open('signup.php', '_self')</script>";
			exit();
		}

		if (!preg_match ("/^[a-zA-z]*$/", $first_name) ) {  
			?>
				<script type="text/javascript">
					Swal.fire({
									  icon: 'warning',
									  title: 'Only alphabets and whitespace are allowed.',
									  // text: 'Something went wrong!'
									  // text: 'Check your mail: <?php echo $email; ?> to activate your account.'
									  
									})
				</script>
				<?php
    	  
             // echo "<script>alert('Only alphabets and whitespace are allowed.')</script>" ;
             exit(); 
		}
		if (!preg_match ("/^[a-zA-z]*$/", $last_name) ) { 
		?>
				<script type="text/javascript">
					Swal.fire({
									  icon: 'warning',
									  title: 'Only alphabets and whitespace are allowed.',
									  // text: 'Something went wrong!'
									  // text: 'Check your mail: <?php echo $email; ?> to activate your account.'
									  
									})
				</script>
				<?php 
    	  
             // echo "<script>alert('Only alphabets and whitespace are allowed.')</script>" ;
             exit(); 
		}
		if (!preg_match ($regex , $email) ) {  

    	  		?>
				<script type="text/javascript">
					Swal.fire({
									  icon: 'warning',
									  title: 'Please enter valid email address.',
									  // text: 'Something went wrong!'
									  // text: 'Check your mail: <?php echo $email; ?> to activate your account.'
									  
									})
				</script>
				<?php 
             // echo "<script>alert('Please enter valid email.')</script>" ;
             exit(); 
		}

		$rand = rand(1, 3); //Random number between 1 and 3

			if($rand == 1)
				$profile_pic = "profile.jpg";
			else if($rand == 2)
				$profile_pic = "profile.jpg";
			else if($rand == 3)
				$profile_pic = "profile.jpg";

		$insert = "insert into users (f_name,l_name,user_name,describe_user,collection_name,user_pass,user_email,user_country,user_gender,user_birthday,user_image,user_cover,user_reg_date,status,posts,token)
		values('$first_name','$last_name','$username','Hello. This is my default status!','...','$password','$email','$country','$gender','$birthday','$profile_pic','default_cover.jpg',NOW(),'$status','$posts','$token')";
		
		$query = mysqli_query($con, $insert);

		if($query){
			$to_email = "$email";
			$subject = "Please verify your account";
            $message = "
            <html>
            <head>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                <title>Account Verificarion</title>
            <style>
                #email-wrap {
                background: #151515;
                color: #FFF;
                }
                .ii a[href] {
                    color: #fff !important;
                    margin-top: 1rem !important;
                }
                #customers {
                   font-family: Arial,Helvetica,sans-serif;
                    border-collapse: collapse;
                    width: 30rem !important;
                    margin: 1rem 0rem !important;
                }
                
                #customers td, #customers th {
                  border: 1px solid #ddd;
                  padding: 8px;
                }
                
                #customers tr:nth-child(even){background-color: #f2f2f2;}
                
                #customers tr:hover {background-color: #ddd;}
                
                #customers th {
                  padding-top: 12px;
                  padding-bottom: 12px;
                  text-align: left;
                  background-color: #04AA6D;
                  color: white;
                }
                .button {
                  background-color: #4CAF50;
                  border: none;
                  padding: 10px 22px;
                  text-align: center;
                  text-decoration: none;
                  display: inline-block;
                  font-size: 16px;
                  margin: 4px 2px;
                  cursor: pointer;
                  color: #fff !important;
                  margin-top: 1rem !important;
                  border-radius: 1rem;
                }
            </style>
            </head>
            <body>
                <div style='background-color: #59c5ff47; text-align: center; padding: 2rem;'>
                    <img src='https://mohitharge.co.in/collectioncorner/images/logo2.png' alt='logo' />
                </div>
                <br>
                <table width='35% !important' id='customers'>
                    <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email ID</th>
                    </tr>
                    <tr>
                    <td>$first_name</td>
                    <td>$last_name</td>
                    <td>$email</td>
                    </tr>
                </table>
                <a class='button' href='https://mohitharge.co.in/collectioncorner/activate.php?token=$token'>Verify Now</a>
            </body>
            </html>
                ";
// 			$headers = "From: verification@collectioncorner.mohitharge.co.in";
    		// Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: Collection Corner <verification@collectioncorner.mohitharge.co.in>' . "\r\n";
            $headers .= 'Reply-To: Collection Corner <verification@collectioncorner.mohitharge.co.in>' . "\r\n";
            $headers .= 'BCc: hmohit05683@gmail.com' . "\r\n";

			if (mail($to_email, $subject, $message, $headers)) {

				$_SESSION['alert_msg'] = "Check your mail: $email to activate your account";
				?>
				<script type="text/javascript">
					Swal.fire({
									  icon: 'success',
									  title: 'Well Done <?php echo $first_name; ?>, ',
								
									  text: 'Check your mail: <?php echo $email; ?> to activate your account.'
									  
									}).then(function() {
							    window.location = "signin.php";
							});
				</script>
				<?php
			    // echo "<script>alert('Well Done $first_name, Check your mail: $email to activate your account.')</script>";
				// echo "<script>window.open('signin.php', '_self')</script>";
			} else {
				?>
				<script type="text/javascript">
					Swal.fire({
									  icon: 'success',
									  title: 'Email sending failed...',
								
								// 	  text: 'Check your mail: <?php echo $email; ?> to activate your account.'
									  
									}).then(function() {
							    window.location = "signin.php";
							});
				</script>
				<?php
			    echo "<script>alert('Email sending failed...')</script>";
			}
			
		}
		else{
			//echo(mysqli_error($con));
			echo "<script>alert('Registration failed, please try again! (mysqli_error($con))')</script>";
			// echo "<script>window.open('signup.php', '_self')</script>";
		}
	}
?>




