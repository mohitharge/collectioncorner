<?php 
session_start();
include("includes/connection.php");

        $user = $_SESSION['user_email'];
        $get_user = "select * from users where user_email='$user'";
        $run_user = mysqli_query($con,$get_user);
        $row = mysqli_fetch_array($run_user);

        $user_id = $row['user_id'];
    
$filename = $_FILES['upload_image']['name'];
$location = "imagepost/".$filename;
$uploadok = 1;
$imagefiletype = pathinfo($location,PATHINFO_EXTENSION);
$validimage = array('jpg','png','jpeg');

if(!in_array(strtolower($imagefiletype), $validimage)){
    $uploadok = 0;
}
if($uploadok == 0){
    echo "0";
}else{
    if(move_uploaded_file($_FILES['upload_image']['tmp_name'], $location)){
        
        $insert = "insert into posts (user_id,post_content,upload_image,post_date) values ('$user_id','No','$filename',NOW())";
                     $run = mysqli_query($con, $insert);

                     if($run){
                         echo "$location";

                         $update = "update users set posts='yes' where user_id='$user_id'";
                         $run_update = mysqli_query($con, $update);
                     }
    }
    else{
        echo "000";
    }
}
// //extract($_POST);
// $uploadDir = 'imagepost/';
// $response = array( 
//     'status' => 0, 
//     'message' => 'Form submission failed, please try again.' 
// ); 
// if(isset($_POST['user_id']) && (isset($_POST['content']) or isset($_POST['upload_image']))){
// 	    $content = $_POST['content'];
// 	    $user_id = $_POST['user_id']; 

// 		// $upload_image = $_FILES['upload_image']['name'];
// 		// $image_tmp = $_FILES['upload_image']['tmp_name'];
// 		if(strlen($content) > 2500){
// 			echo "<script>alert('Please Use 2500 or less than 2500 words!')</script>";
// 			echo "<script>window.open('home.php', '_self')</script>";
// 		}else{
// 			if(strlen($upload_image) >= 1 && strlen($content) >= 1){
// 					    $uploadStatus = 1; 
             
//             // Upload file 
//             $uploadedFile = ''; 
//             if(!empty($_FILES["file"]["name"])){ 
                 
//                 // File path config 
//                 $fileName = basename($_FILES["file"]["name"]); 
//                 $targetFilePath = $uploadDir . $fileName; 
//                 $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
//                 // Allow certain file formats 
//                 $allowTypes = array('jpg', 'png', 'jpeg'); 
//                 if(in_array($fileType, $allowTypes)){ 
//                     // Upload file to the server 
//                     if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
//                         $uploadedFile = $fileName; 
//                     }else{ 
//                         $uploadStatus = 0; 
//                         $response['message'] = 'Sorry, there was an error uploading your file.'; 
//                     } 
//                 }else{ 
//                     $uploadStatus = 0; 
//                     $response['message'] = 'Sorry, only JPG, JPEG, & PNG files are allowed to upload.'; 
//                 } 
//             } 
//             if($uploadStatus == 1){


// 				$insert = "insert into posts (user_id, post_content, upload_image, post_date) values('$user_id', '$content', '$upload_image', NOW())";

// 				$run = mysqli_query($con, $insert);

// 				if($run){
// 					$response['status'] = 1; 
//                     $response['message'] = 'Form data submitted successfully!'; 

// 					$update = "update users set posts='yes' where user_id='$user_id'";
// 					$run_update = mysqli_query($con, $update);
// 				}
// 			}

// 				exit();
// 			}else{
// 				if($upload_image=='' && $content == ''){
// 					echo "<script>alert('Error Occured while uploading!')</script>";
// 					echo "<script>window.open('home.php', '_self')</script>";
// 				}else{
// 					if($content==''){
// 							    $uploadStatus = 1; 
             
//             // Upload file 
//             $uploadedFile = ''; 
//             if(!empty($_FILES["file"]["name"])){ 
                 
//                 // File path config 
//                 $fileName = basename($_FILES["file"]["name"]); 
//                 $targetFilePath = $uploadDir . $fileName; 
//                 $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
//                 // Allow certain file formats 
//                 $allowTypes = array('jpg', 'png', 'jpeg'); 
//                 if(in_array($fileType, $allowTypes)){ 
//                     // Upload file to the server 
//                     if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
//                         $uploadedFile = $fileName; 
//                     }else{ 
//                         $uploadStatus = 0; 
//                         $response['message'] = 'Sorry, there was an error uploading your file.'; 
//                     } 
//                 }else{ 
//                     $uploadStatus = 0; 
//                     $response['message'] = 'Sorry, only JPG, JPEG, & PNG files are allowed to upload.'; 
//                 } 
//             } 
//             if($uploadStatus == 1){
// 						$insert = "insert into posts (user_id,post_content,upload_image,post_date) values ('$user_id','No','$upload_image',NOW())";
// 						$run = mysqli_query($con, $insert);

// 						if($run){
// 							$response['status'] = 1; 
//                     		$response['message'] = 'Form data submitted successfully!'; 

// 							$update = "update users set posts='yes' where user_id='$user_id'";
// 							$run_update = mysqli_query($con, $update);
// 						}
// 					}

// 						exit();
// 					}else{
// 						$insert = "insert into posts (user_id, post_content, post_date) values('$user_id', '$content', NOW())";
// 						$run = mysqli_query($con, $insert);

// 						if($run){
// 							echo "<script>alert('Your Post updated a moment ago!')</script>";
// 							echo "<script>window.open('home.php', '_self')</script>";

// 							$update = "update users set posts='yes' where user_id='$user_id'";
// 							$run_update = mysqli_query($con, $update);
// 						}
// 					}
// 				}
// 			}
// 		}

// }

?>