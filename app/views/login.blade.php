@extends('layouts.client')

@section('title')
	SSGElections Login &middot; BISU
@stop

@section('content')
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

	<?php echo HTML::script('assets/js/jquery-2.0.3.min.js') ?>

	<script>
		<?php if(Session::has('error')): ?>
			alert('<?php echo Session::get("error") ?>');
		<?php endif ?>
		$('form').find(':input:enabled:visible:first').focus().select();
	</script>
@stop