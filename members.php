
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
<?php include ("includes/head.php"); ?>
<style type="text/css">
.profile-card{
    text-decoration: none;
    cursor: pointer;
    color: #000000;
    position: absolute;
    left: 14rem;
}
    #find_people{
        background:#74b8d642;
    	padding: 30px 20px;
    	border-radius: 2rem;
    	margin: 0.1px;
    	box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
    
    }
@media only screen and (max-width: 992px) {
		footer {
          position: relative !important;
          left: 0;
          bottom: 0;
          width: 100%;
          text-align: center;
        }
}
@media only screen and (max-width: 768px) {
        .profile-card {
            text-decoration: none;
            cursor: pointer;
            color: #000000;
            position: absolute;
            left: 21rem;
        }
        #find_people {
            background: #74b8d642;
            padding: 30px 20px;
            border-radius: 2rem;
            margin: 0.1px;
            box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
            margin-bottom: 6rem!important;
        }
        	footer {
          position: fixed;
          left: 0;
          bottom: 0;
          width: 100%;
          text-align: center;
        }
}


.col-sm-12 {
    position: relative;
    min-height: 1px;
    padding-right: 2rem!important;
    padding-left: 2rem!important;
}

</style>
<body style="overflow-x: hidden !important;">
<div class="row">
	<div class="col-sm-12">
	
		<center> <h1 style="margin: 3rem" >Find New People</h1> </center>
		<div class="row">
			<div class="col-sm-4">
				
			</div>
			<div class="col-sm-4 text-center">
			    <form class="navbar-form" method="" action="">
						<div class="form-group">
							<input class="form-control" type="text" name="search_user" placeholder="Search People" />
						</div>
						<button class="btn btn-info" type="submit" name="search_user_btn">Search</button>	
					</form>
			</div>
			<div class="col-sm-4">
				
			</div>			
		</div><br><br>
		<?php search_user(); ?>
	</div>
</div>

</body>
<?php include ("includes/footer.php"); ?>
</html>