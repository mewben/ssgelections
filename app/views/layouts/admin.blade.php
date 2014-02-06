<!DOCTYPE html>
<html lang="en" data-ng-app="iss" data-ng-controller="AdminCtrl">
	<head>
		<meta charset="utf-8">
		<title>SSGElections &middot; Bohol Island State University</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php echo HTML::style('assets/css/admin.min.css') ?>
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
				<a href="/admin" target="_self" class="navbar-brand">SSG Elections</a>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><p class="navbar-text">Overview</p></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Link</a></li>
						<li class="dropdown">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another Action</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated Link</a></li>
						</li>
					</ul>
				</div>
			</div> <!-- /.navbar -->
			<button class="btn btn-primary">Add New <kbd>a</kbd></button>
		</div>
	</body>
</html>