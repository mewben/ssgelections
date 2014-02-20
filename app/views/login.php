<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SSGElections &middot; Bohol Island State University</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php echo HTML::style('assets/css/font-awesome.css') ?>
		<?php echo HTML::style('assets/css/client.css') ?>
		<!--[if lt IE 9]>
		    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>

		<div class="container">
			<div class="login-form col-md-4 col-md-offset-4">
				<?php echo Form::open(['route' => 'sessions.store', 'method' => 'post', 'role' => 'form', 'class' => 'login form-horizontal']); ?>

					<div class="row form-group">
						<div class="col-md-6">
							<h1><strong>Login</strong></h1>
						</div>
						<div class="col-md-6">
							<img class="pull-right" src="assets/images/logo_bisu_small.png" alt="BISU" width="75px">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group input-group-lg">
							<span class="input-group-addon">
								<i class="fa fa-user fa-fw fa-1x"></i>
							</span>
							<input type="text" name="id" id="id" class="form-control" placeholder="Voter ID" required>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group input-group-lg">
							<span class="input-group-addon">
								<i class="fa fa-eye-slash fa-fw fa-1x"></i>
							</span>
							<input type="password" name="passcode" id="passcode" class="form-control" placeholder="Passcode" required>
						</div>
					</div>
					<?php if(Session::has('error')): ?>
						<div class="form-group"><i class="basic attention circle icon"></i>	<?php echo Session::get('error') ?></div>
					<?php endif; ?>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-sign-in fa-fw fa-1x"></i> Login</button>
					</div>

				<?php echo Form::close(); ?>
				<br>
				<br>
				<div class="text-center footer">
					<p>Bohol Island State University</p>
					<p>Automated SSG Election</p>
					<p>Copyright &copy; 2014</p>
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