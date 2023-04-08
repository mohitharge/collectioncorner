
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
    #message_textarea{
        height: auto;
        margin-left: 5rem;
        width: 70%;
        margin-top: 2rem;
        box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px;
    }
	#msg_scroll{
		max-height: 500px;
		
	}

	#btn-msg{
		width: 20%;
		height: 40px;
		border-radius: 5px;
		margin: 5px;
		color: #fff;
		float: right;
		background-color: #2ecc71;
	}
	button:focus:not(:focus-visible) {
  	outline: none;
  	/*box-shadow: 1px 1px 5px rgba(1, 1, 0, .7);*/
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

      #select_user::-webkit-scrollbar-track
    {
    	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    	background-color: #F5F5F5;
    	border-radius: 10px;
    }
    
    #select_user::-webkit-scrollbar
    {
    	width: 10px;
    	background-color: #F5F5F5;
    }
    
    #select_user::-webkit-scrollbar-thumb
    {
    	border-radius: 10px;
    	background-image: -webkit-gradient(linear,
    									   left bottom,
    									   left top,
    									   color-stop(0.44, rgb(122,153,217)),
    									   color-stop(0.72, rgb(73,125,189)),
    									   color-stop(0.86, rgb(28,58,148)));
    }
    #style-6{
        border-radius: 1rem;
        box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px;
    }
    #select_user{
        border-radius: 1rem;
        margin-bottom: 3rem;
        box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px;
    }
    
    #style-6::-webkit-scrollbar-track
    {
    	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    	background-color: #F5F5F5;
    	border-radius: 10px;
    }
    
    #style-6::-webkit-scrollbar
    {
    	width: 10px;
    	background-color: #F5F5F5;
    }
    
    #style-6::-webkit-scrollbar-thumb
    {
    	background-color: #F90;	
    	border-radius: 10px;
    	background-image: -webkit-linear-gradient(45deg,
    	                                          rgba(255, 255, 255, .2) 25%,
    											  transparent 25%,
    											  transparent 50%,
    											  rgba(255, 255, 255, .2) 50%,
    											  rgba(255, 255, 255, .2) 75%,
    											  transparent 75%,
    											  transparent)
    }





    .scrollbar
    {

    	height: 45rem;
    	background: #F5F5F5;
    	overflow-y: scroll;
    	padding-top:1rem;
    
    }
    strong{
        color: black;
    }
    .form-control[disabled], fieldset[disabled] .form-control {
    cursor: not-allowed;
    width: 95.5%!important;
    margin-left: 5rem!important;
}
    #btn-msg {
    width: 20%;
    height: 40px;
    border-radius: 5px;
    margin: 5px;
    color: #fff;
    float: right;
    background-color: #2ecc71;
    position: relative;
    top: -50px;
    left: 20px;
}
@media only screen and (max-width: 768px){
    #btn-msg {
    width: 20%;
    height: 40px;
    border-radius: 5px;
    margin: 5px;
    color: #fff;
    float: right;
    background-color: #2ecc71;
    position: relative;
    top: -50px;
    left: 20px;
}
}

</style>
<body>
    <center style="margin-top:3rem"><h1>Chat with your Friends</h1></center>
<div class="row" style="margin-top: 3rem; padding: 3rem">
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
	<div class="col-sm-3 scrollbar" id="select_user">
	    <center><h2>Friends</h2></center><br>
		<?php 
// SELECT * FROM follow,users WHERE user_id != 52 AND users.user_id = follow.follower_id;
		 $user = "select * from users where user_id != $user_from_msg AND user_id IN(SELECT following_id FROM follow WHERE follower_id = $user_from_msg)";

		 $run_user = mysqli_query($con,$user);
		 $rows_user = mysqli_num_rows($run_user);
		 // echo $rows_user;

		 

		 while($row_user = mysqli_fetch_assoc($run_user)){

		 	$user_id = $row_user['user_id']; 
			$user_name = $row_user['user_name'];
			$first_name = $row_user['f_name'];
			$last_name = $row_user['l_name'];
			$user_image = $row_user['user_image'];

			echo "
			
			   <div class='container-fluid force-overflow'>
			   		<a style='text-decoration: none; cursor: pointer; color: #3897F0' href='messages.php?u_id=$user_id'>
			   	    <img src='users/$user_image' class='img-circle' width='90px' height='80px' title='$user_name'/> <strong>&nbsp; $first_name $last_name </strong><br><br>
			   	    </a>
			   	
			   </div>

			";
		 }

		?>
		
	</div>
	<div class="col-sm-6 " >
	    <div class="row">
	        <div class="col-sm-1"></div>
	        <div class="col-sm-11 scrollbar" id="style-6">
	            <center><h2>Messages</h2></center><br>
	           <section id="msg_scroll">	
	            <div class="load_msg" id="scroll_messages">
		    </div>
		</section> 
	        </div>
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
			 		<textarea class="form-control" required placeholder="Enter your message" name="msg_box" id="message_textarea"></textarea>
			 		<button  onclick="addmsg()" class="btn btn-default" name="send_msg" id="btn-msg"  value="send">Send</button>
			 	<br><br>

			 	';

			}
			
		}

		?>
		
	</div>

	<script type="text/javascript">
			

		$(document).ready(function(){
			// var div = document.getElementById("msg_scroll");
			// div.scrollTop = div.scrollHeight;


			readmsg();


		});
		
		setInterval(function readmsg(){

			var div = document.getElementById("msg_scroll");
			div.scrollTop = div.scrollHeight;
			var readmsg = "readmsg";
			var user_to = <?php echo $user_to_msg; ?>;
			var user_from = <?php echo $user_from_msg; ?>;
			$.ajax({
				url: "msgaction.php",
				type: "POST",
				data: {
					readmsg:readmsg,
					user_to :user_to,
					user_from :user_from,
				},
				success:function(data,status){
					//alert("display");
					$('#scroll_messages').html(data);
				}

			})
		}, 200);
		
		function addmsg(){


			var div = document.getElementById("msg_scroll");
			div.scrollTop = div.scrollHeight;
			// $("#scroll_messages").scrollTop(9000);

			var user_to = <?php echo $user_to_msg; ?>;
			var user_from = <?php echo $user_from_msg; ?>;
			var msg = $('#message_textarea').val();
			if (msg == ""){
				alert("Please Enter your message");

			}
			else{


			//alert(user_from);
			$.ajax({
				url: "msgaction.php",
				type: "POST",
				data: {
					user_to :user_to,
					user_from :user_from,
					msg :msg


				},
				success:function(data,status){
					//alert("Sucess");
					$('#message_textarea').val("");
					
					readmsg();
				}


			});
		}
	}
	</script>
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
		 		<div class='col-sm-1'>	</div>
		 			<div class='col-sm-11' style='background-color: #e6e6e6; max-height: 45rem; padding:0rem 2rem; border-radius: 1rem; box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px;'>
		 			<center>
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
		 					</center>
			    </div>
	

		 ";
}
?>
		</div>
	</div>
</div>
</body>
<?php  include ("includes/footer.php"); ?>
</html>
