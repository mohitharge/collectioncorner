<?php 
include("includes/connection.php");
extract($_POST);
if(isset($_POST['post_id']) && isset($_POST['user_id']) && isset($_POST['user_com_name']) && isset($_POST['comment'])){
	
		$insert = "insert into comments (post_id,user_id,comment,comment_author,date) values('$post_id','$user_id','$comment','$user_com_name',NOW())";

		$run_insert = mysqli_query($con,$insert);
		if($run_insert){
			

		}


	}
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
?>