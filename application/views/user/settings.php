<a href="<?= base_url(); ?>users/profile/<?= $_SESSION['logged_in']["id"]?>" class="btn btn-warning pull-right">Profile</a>
<div>
	Username: <?= $user["username"]?>
	<form id="settings-form">
		<input type="password" name="old_password" placeholder="Enter old password"/>
		<input type="password" name="new_password" placeholder="Enter new password" />
		<input type="hidden" name="password" value="<?= $user["password"]?>">
		<input type="hidden" name="user_id" value="<?= $user["id"]?>">
		<input type="submit" name="change_password" value="Save Changes" class="btn btn-success" />
	</form>
</div>


<script type="text/javascript">
	
	$("#settings-form").submit(function(e){
		e.preventDefault()
		var id = $("input[name=user_id]").val();
		var old_password = $("input[name=old_password]").val();
		var new_password = $("input[name=new_password]").val();
		if(new_password.length>=8){
			//user is human
				$.ajax({
					method:"POST",
					url:webroot+"users/change_password",
					data:$(this).serialize(),
					success:function(result){
						console.info(result);
						if(result == "success"){
							alert("Password successfully changed!");
							window.location.href = 'profile/'+id;
						} else {
							alert("Password not changed!.");
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