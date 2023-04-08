
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
	
	<title>Messages</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style type="text/css">

	#scroll_messages{
		max-height: 500px;
		overflow: scroll;
	}
	#btn-msg{
		width: 20%;
		height: 28px;
		border-radius: 5px;
		margin: 5px;
		color: #fff;
		float: right;
		background-color: #2ecc71;
	}
	#select_user{
		max-height: 500px;
		overflow: scroll;
	}
	#green{
		background-color: #2ecc71;
		border-color: #27ae60;
		/*width: 45%;*/
		padding: 3px 40px 3px 10px;
		font-size: 16px;
		border-radius: 3px;
		float: left;
		margin-bottom: 5px;
	}
	#blue{
		background-color: #3498db;
		border-color: #2980b9;
		/*width: 45%;*/
		padding: 3px 10px 3px 40px;
		font-size: 16px;
		border-radius: 3px;
		float: right;
		text-align: right;
		margin-bottom: 5px;
	}


</style>
<body>
<div class="row">
	<?php
		if(isset($_GET['u_id'])){
			global $con;
			$get_id = $_GET['u_id'];
			$get_user = "select * from users where user_id='$get_id' ";
			$run_user = mysqli_query($con, $get_user);
			$row_user = mysqli_fetch_array($run_user);

			$user_to_msg = $row_user['user_id'];
			$user_to_name = $row_user['user_name'];

		}

		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email = '$user' ";
		$run_user = mysqli_query($con, $get_user);
		$row = mysqli_fetch_array($run_user);

		$user_from_msg = $row['user_id'];
		$user_from_name = $row['user_name'];

	?>

	<div class="col-sm-3" id="select_user">
		<?php 

		 $user = "select * from users where user_id != $user_from_msg";

		 $run_user = mysqli_query($con,$user);
		 while($row_user = mysqli_fetch_array($run_user)){

		 	$user_id = $row_user['user_id']; 
			$user_name = $row_user['user_name'];
			$first_name = $row_user['f_name'];
			$last_name = $row_user['l_name'];
			$user_image = $row_user['user_image'];

			echo "
			   <div class='container-fluid'>
			   		<a style='text-decoration: none; cursor: pointer; color: #3897F0' href='messages.php?u_id=$user_id'>
			   	    <img src='users/$user_image' class='img-circle' width='90px' height='80px' title='$user_name'/> <strong>&nbsp; $first_name $last_name </strong><br><br>
			   	    </a>
			   	
			   </div>

			";
		 }

		?>
		
	</div>
	<div class="col-sm-6">
		<div class="load_msg" id="scroll_messages">
			<?php
			  $sel_msg = "select * from user_messages where (user_to = '$user_to_msg' AND user_from = '$user_from_msg')  OR  (user_to = '$user_from_msg' AND user_from = '$user_to_msg') ORDER by 1 ASC";

			  $run_msg=mysqli_query($con,$sel_msg);

			  while ($row_msg = mysqli_fetch_assoc($run_msg)) {
			  	   
			  	   $user_to = $row_msg['user_to'];
			  	   $user_from = $row_msg['user_from'];
			  	   $msg_body = $row_msg['msg_body'];
			  	   $msg_date = $row_msg['date'];

			  	   $date = date('h:i a', strtotime($msg_date));
			  	   ?>
			  	   <div id="loaded_msg">
			  	   		<p>
			  	   			<?php if($user_to == $user_to_msg AND $user_from == $user_from_msg){
			  	   				echo "
			  	   				<div class='message' id='blue' data-toggle='tooltip' title='$msg_date'>
			  	   				$msg_body
			  	   				

			  	   				</div><br><br>
			  	   				<small style='float: right;'>$date</small><br><br>

			  	   				";
			  	   			} 
			  	   			else if ($user_from == $user_to_msg AND $user_to == $user_from_msg){
			  	   				echo "
			  	   				<div class='message' id='green' data-toggle='tooltip' title='$msg_date'>
			  	   				$msg_body

			  	   				</div><br><br>
			  	   				<small style='float: left;'>$date</small><br><br>

			  	   				";
			  	   			} 

			  	   			?>
			  	   		</p>
			  	   </div>


			  	   <?php

			  }

			?>
			
		</div>
		<?php 

		if(isset($_GET['u_id'])){
			$u_id = $_GET['u_id'];
			 if($u_id == $user_from_msg){
			 	echo '
			 	<form>
			 		<center>
			 			<h3>Select someone to chat</h3>
			 		</center>
			 		<textarea disabled class="form-control" placeholder="Enter your message"></textarea>
			 		
			 	</form><br><br>

			 	';
			 }
			 else{
			 	echo '
			 	<form action="" method="POST">

			 		<textarea  class="form-control" placeholder="Enter your message" name="msg_box" id="message_textarea"></textarea>
			 		<input type="submit" class="btn btn-default" name="send_msg" id="btn-msg"  value="send">
			 	</form><br><br>

			 	';

			}
			
		}

		?>

		<?php
		if(isset($_POST['send_msg'])){
			$msg = htmlentities($_POST['msg_box']);

			if($msg == ""){
			echo '<h4 style="color: red; text-align: center;">Message is empty</h4>' ;
			}else if(strlen($msg)>37){
			echo '<h4 style="color: red; text-align: center;">Message is too long! use upto 37 characters</h4>' ;
			}else{
				$insert = "insert into user_messages(user_to,user_from,msg_body,date,msg_seen) values('$user_to_msg','$user_from_msg','$msg',NOW(),'no') ";

				$run_insert = mysqli_query($con,$insert);
				if($run_insert){
					

				}


			}
		}


		?>
		
	</div>
	<div class="col-sm-3">
		<?php
			if(isset($_GET['u_id'])){
			global $con;
			$get_id = $_GET['u_id'];
			$get_user = "select * from users where user_id='$get_id' ";

			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id = $row['user_id'];
			$user_image = $row['user_image'];
			$user_name = $row['user_name'];
			$f_name = $row['f_name'];
			$l_name = $row['l_name'];
			$describe_user = $row['describe_user'];
			$user_country = $row['user_country'];
			$gender = $row['user_gender'];
			$register_date = $row['user_reg_date'];
			$reg_date = date('Y-m-d', strtotime($register_date));
		}
		
		if($get_id == $user_from_msg){

	}else{
			 echo "
		       

		 	<div class='row'>
		 		<div class='col-sm-2'>		 			 			
		 		</div>
		 		<center>
		 			<div class='col-sm-9' style='background-color: #e6e6e6;'>
		 				<h2>About $f_name
		 				</h2>
		 				<img src='users/$user_image' class='img-circle' width = '150' height='150'><br> <br>
		 				<ul class='list-group'>
		 					<li class='list-group-item' title='Username'>	<strong>$f_name $l_name</strong></li>
		 					<li class='list-group-item' title='User Status'><strong style='color: gray'>$describe_user</strong></li>
		 					<li class='list-group-item' title='Gender'><strong>$user_gender</strong></li>
		 					<li class='list-group-item' title='Country'><strong>$user_country</strong></li>
		 					<li class='list-group-item' title='Registration DATE'><strong>$reg_date</strong></li>
		 				</ul>		
			</div>
		</center>

		 ";
}
?>
		</div>
	</div>
</div>
<script type="text/javascript">
	var div = document.getElementById("scroll_messages");
	div.scrollTop = div.scrollHeight;
</script>
</body>
<?php include ("includes/footer.php"); ?>
</html>