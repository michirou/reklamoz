<html>
	<head>
		Header
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script type="text/javascript">
			var webroot = "<?php echo base_url(); ?>";
		</script>
	</head>

	<body>
		<div class="container">
			<?php $this->load->view($view) ?>
		</div>
	</body>
	
	<footer>
		Footer
	</footer>
</html>