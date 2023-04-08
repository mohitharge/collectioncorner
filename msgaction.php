<?php
		include("includes/connection.php");
		extract($_POST);
		if(isset($_POST['user_to']) && isset($_POST['user_from']) && isset($_POST['msg'])){
			
				$insert = "insert into user_messages(user_to,user_from,msg_body,date,msg_seen) values('$user_to','$user_from','$msg',NOW(),'no') ";

				$run_insert = mysqli_query($con,$insert);
				if($run_insert){
					

				}


			}

			if(isset($_POST['readmsg']) && isset($_POST['user_to']) && isset($_POST['user_from'])){
				$data= "";

			  $sel_msg = "select * from user_messages where (user_to = '$user_to' AND user_from = '$user_from')  OR  (user_to = '$user_from' AND user_from = '$user_to') ORDER by 1 ASC";

			  $run_msg=mysqli_query($con,$sel_msg);

			  while ($row_msg = mysqli_fetch_assoc($run_msg)) {
			  	   
			  	   $user_t = $row_msg['user_to'];
			  	   $user_fro = $row_msg['user_from'];
			  	   $msg_body = $row_msg['msg_body'];
			  	   $msg_date = $row_msg['date'];

			  	   $date = date('h:i a', strtotime($msg_date));
			  	   ?>
			  	   <div id="loaded_msg">
			  	   		<p>
			  	   			<?php if($user_t == $user_to AND $user_fro == $user_from){
			  	   				$data .= "
			  	   				<div class='message' id='blue' data-toggle='tooltip' title='$msg_date'>
			  	   				$msg_body
			  	   				

			  	   				</div><br><br>
			  	   				<small style='float: right;'>$date</small><br><br>

			  	   				";
			  	   			} 
			  	   			else if ($user_fro == $user_to AND $user_t == $user_from){
			  	   				$data .=  "
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
			  echo $data;

		

			}

	?>
