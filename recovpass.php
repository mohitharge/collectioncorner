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

session_start();
  include("includes/connection.php");
  if(isset($_GET['token'])){
  	$token = $_GET['token'];

  	$getuser = "select * from users where token = '$token' ";
  	$query1 = mysqli_query($con,$getuser);
  	$fetchuser = mysqli_fetch_assoc($query1);
  	$firstname = $fetchuser['f_name'];

  	   ?>
  	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	   <div class="container" style="margin-top: 20px; width: 20%">
  	   	<h2>Hello <?php echo $firstname; ?>,</h2>
  	   	<form action="" method="post">
  	   	<input type="password" name="pass" placeholder="Enter New Password" required="required" class="form-control input-sm"><br>
  	   	<button class="btn btn-primary" name="submit">Update</button>
  	   </form>
  	   	
  	   </div>
  	   
  	   <?php
  	   if(isset($_POST['submit'])){
  	   	
  	   	$pass = $_POST['pass'];
  	   	$password = password_hash($pass, PASSWORD_BCRYPT);
  	   	$update = "update users set user_pass = '$password' where token = '$token'";
  	   	$query = mysqli_query($con,$update);

	  	if($query){
        ?>
        <script type="text/javascript">
          Swal.fire({
                    icon: 'success',
                    title: 'Password updated',
                    // text: 'Something went wrong!'
                    text: 'Your Password is updated sucessfully'
                    
                  }).then(function() {
                  window.location = "signin.php";
              });
        </script>
        <?php
	  		// echo "<script>alert('Password updated')</script>";
	  		// echo "<script>window.open('signin.php','_self')</script>";
	  		
	  	}
	  	else{
	  		echo "<script>alert('Not updated')</script>"; 	
	  			


  	   }

  	// $update = "update users set status = 'verified' where token = '$token'";
     
  	
  	}
  }

?>