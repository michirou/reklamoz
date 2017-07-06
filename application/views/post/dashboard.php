<div class="col-md-12">
		<a href="<?= base_url();?>users/log_out" class="pull-right">Log out</a><br/>
		<a href="<?= base_url(); ?>users/profile/<?= $_SESSION['logged_in']["id"]?>">Profile</a>
</div>
<div>
	<div class="col-md-6">
		<div class="content-form">
			<input type="hidden" name="user_id" value="<?= $_SESSION['logged_in']["id"] ?>"/>
			<div>
				<form id="post-form">
					<textarea id="post-content" style="height:130px"></textarea><br>
					<button class="btn btn-primary" id="submit-post-button">iReklamo!</button>
				</form>
			</div>
		</div>
		<div id="content-feed">
			//show the rants

		</div>
	</div>
</div>

<script type="text/javascript">
	$("#submit-post-button").click(function(e){
		e.preventDefault();
		var content = $("#post-content").val();
		$.ajax({
			method:"POST",
			url:webroot+"posts/submit_content",
			data:{
				content:content,
			},
			success:function(result){
				console.info(result);
			}
		});
	});


	// $("#log_out").click


	$(document).on("click", "#like", function(e){
		e.preventDefault();
		var id = $(this).attr("data-pg");
		$.ajax({
			method:"POST",
			url:webroot+"posts/like",
			data:{
				id:id,
			},
			success:function(result){
				console.info(result);
				$("#like_count_"+id).html(result.length);
			}
		});
	});

	var get_posts = function(parameters){
		var id = $("input[name=user_id]").val();
		$.ajax({
			method:"POST",
			url:webroot+"posts/get_posts",
			success:function(result){
				var data = JSON.parse(result);
				var content = "";
				$.each(data,function(key,value){
					console.info(value);

					content += "<div class='post-content'><span>"+value.content+" by <a href='<?= base_url(); ?>users/profile/"+value.user_id+"'>"+value.user.username+"</a></span></div><div class='post-timestamp'><span>"+value.timestamp+"</span></div>";

					if(value.user_id != id){
						content += "<button id='like' data-pg='"+value.id+"'>Like</button> <a href='#'><span id='like_count_'"+value.id+">"+value.likes.length+"</span> Like/s</a><br/>";
					}

					content+= "<br/>";

				})
				setTimeout(function(){
					$("#content-feed").html(content);
				},500);
			}
		});
	}

	$(document).ready(function(){

		get_posts();
		setInterval(function(){
			get_posts();
		},10000);
	});
</script>