<!DOCTYPE html>
<?php
include("includes/connection.php");
session_start();
include("checksession.php");
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>
<html>
<head>
	<title>View Your Posts</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style>
    #posts > .row:first-child{
      
    box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
    margin-bottom: 2rem;
    border-radius: 2rem;
    padding: 2rem;
    margin-top: -1rem;
    padding-top: 2.6rem !important;
    background: #189ad63d;
    }
#posts {
    background: #74b8d642;
    padding: 30px 30px!important;
    border-radius: 2rem;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
}
textarea:focus-visible {
    outline: 0px !important;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
}
.panel-info {
    border-color: #ffffff!important;
}
</style>
<body>
	<div class="row" style="margin: 1rem">
		<div class="col-sm-12">
			<center><h2>Comments</h2><br></center>
			<?php  
			  if(isset($_GET['post_id'])){
		global $con;

		$get_id = $_GET['post_id'];

		$get_posts = "select * from posts where post_id = '$get_id'";
		$run_posts = mysqli_query($con,$get_posts);

		$row_posts = mysqli_fetch_array($run_posts);

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$user = "select * from users where user_id = '$user_id' AND posts = 'yes' ";

		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		$user_com = $_SESSION['user_email'];
		$get_com = "select * from users where user_email = '$user_com '";

		$run_com = mysqli_query($con,$get_com);
		$row_com = mysqli_fetch_array($run_com);

		$user_com_id = $row_com['user_id'];
		$user_com_name = $row_com['user_name'];

		if(isset($_GET['post_id'])){
			$post_id = $_GET['post_id'];

		}
		$get_posts = "select post_id from users where post_id='$post_id'";
		$run_user = mysqli_query($con, $get_posts);

		$post_id = $_GET['post_id'];

		$post = $_GET['post_id'];

		$get_user = "select * from posts where post_id = '$post'";
		$run_user = mysqli_query($con, $get_user);
		$row = mysqli_fetch_array($run_user);

		$p_id = $row['post_id'];

		if($p_id != $post_id){
			echo "<script>alert('ERROR')</script>";
			echo "<script>window.open('home.php' , '_self')</script>";
		}else{
			if($content=="No" && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
							<img id='posts-img' src='imagepost/$upload_image' style=''>
						</div>
					</div><br>
			
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
							<p>$content</p>
							<img id='posts-img' src='imagepost/$upload_image' style=''>
						</div>
					</div><br>
			
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else{
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row post-header'>
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
		
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}//else condition ending

		?>
		<section id="get_comments">
			
		</section>
		<?php

		// include("functions/comments.php");

		echo '
		<div class= "row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-info">
					<div class="panel-body">
						
						<textarea id="comment" placeholder="Write your comment here!" class="pb-cmt-textarea" name="comment" ></textarea>
						<button onclick="addcomment()" class="btn btn-info pull-right" name="reply">Comment</button>
						
					</div>
				</div>
			</div>

		</div>

		';
		?>
		
		<script type="text/javascript">

			$(document).ready(function(){
				readComment();

			});
			function readComment(){

				var get_id = <?php echo $get_id; ?>;
				
				$.ajax({
					url : "functions/comments.php",
					type:"POST",
					data:{
						get_id:get_id
					},
					success:function(data,status){

						$("#get_comments").html(data);

					}

				});
			}
			setIntervel(readComment(),100);
		
			function addcomment(){
				//alert(post_id);
				var post_id = <?php echo $post_id; ?>;

				var user_id = <?php echo $user_id; ?>;
				// alert(user_id);
				var user_com_name = "<?php echo $user_com_name; ?>";
				// alert(user_id);


				var comment = $("#comment").val();
				
				if(comment == ""){
					alert('Enter your comment');
				}
				else{
					$.ajax({
					url: "insertcomment.php",
					type: "POST",
					data: {
						post_id:post_id,
						user_id:user_id,
						user_com_name:user_com_name,
						comment:comment
					},
					success:function(data,status){
						$("#comment").val("");
						readComment();
					}


				});

				}
				
			}
		</script>

		<?php
		

		// if(isset($_POST['reply'])){
		// 	$comment = htmlentities($_POST['comment']);

		// 	if($comment == ""){
		// 		echo "<script>alert('Enter your comment')</script>";
		// 		echo "<script>window.open('single.php?post_id=$post_id' , '_self')</script>";
		// 	}else{
		// 		$insert = "insert into comments (post_id,user_id,comment,comment_author,date) values('$post_id','$user_id','$comment','$user_com_name',NOW())";

		// 		$run = mysqli_query($con,$insert);
		// 		echo "<script>alert('We added your comment!')</script>";
		// 		echo "<script>window.open('single.php?post_id=$post_id' , '_self')</script>";


		// 	}
		// }	



		}



	}


			 ?>
			
		</div>
		
	</div>
</body>
<?php include ("includes/footer.php"); ?>
</html>