<!DOCTYPE html>
<html lang="en" data-ng-app="iss" data-ng-controller="AdminCtrl">
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
		<!--[if lt IE 9]>
		    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body data-ng-cloak>
		<div id="wrap">
			<!-- Navbar -->
			<div class="navbar navbar-inverse navbar-static-top" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<i class="icon list"></i>
					</button>

				</div>
				<a href="/admin" target="_self" class="navbar-brand">SSG Elections <i class="fa fa-archive fa-lg"></i></a>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><i class="fa fa-bookmark fa-fw fa-2x"></i> Main Campus | SY: 2013-2014 Sem: 2</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw fa-2x"></i> username <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="dropdown-header">username</li>
								<li><a href="#"><i class="fa fa-lock fa-fw"></i> Change password</a></li>
								<li class="divider"></li>
								<li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Log out</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div> <!-- /.navbar -->
			<div id="menu">
				<div class="menu-open text-center">
					<ul class="nav">
						<li><a href="#"><i class="fa fa-sitemap fa-2x"></i> <div>Candidates</div></a></li>
						<li><a href="#"><i class="fa fa-users fa-2x"></i> <div>Voters</div></a></li>
						<li><a href="#"><i class="fa fa-briefcase fa-2x"></i> <div>Manage</div></a></li>
						<li><a href="#"><i class="fa fa-bar-chart-o fa-2x"></i> <div>Results</div></a></li>
						<li><a href="#"><i class="fa fa-cog fa-2x"></i> <div>Settings</div></a></li>
					</ul>
				</div>
			</div> <!-- /#menu -->
			<div id="main">
				<h1><i class="fa fa-briefcase"></i> Manage</h1>
			</div> <!-- /#main -->
		</div>

		<?php if (App::environment('production')) : ?>

		<?php else: ?>
			<?php echo HTML::script('assets/js/jquery-2.0.3.min.js') ?>

			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/transition.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/dropdown.js') ?>
		<?php endif; ?>
	</body>
</html>