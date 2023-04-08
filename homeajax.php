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
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_name = $row['user_name'];
	?>
	<title><?php echo "$user_name"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<div class="row">
	<div id="insert_post" class="col-sm-12">
		<center>
		<form id="imageUploadForm"  enctype="multipart/form-data">
		<textarea class="form-control" id="content" rows="4" name="content" placeholder="Write something about collection"></textarea><br>
		
		<label class="btn btn-warning" id="upload_image_button">Select Image
		<input type="file" name="upload_image" id="upload_image" size="30">
		
		</label>
		<input type="hidden" name="user_id" id="user_id" value="<?php echo($user_id) ?>">
		
		<!-- <img id="blah" src="#" alt="your image" /><br><br> -->
		<input type="button" id="btn-post" name="submit" class="btn btn-success submitBtn" value="Post"/>
		<!-- <button  id="btn-post" class="btn btn-success" name="sub">Post</button> -->
		</form>
		
		</center>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
    // Submit form data via Ajax
    $(".submitBtn").click(function(){
    	// alert("1");
        // e.preventDefault();
		
		var user_id = <?php echo $user_id;?>;
		
		var content = $("#content").val();
		var img = $('#upload_image').val();
		if(img == ""){
			alert("Please select image");
		}else{



        var fd = new FormData();
        var files = $('#upload_image')[0].files[0];
        fd.append('upload_image',files);
        // fd.append(user_id);
        // fd.append(content);
        console.log(fd);
        $.ajax({
            type: 'POST',
            url: 'insertPost.php',
            
            data: fd,
            
            contentType: false,
            
            processData:false,

            success: function(data,status){ 
            //console.log(response);
            alert(data);
                
            }
        });
    }
    });
});
	// File type validation
// $("#upload_image").change(function() {
// 	alert("2");
//     var file = this.files[0];
//     var fileType = file.type;
//     var match = [ 'image/jpeg', 'image/png', 'image/jpg'];
//     if(!(((fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
//         alert('Sorry, only JPG, JPEG, & PNG files are allowed to upload.');
//         $("#upload_image").val('');
//         return false;
//     }
// });
	// $("#imageUploadForm").on('submit',(function(e){
	// 	e.preventDefault();
		
	// 	var formData = new FormData(this);
		
	// 	var user_id = <?php //echo $user_id;?>;
		
	// 	var content = $("#content").val();

	// 	var upload_image = $("#upload_image").val();
	// 	// alert(upload_image);
	// 	$.ajax({
	// 		url: "insertPost.php",
	// 		type:"POST",
	// 		data: formData,
	// 		success:function(data,status){
	// 			alert(data);

	// 			// get_posts();
	// 		}
	// 		// cache: false,
 //   //      	contentType: false,
 //   //      	processData: false

	// 	});


	// }));

	
</script>
<div class="row">
	<div class="col-sm-12">
		<center><h2><strong>See All Posts</strong></h2><br></center>
		<?php echo get_posts(); ?>
	</div>
</div>
</body>
<?php include ("includes/footer.php"); ?>
</html>
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