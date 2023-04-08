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

	<title>See results</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<div class="row">
	<center><h2>See Your Search Results</h2></center>
	<?php 
	results();

	?>
	
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