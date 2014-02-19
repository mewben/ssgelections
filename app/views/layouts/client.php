<!DOCTYPE html>
<?php print_r($positions) ?>
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
	<body>
		<!-- Navbar -->
		<div class="navbar navbar-inverse navbar-static-top" role="navigation">
			<div class="container">
				<div class="navheader">
					<p class="logo"><i class="fa fa-archive fa-2x"></i> SSG Elections</p>
				</div>	
				<ul class="nav navbar-nav navbar-right">
					<!-- <li>
						<a href="#">
							<i class="fa fa-bookmark fa-fw fa-1x"></i> Main Campus| SY: No-Year Sem: 0
						</a>
					</li> -->
					<li>
						<a href="#">
							<i class="fa fa-barcode fa-fw fa-1x"></i> Voter ID: <?php echo $session['id'] ?>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-user fa-fw fa-1x"></i> Voter Name: <?php echo $session['lname'] . ', ' . $session['fname'] . ' ' . $session['mname'] ?>
						</a>
					</li>
				</ul>
			</div>
		</div> <!-- end navbar -->

		<!-- Main -->
		<div class="main container">
			<p>
			<?php 
				foreach ($positions as $k => $v) {
					if ($v['name'] == 'President') {
						foreach ($v['candidate'] as $kk => $vv) {
							echo '<li>' . $vv['name'] . '</li>';
						}
					}
				}
			?>	
			</p>
		</div> <!-- end main -->

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