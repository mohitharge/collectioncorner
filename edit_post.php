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
    <link rel="icon" type="image/x-icon" href="images/favico.png">
	<title>Edit post</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="icon" type="image/x-icon" href="images/favico.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
	
	<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
	<style type="text/css">
		@media only screen and (max-width: 992px) {
		footer {
  position: relative !important;
  left: 0;
  bottom: 0;
  width: 100%;
  text-align: center;
}

}
footer {
  position: relative;
  left: 0;
  bottom: 0;
  width: 100%;
  text-align: center;
}
	.ck-editor__editable_inline {
	    min-height: 300px;
	   
	}
		.ck-editor{
	    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
	}
	#f{
	    margin-top: 3rem;
	}
	nav{
            padding: 1rem;
            position: sticky!important;
            top: 0px;
            min-height: 7rem !important;
            z-index: 1;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
        }
        .navbar-nav {
            float: right!important;
            margin: auto!important;
        }
        .navbar-nav>li>a {
            font-size: 2rem!important;
            font-weight: bold!important;
        }
	</style>
</head>
<body>
	<div class="row">
		<div class="col-sm-3">
			
		</div>
		<div class="col-sm-6">
			<?php 
				if(isset($_GET['post_id'])){
					$get_id = $_GET['post_id'];

					$get_post = "select * from posts where post_id = '$get_id' ";
					$run_post = mysqli_query($con,$get_post);
					$row = mysqli_fetch_array($run_post);

					$post_con = $row['post_content'];


				}

			?>
			<form action="" method="post" id="f">
				<center><h1>Edit your post</h1></center><br>
				<textarea class="form-control" id="txt_edit" cols="83" rows="4" name="content" required ><?php echo $post_con; ?></textarea><br>
				<input type="submit" name="update" value="Upadte Post" class="btn btn-info"/>				
			</form>

			<?php
				if(isset($_POST['update'])){
					$content = $_POST['content'];

					$update_post = "update posts set post_content = '$content' where post_id='$get_id' ";
					$run_update = mysqli_query($con,$update_post);


					if ($run_update) {
						echo "<script>alert('Your post has been updated') </script>";
						echo "<script>window.open('home.php', '_self')</script>";
						# code...
					}
				}

			?>
		</div>
		<div class="col-sm-3">
			
		</div>
	</div>
</body>
<?php include ("includes/footer.php"); ?>
</html>
<script>
    ClassicEditor
        .create( document.querySelector( '#txt_edit' ) )
        .catch( error => {
            console.error( error );
        } );
</script>