$(document).ready(function(){
			alert("l_name");
	
		});

	

	function updateProfile(){
		alert("l_name");
		// var user = <?php echo $user; ?>;
		var f_name = $("f_name").val();
		var l_name = $("l_name").val();

		var country = $("u_country").val();
		var gender = $("u_gender").val();
		var birthday = $("birthday").val();
		var u_name = $("u_name").val();
		var describe_user = $("describe_user").val();
		var collection_name = $("collection_name").val();

		$.ajax({

		})

	} 