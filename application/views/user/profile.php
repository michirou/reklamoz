<a href="<?= base_url(); ?>posts/dashboard" class="pull-right">Home</a>
<a href="<?= base_url(); ?>users/settings" class="pull-right">Settings</a>

<div>
	Username: <?php echo $user["username"] ;?><br/>
	

	<p>POSTS:</p>

	<?php foreach($posts as $post){
		?>
		<div><?=$post["content"]?></div>
		<p><?=$post["timestamp"]?></p><br/>
	<?php }
		?>
</div>