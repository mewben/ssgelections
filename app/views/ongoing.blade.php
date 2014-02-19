<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SSGElections &middot; Bohol Island State University</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php if (App::environment('production')): ?>
			<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<?php else: ?>
			<?php echo HTML::style('assets/css/font-awesome.css') ?>
		<?php endif; ?>

		<?php echo HTML::style('assets/css/admin.css') ?>
		<?php echo HTML::style('assets/css/client.css') ?>
		<!--[if lt IE 9]>
		    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body style="background-color: #45c8dc;">
		<div class="container">
			<div class="ongoing col-md-6 col-md-offset-3">
				<div class="row">
					<div class="ongoing-header col-md-12">
						<h1>Election is ongoing!</h1>
						<p>Access to administrator's panel is not allowed. Election will be over in:</p>
					</div>
					<ul class="ongoing-body">
						<li class="col-md-3">
							<p class="timer-data">02</p>
							<p class="timer-label">HOURS</p>
						</li>
						<li class="col-md-3 col-md-offset-1">
							<p class="timer-data">37</p>
							<p class="timer-label">MINUTES</p>
						</li>
						<li class="col-md-3 col-md-offset-1">
							<p class="timer-data">13</p>
							<p class="timer-label">SECONDS</p>
						</li>
					</ul>
				</div>
				<div class="ongoing-footer">
					<p><strong>Bohol Island State University</strong></p>
					<p>Automated SSG Elections</p>
					<p>Copyright 2014 &copy; All Rights Reserved</p>
				</div>
			</div>
		</div>

		<?php if (App::environment('production')) : ?>
			<?php echo HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js') ?>

		<?php else: ?>
			<?php echo HTML::script('assets/js/jquery-2.0.3.min.js') ?>
			<?php echo HTML::script('assets/js/angular-1.2.12/angular.js') ?>
			<?php echo HTML::script('assets/js/angular-1.2.12/angular-route.js') ?>
			<?php echo HTML::script('assets/js/angular-1.2.12/angular-resource.js') ?>

			<?php echo HTML::script('assets/js/toastr.min.js') ?>

			<?php echo HTML::script('ang/init.js') ?>
			<?php echo HTML::script('ang/app.js') ?>
			<?php echo HTML::script('ang/services/api.js') ?>
			<?php echo HTML::script('ang/services/notify.js') ?>
			<?php echo HTML::script('ang/controllers.js') ?>
			<?php echo HTML::script('ang/directives.js') ?>


			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/transition.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/dropdown.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/collapse.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/modal.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/tooltip.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/tab.js') ?>
		<?php endif; ?>
	</body>
</html>