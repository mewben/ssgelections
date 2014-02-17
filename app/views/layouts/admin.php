<!DOCTYPE html>
<html lang="en" data-ng-app="ssg" data-ng-controller="AdminCtrl">
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
						<?php foreach($session['menu'] as $key => $menu): ?>
							<li data-ng-class="{active: isActive('<?php echo $menu['baseurl'] ?>')}">
								<a href="<?php echo $menu['url'] ?>">
									<i class="fa fa-2x <?php echo $menu['icon'] ?>"></i>
									<div><?php echo $key ?></div>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div> <!-- /#menu -->
			<div id="main">
				<!-- Navbar -->
				<div class="navbar navbar-inverse navbar-static-top" role="navigation">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bookmark fa-fw fa-2x"></i> <?php echo $session['campus']['name'] ?>| SY: <?php echo isset($session['sem']['sy']) ? $session['sem']['sy'] . "-" . (($session['sem']['sy'] - 0) + 1) : "No semester" ?> Sem: <?php echo isset($session['sem']['sem']) ? $session['sem']['sem'] : "0" ?>
								<span class="caret"></span>
							</a>
							<?php echo Form::open(['url' => '/api/v1/sessions', 'method' => 'post', 'role' => 'form', 'class' => 'dropdown-menu form']) ?>
								<?php if(isset($session['campuses'])) : ?>
								<div class="form-group">
									<?php echo Form::select('campus_id_g', $session['campuses'], $session['campus']['id'], array('class'=>'form-control', 'autocomplete'=>'off')) ?>
								</div>
								<?php endif ?>
								<div class="form-group">
									<div class="row">
										<div class="col-xs-8">
											<div class="input-group">
												<input type="text" id="sy_g" name="sy_g" data-ng-model="sy_g" class="form-control" maxlength="4" placeholder="SY" required>
												<span class="input-group-addon">{{ (sy_g - 0) + 1 }}</span>
											</div>
										</div>
										<div class="col-xs-4">
											<input type="text" class="form-control" name="sem_g" data-ng-model="sem_g" placeholder="Sem" maxlength="1" required>
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-fw fa-check"></i> Change</button>
							<?php echo Form::close() ?>
						</li>
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
				<div data-ng-view></div>
			</div> <!-- /#main -->
		</div>

		<?php if (App::environment('production')) : ?>
			<?php echo HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js') ?>

		<?php else: ?>
			<?php echo HTML::script('assets/js/jquery-2.0.3.min.js') ?>
			<?php echo HTML::script('assets/js/angular-1.2.12/angular.js') ?>
			<?php echo HTML::script('assets/js/angular-1.2.12/angular-route.js') ?>
			<?php echo HTML::script('assets/js/angular-1.2.12/angular-resource.js') ?>

			<?php echo HTML::script('assets/js/angular-select2.js') ?>
			<?php echo HTML::script('assets/js/select2.min.js') ?>

			<?php echo HTML::script('assets/js/toastr.min.js') ?>

			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/transition.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/dropdown.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/collapse.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/modal.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/tooltip.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/tab.js') ?>
			<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/button.js') ?>

			<?php echo HTML::script('ang/init.js') ?>
			<?php echo HTML::script('ang/app.js') ?>
			<?php echo HTML::script('ang/services/api.js') ?>
			<?php echo HTML::script('ang/services/notify.js') ?>
			<?php echo HTML::script('ang/controllers.js') ?>
			<?php echo HTML::script('ang/directives.js') ?>


		<?php endif; ?>

		<?php if(Session::has('errors')) : ?>
			<script>
				toastr.error('<ul>' + "<?php echo Session::get('errors') ?>" + '</ul>', 'Something went wrong!');
			</script>
		<?php endif ?>

		<?php if(Session::has('info')) : ?>
			<script>
				toastr.success('<ul>' + "<?php echo Session::get('info') ?>" + '</ul>', 'Success!');
			</script>
		<?php endif ?>

		<script>
			window.menu = <?php echo json_encode($session['menu']) ?>;
			window.sy_g = <?php echo isset($session['sem']['sy']) ? $session['sem']['sy'] : '""' ?>;
			window.sem_g = <?php echo isset($session['sem']['sem']) ? $session['sem']['sem'] : '""' ?>;
			angular.module('ssg').constant('CSRF_TOKEN', '<?php echo csrf_token() ?>');
		</script>
	</body>
</html>