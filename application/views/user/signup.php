<div class="row">
	<div class="col-md-6">
		<form id="signup-form">
			<input type="text" name="username" placeholder="username">
			<br>
			<input type="password" name="password" placeholder="password">
			<br>
			<input type="password" name="confirm_password" placeholder="confirm password">
			<br>
			<button class="btn btn-primary" type="submit">Submit</button>
			<span id="error-message"></span>
		</form>
	</div>
</div>

<script type="text/javascript">
	$("#signup-form").submit(function(e){
		e.preventDefault()
		var password = $("input[name=password]").val();
		var confirm_password = $("input[name=confirm_password]").val();
		if(password == confirm_password && password.length>=8){
			//user is human
				$.ajax({
					method:"POST",
					url:webroot+"users/signup",
					data:$(this).serialize(),
					success:function(result){
						console.info(result);
						if(result == "user_saved"){
							alert("User saved!");
						} else if(result == "user_exists"){
							alert("Username exists already!");
						} else {
							alert("User not saved! :(");
						}
					}
				});	
		}else{
			//what if password are not the same
			//what if username is already taken -- ajax
			$("#error-message").html("Something is wrong please try again");
		}
	});
</script>