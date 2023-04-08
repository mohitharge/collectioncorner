<!DOCTYPE html>
<?php

session_start();
include("checksession.php");


if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="images/favico.png">
	<?php
	include("includes/header.php");
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_name = $row['user_name'];

	?>
	<title><?php echo "$user_name"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
	<style>
	body::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
	border-radius: 10px;
}

body::-webkit-scrollbar
{
	width: 10px;
	background-color: #F5F5F5;
}

body::-webkit-scrollbar-thumb
{
	border-radius: 10px;
	background-image: -webkit-gradient(linear,
									   left bottom,
									   left top,
									   color-stop(0.44, rgb(122,153,217)),
									   color-stop(0.72, rgb(73,125,189)),
									   color-stop(0.86, rgb(28,58,148)));
}
	.ck-editor__editable_inline {
	    min-height: 300px;
	}
	.ck.ck-editor {
    position: relative;
    z-index: 0!important;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
		.swal2-popup {
		width: auto!important;
		height: auto!important;
	}
	.swal2-html-container {
		font-size: 1.8rem;
	}
	.row {
    margin-right: 0px !important;
    margin-left: 0px !important;
}
.pagination a:hover:not(.active) {
    background-color: #a5cfe4!important;
}
.pagination a{
    background-color: #ddd ;
    margin-right:1.5rem;
    border-radius: 5px;
}
</style>

</head>
<body>
<div class="row">
	<div id="insert_post" class="col-sm-12">
		<center>
		<form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
		<textarea class="form-control" id="content"  name="content" placeholder="Write something about collection"></textarea><br>
		<label class="btn btn-warning" id="">Select Image
		<input type="file" name="upload_image" size="30" onchange="readURL(this);">
		
		</label>
		<!-- <img id="blah" src="#" alt="your image" /><br><br> -->
		<button id="btn-post" class="btn btn-success" name="sub">Post</button>
		</form>
		<?php insertPost(); ?>
		</center>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<center><h1><strong>See All Posts</strong></h1><br></center>
		<?php echo get_posts(); ?>
	</div>
</div>
</body>
<?php include ("includes/footer.php"); ?>
</html>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

<!-- <script type="text/javascript">
	function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        
                        .height(350);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script> -->
