<?php include("includes/connection.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Signin</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>

	body{
		overflow-x: hidden;
	}
		.swal2-popup {
		width: 45rem;
		height: 28rem;
	}

    @media only screen and (max-width: 768px) {
    .navbar-nav {
        float: left!important;
        margin: auto!important;
    }
    }

	.swal2-popup {
		width: auto!important;
		height: auto!important;
	}
		.swal2-html-container {
		font-size: 1.8rem !important;
	}
    .main-content {
        width: 50%;
        height: 40%;
        margin: 10px auto;
        background-color: #98c9df61;
        padding: 40px 50px;
        border-radius: 4rem;
    }
		@media only screen and (max-width: 767px) {
    .main-content{
		width: 90% !important;
		height: 40%;
		margin: 10px auto;
		background-color: #fff;
		border: 2px solid #e6e6e6;
		padding: 40px 50px;
	}
}


}
	.header{
		border: 0px solid #000;
		margin-bottom: 5px;
	}
	.well{
		background-color: #187FAB; 
	}
	#signin{
		width: 60%;
		border-radius: 30px;
	}
	.overlap-text{
		position: relative;
	}
	.overlap-text a{
		position: absolute;
		top: 8px;
		right: 10px;
		font-size: 14px;
		text-decoration: none;
		font-family: 'Overpass Mono', monospace;
		letter-spacing: -1px;

	}
	footer{
		position: fixed;
		bottom: 0;
		left: 0;
		right: 0;
	}
	
@media only screen and (max-width: 992px) {
		footer {
  position: relative !important;
  left: 0;
  bottom: 0;
  width: 100%;
  text-align: center;
}

</style>
<body>
<nav class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<!-- <a class="navbar-brand" href="home.php"><img src=""></a> -->
			<a class="navbar-brand" href="home.php"><img style="height: 8rem; margin-top: -13px;" src="images\slogo.png"></a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav" style="float: right !important; margin: 1rem; font-weight: bold; font-size: 2rem;">

	        
	       	<li><a href="home.php">Home</a></li>
			<li><a href="signin.php">Login</a></li>
			<li><a href="signup.php">Signup</a></li>

			</ul>
		</div>
	</div>
</nav>
<div class="row">
	<div class="col-sm-12">
		<div class="main-content">
			<div class="header">
				<h3 style="text-align: center;"><strong>Login to Your Account</strong></h3>
			</div>
			<br>
			<!-- <div>
				<h5 class="bg-success text-white" style="padding: 10px; border-radius: 6px;"><?php 
				   //session_start();
				   //echo $_SESSION['alert_msg']; ?></h5>
			</div> -->
			<div class="l-part">
				<form action="" method="post">
					<input type="email" name="email" placeholder="Email" required="required" class="form-control input-md"><br>
					<div class="overlap-text">
						<input type="password" name="pass" placeholder="Password" required="required" class="form-control input-md"><br>
						<a style="text-decoration:none;float: right;color: #187FAB;" data-toggle="modal" data-target=".forgot" title="Reset Password" href="">Forgot?</a>
					</div>
					<a style="text-decoration: none;float: right;color: #187FAB;" data-toggle="tooltip" title="Create Account!" href="signup.php">Don't have an account?</a><br><br>

					<center><button id="signin" class="btn btn-info btn-lg" name="login">Login</button></center>
					
					
				</form>
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
										
										$token = $email_pass['token'];
										$_SESSION['user_email'] = $email;
								$status = $email_pass['status'];

								if($status == 'verified'){
									
										
										//$_SESSION['user_name'] = $fname." ".$lname;

                                       

									$pass_decode = password_verify($pass, $db_pass);

									if($pass_decode){

										echo "<script>window.open('home.php', '_self')</script>";
									}else{
									?> <script type="text/javascript">
										Swal.fire({
									  icon: 'warning',
									  title: 'Your Password is incorrect',
									  // text: 'Something went wrong!'
									  
									})
							</script> <?php

									// echo"<script>alert('Your Password is incorrect')</script>";
									}	
								
							}
							else{
								?> <script type="text/javascript">
								Swal.fire({
									  icon: 'info',
									  title: 'Your Email is not verified',
									  text: 'Please verify email'
									  // text: 'Something went wrong!'
									  
									})
							</script> <?php
								// echo"<script>alert('')</script>";
								session_destroy();
								}
						}
						else{
							?> <script type="text/javascript">
								Swal.fire({
									  icon: 'warning',
									  title: 'No user found with this email',
									  text: 'Please create your account'
									  // text: 'Something went wrong!'
									  
									})
							</script> <?php
						}
					}

					?>
				<!-- Modal -->
					<div class="modal fade forgot" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="gridSystemModalLabel">Password Recovery</h4>
					      </div>
					      <div class="modal-body">
					        <div class="row">
					          <div class="col-md-12">
					          	<form action="" method="post">
								<input type="email" name="femail" placeholder="Email" required="required" class="form-control input-md"><br>

								
					          </div>
					          
					        </div>

					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        <button class="btn btn-primary" name="fsubmit">Submit</button>
					     </form>
					        <?php
					        include("includes/connection.php");
					        if(isset($_POST['fsubmit'])){
					        	$femail = htmlentities(mysqli_real_escape_string($con, $_POST['femail']));
							

							$fselect_user = "select * from users where user_email='$femail' ";
							$fquery= mysqli_query($con, $fselect_user);
							$fcheck_user = mysqli_num_rows($fquery);
					        	
					        	if($fcheck_user == 1){
					        			$email_pass = mysqli_fetch_assoc($fquery);
										$db_pass = $email_pass['user_pass'];
										$status = $email_pass['status'];
										$first_name = $email_pass['f_name'];
										$last_name = $email_pass['l_name'];
										$token = $email_pass['token'];
					        		
					        		$to_email = "$femail";
									$subject = "Password recovery";
								// 	$body = "Hi $first_name, click here to recover password http://localhost/social_network/recovpass.php?token=$token";
								 $message = "
                                        <html>
                                        <head>
                                        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                                            <title>Password recovery</title>
                                        <style>
                                            #email-wrap {
                                            background: #151515;
                                            color: #FFF;
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
                                                <td>$femail</td>
                                                </tr>
                                            </table>
                                            <a class='button' href='https://mohitharge.co.in/collectioncorner/recovpass.php?token=$token'>Reset Password</a>
                                        </body>
                                        </html>
                                            ";
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
											  title: 'Check Your Email: <?php echo $to_email ?>  ',
											  // text: 'Something went wrong!'
											  text: 'We have sent an email to recover your password.'
											  
											}).then(function() {
									    window.location = "signin.php";
									});
										</script>
										<?php
									    // echo "<script>alert('We have sent an email to recover your password.')</script>";
										// echo "<script>window.open('signin.php', '_self')</script>";
									} else {
									    echo "Email sending failed..."; 
									}

					        		//header('location: ');

					        	}
					        	else{
					        		echo"<script>alert('Email dose not exist')</script>";
					        	}

					        }

					        ?>
					      </div>
					    </div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
			</div>
		</div>
	</div>
</div>
</body>

<?php include ("includes/footer.php"); ?>
</html>