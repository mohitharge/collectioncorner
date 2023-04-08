<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style type="text/css">
	.swal2-popup {
		width: 45rem;
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
			echo"<script>alert('Password should be minimum 5 characters!')</script>";
			exit();
		}

		$check_email = "select * from users where user_email='$email'";
		$run_email =  mysqli_query($con,$check_email);

		$check = mysqli_num_rows($run_email);

		if($check == 1){

			echo "<script>alert('Email already exist, Please try using another email')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
			exit();
		}

		if (!preg_match ("/^[a-zA-z]*$/", $first_name) ) {  
    	  
             echo "<script>alert('Only alphabets and whitespace are allowed.')</script>" ;
             exit(); 
		}
		if (!preg_match ("/^[a-zA-z]*$/", $last_name) ) {  
    	  
             echo "<script>alert('Only alphabets and whitespace are allowed.')</script>" ;
             exit(); 
		}
		if (!preg_match ($regex , $email) ) {  
    	  
             echo "<script>alert('Please enter valid email.')</script>" ;
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
// 			$message = "Hi $first_name, please activate account http://localhost/social_network/activate.php?token=$token";
            $message = "
                <html>
                    <head>
                        <title>Account Verification</title>
                    </head>
                    <style>
                        .button {
                          background-color: #4CAF50;
                          border: none;
                          color: white;
                          padding: 10px 22px;
                          text-align: center;
                          text-decoration: none;
                          display: inline-block;
                          font-size: 16px;
                          margin: 4px 2px;
                          cursor: pointer;
                          border-radius: 1rem;
                        }
                    </style>
                    <body>
                    
                    <div style="background-color: coral;">
                        <img style="max-width: 100%; height: auto;" src="images\logo2.png">
                    </div>
                     
                    <br>
                        <p>This email contains verification link!</p>
                        <table>
                            <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            </tr>
                            <tr>
                            <td>$first_name</td>
                            <td>$last_name</td>
                            </tr>
                        </table>
                        <a href="https://mohitharge.co.in/collectioncorner/activate.php?token=$token" class="button"> Verify Now </a>
                    </body>
                </html>
            ";
// 			$headers = "From: verification@collectioncorner.mohitharge.co.in";
    		// Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: verification@collectioncorner.mohitharge.co.in' . "\r\n";
            // $headers .= 'Cc: myboss@example.com' . "\r\n";

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
			    echo "<script>alert('Email sending failed...')</script>";
			}
			
		}
		else{
			//echo(mysqli_error($con));
			echo "<script>alert('Registration failed, please try again!')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
		}
	}
?>
