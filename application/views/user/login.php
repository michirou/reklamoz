<div class="row">
	<div class="col-md-6">
		<?php if(isset($error)): ?>
			<span><?php echo $error; ?></span>
		<?php endif; ?>
		<form class="" method="POST" action="<?php echo base_url(); ?>users/login">
			<input type="text" placeholder="Username" name="username">
			<br>
			<input type="password" placeholder="Password" name="password">
			<br>
			<button type="submit" class="btn btn-primary">Login</button>
		</form>
	</div>
</div>