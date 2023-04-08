<!DOCTYPE html>
<?php

session_start();
include("checksession.php");
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>
<html>
<head>
	
	<title>Find People</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
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
<style type="text/css">
    .card {
        border-radius: 2rem;
        margin-top: 7rem;
        padding: 2rem;
    }
		#cover-img{
		height: 400px;
		width: 100%;
	}#profile-img{
		position: absolute;
		top: 160px;
		left: 40px;
	}
	#update_profile{
		position: relative;
		top: -33px;
		cursor: pointer;
		left: 93px;
		border-radius: 4px;
		background-color: rgba(0,0,0,0.1);
		transform: translate(-50%, -50%);
	}
	#button_profile{
		position: absolute;
		top: 82%;
		left: 50%;
		cursor: pointer;
		transform: translate(-50%, -50%);
	}

	#own_posts {
    background: #74b8d642;
    padding: 30px 35px !important;
    border-radius: 2rem;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    border: none !important;
}
	#own_posts > .row:first-child{
	 box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
    margin-bottom: 2rem;
    border-radius: 2rem;
    padding: 2rem;
    margin-top: -1rem;
    padding-top: 2.6rem !important;
    background: #189ad63d;
	}
	#posts-img{
		padding-top: 5px;
		padding-right: 10px;
		width: 100%;
		height: auto;
	}
	#post-header {
   
}
</style>
<body>
<div class="row">
	<?php 
		if(isset($_GET['u_id'])){
			$u_id = $_GET['u_id'];
	}
	if($u_id < 0 || $u_id = ""){
	 echo"<script type='text/javascript'>window.open('home.php','_self')</script>";

}
	else{

	?>
	<div class="col-sm-12">
		<?php 
			if(isset($_GET['u_id'])){

				global $con;
				$user_id = $_GET['u_id'];
				$select = "select * from users where user_id = '$user_id' ";
				$run = mysqli_query($con, $select);
				$row = mysqli_fetch_array($run);

				$name = $row['user_name'];

		}

		?>

		<?php
		 if(isset($_GET['u_id'])){
		 global $con;

		 $user_id = $_GET['u_id'];
		 $_SESSION['follow_id'] = $user_id;

		 $select = "select * from users where user_id = '$user_id' ";
		 $run = mysqli_query($con, $select);
		 $row = mysqli_fetch_array($run);

		 $id = $row['user_id'];
		 $image = $row['user_image'];
		 $name = $row['user_name'];
		 $f_name = $row['f_name'];
		 $l_name = $row['l_name'];
		 $describe_user = $row['describe_user'];
		 $country = $row['user_country'];
		 $gender = $row['user_gender'];
		 $register_date = $row['user_reg_date'];
		 $reg_date = date('Y-m-d', strtotime($register_date));



		 $user = $_SESSION['user_email'];
		 $get_user = "select * from users where user_email = '$user'";
		 $run_user = mysqli_query($con, $get_user);
		 $profile_pic = $row['user_image'];
		 $cover_img = $row['user_cover'];

		 $row = mysqli_fetch_array($run_user);
		 $usernow_id = $row['user_id'];


		// <div class='row'>
		//        <div class='col-sm-1'></div>
		//        <div class='col-sm-10'>
		// 		<div><img id='cover-img' class='img-rounded' src='cover/$cover_img' alt='cover'></div>
			
		// 	<div id='profile-img'>
		// 		<img src='users/$profile_pic' alt='Profile' class='img-circle' width='180px' height='185px'>
				
		// 	</div></div></div><br>
		 echo "
		       

		 	<div class='row' style='margin: 2rem'>
		 		<div class='col-sm-1'>		 			 			
		 		</div>
		 		<center>
		 			<div class='col-sm-3 card' style='background-color: #e6e6e6;'>
		 				<h2>About $f_name
		 				</h2>
		 				<img src='users/$image' class='img-circle' width = '150' height='150'><br> <br>
		 				<ul class='list-group'>
		 					<li class='list-group-item' title='Username'>	<strong>$f_name $l_name</strong></li>
		 					<li class='list-group-item' title='User Status'><strong style='color: gray'>$describe_user</strong></li>
		 					<li class='list-group-item' title='Gender'><strong>$gender</strong></li>
		 					<li class='list-group-item' title='Country'><strong>$user_country</strong></li>
		 					<li class='list-group-item' title='Registration DATE'><strong>$reg_date</strong></li>
		 				</ul>		


		 ";

		 $userown_id = $row['user_id'];

		 if($user_id == $userown_id){
		 echo "<a href='edit_profile.php?u_id=$userown_id' class='btn btn-success' />Edit Profile </a> <br><br><br> ";

		}
		else{
			echo "
			<form action='' method='POST' id='form1'>
			</form>

			<input onclick='myFunction()' id='follow' type='submit' name='follow' class='btn btn-success' value='Follow'></input> <br>
			<input onclick='myFunction2()' id='unfollow' type='submit' name='ufollow' class='btn btn-warning' value='Unfollow'></input> <br><br><br>
			
			";
			$followquery = "SELECT * FROM `follow` WHERE follower_id = $usernow_id and following_id = $user_id" ;

			$runfollow = mysqli_query($con,$followquery);
			$fetchfollow = mysqli_num_rows($runfollow);
			//echo $fetchfollow;
			if($fetchfollow){
				$showfollow = 1;
			}
			else{
				$showfollow = 0;
			}
		}
		echo"
			</div>
		</center>

		";
 

		}

		?>
		<script>
			var x2 = document.getElementById("unfollow");
			var x = document.getElementById("follow");
			var showfollow = <?php echo $showfollow; ?>;
			if(showfollow == 1){
				x.style.display = "none";

			}
			else{
				x2.style.display = "none";
			}
			//x2.style.display = "none";
			function myFunction() {
				  var x = document.getElementById("follow");
				  var x2 = document.getElementById("unfollow");
				  var current_user = <?php echo $usernow_id; ?>;
				  var followed_user = <?php echo $user_id; ?>;
				  
				  alert(followed_user);
				    x.style.display = "none";
				    x2.style.display = "block";
				    $.ajax({
				     type: "post",
			         url: "follow.php",
				        
			         data: {
			         	current_user:current_user,
			         	followed_user:followed_user

			         },
			        
			         success: function(data){
			               alert(data);
			         }
			});
				  
				}
				function myFunction2() {
				   
				  var x = document.getElementById("follow");
				  var x2 = document.getElementById("unfollow");
				  var current_user = <?php echo $usernow_id; ?>;
				  var followed_user = <?php echo $user_id; ?>;
				   alert(current_user,followed_user);
				  
				  
				    x.style.display = "block";
				    x2.style.display = "none";
				    $.ajax({
			         data: {
			         	current_user:current_user,
			         	followed_user:followed_user

			         },
			         type: "post",
			         url: "unfollow.php",
			         success: function(data){
			         	// Swal.fire({
		           //          icon: 'success',
		           //          title: 'You Unfollowed <?php echo $f_name; ?> ',
		           //          // text: 'Something went wrong!'
		           //          // text: 'Your Password is updated sucessfully'
		                    
		           //        })
			              // alert("Data Save: " + data);
			         }
			});
				  
				}
		    
			
		</script>
		<div class='col-sm-7'>
			<center><h1><strong><?php echo "$f_name $l_name's"; ?></strong> Posts</h1></center>

		<?php
		global $con;
		if(isset($_GET['u_id'])){
			$u_id = $_GET['u_id']; 

		}
		$get_posts = "select * from posts where user_id = '$u_id' order by 1 DESC LIMIT 5";
		$run_posts = mysqli_query($con, $get_posts);

		while ($row_posts = mysqli_fetch_array($run_posts)) {

			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$content = $row_posts['post_content'];
			$upload_image = $row_posts['upload_image'];
			$post_date = $row_posts['post_date'];

			$user = "select * from users where user_id = '$user_id' AND posts='yes' ";

			$run_user = mysqli_query($con , $user);
			$row_user = mysqli_fetch_array($run_user);

			$user_name = $row_user['user_name'];
			$f_name = $row_user['f_name'];
			$l_name = $row_user['l_name'];
			$user_image = $row_user['user_image'];

			# code...
			if($content == "No" && strlen($upload_image) >= 1){
				echo "
				<div id='own_posts'>
					<div class='row' id='post-header'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>

					<div class='row'>
						<div class='col-sm-12'>
							
							<img id='posts-img' src='imagepost/$upload_image' style=''>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a><br>
				
					

				</div><br><br>
					

				";
			
			}

			else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
				echo "

				<div id='own_posts'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>

					<div class='row'>
						<div class='col-sm-12'>
							<h3><p>$content</p></h3>
							<img id='posts-img' src='imagepost/$upload_image' style=''>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a><br>
					
					

				</div><br><br>
		

				";
			}
			else if($content == "No" && strlen($upload_image) == 0 ){
			    echo "<h2>No Posts Yet</h2>";
			}
			else {
				echo "

				<div id='own_posts'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>

					<div class='row'>
						<div class='col-sm-12'>
							<h3><p>$content</p></h3>
							
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a><br>
				
					

				</div><br><br>


				";
			}
		}

			
	?>
	</div>
  </div>

<?php 
}

?>
</div>

</body>
</div>
<?php include ("includes/footer.php");  ?>
</html>