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
			<div id="menu">
				<div class="menu-open text-center">
					<ul class="nav">
						<li><a href="/admin" target="_self" class="logo"><i class="fa fa-archive fa-3x"></i> <h4>SSG Elections</h4></a></li>
					</ul>
					<ul class="nav side">
						<li><a href="#"><i class="fa fa-sitemap fa-2x"></i> <div>Candidates</div></a></li>
						<li><a href="#"><i class="fa fa-users fa-2x"></i> <div>Voters</div></a></li>
						<li class="active"><a href="#"><i class="fa fa-briefcase fa-2x"></i> <div>Manage</div></a></li>
						<li><a href="#"><i class="fa fa-bar-chart-o fa-2x"></i> <div>Results</div></a></li>
						<li><a href="#"><i class="fa fa-cog fa-2x"></i> <div>Settings</div></a></li>
					</ul>
				</div>
			</div> <!-- /#menu -->
			<div id="main">
				<!-- Navbar -->
				<div class="navbar navbar-inverse navbar-static-top" role="navigation">
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
				</div> <!-- /.navbar -->
				<div class="navbar navbar-default text-center navbar-static-top" role="navigation">
					<ul class="nav navbar-nav">
						<li class="active">
							<a href="#">
								<i class="fa fa-fw fa-2x fa-building-o"></i><div>Campuses</div>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-fw fa-2x fa-wrench"></i><div>Semesters</div>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-fw fa-2x fa-wheelchair"></i><div>Positions</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="content">
					<div class="page-header">
						<div class="row">
							<div class="col-md-4">
									<h2><i class="fa fa-fw fa-building-o"></i> Campuses <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</button></h2>
							</div>
							<div class="col-md-8 text-right">
								<div>
									<form class="form-inline" role="form">
										<div class="form-group">
											<i class="fa fa-fw fa-search"></i>
											<input type="text" class="form-control no-style" placeholder="Search List ...">
										</div>
										<div class="form-group">
											<div class="btn-group">
												<button type="button" class="btn btn-link active">ACTIVE</button>
												<button type="button" class="btn btn-link">BLOCKED</button>
												<button type="button" class="btn btn-link">TRASHED</button>
											</div>
										</div>
										<div class="form-group">
											<div class="btn-group">
												<button type="button" class="btn btn-info"><i class="fa fa-chevron-left"></i></button>
												<button type="button" class="btn btn-info">0/0</button>
												<button type="button" class="btn btn-info"><i class="fa fa-chevron-right"></i></button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					
					<div class="tab-content">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Address</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1.</td>
									<td>Main Campus</td>
									<td>CPG. Ave. Tagbilaran City, Bohol</td>
									<td>
										<button type="button" class="btn btn-info btn-sm">Edit</button>
										<button type="button" class="btn btn-danger btn-sm">Delete</button>
									</td>
								</tr>
							</tbody>
						</table>

					</div>
				</div>

			</div> <!-- /#main -->
		</div>

		<?php if (App::environment('production')) : ?>

		<?php else: ?>
			<?php echo HTML::script('assets/js/jquery-2.0.3.min.js') ?>

			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/transition.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/dropdown.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/collapse.js') ?>
		<?php endif; ?>
	</body>
</html>