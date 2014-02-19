<!DOCTYPE html>
<html ng-app>
	<head>
		<title>Close Voting</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php echo HTML::style('assets/css/client.min.css') ?>
		<?php echo HTML::style('assets/css/font-awesome.css') ?>

	</head>
	<body data-ng-controller="DefaultCtrl">
		<div id="wrap">
			<div class="login-form">
				<form name="closevoting" class="form-horizontal" method="post" data-ng-submit="submit()" ng-init="item.cid=<?php echo $campus_id ?>;item.sid=<?php echo $sem_id ?>">
					<div class="form-group">
						<img src="assets/images/logo_bisu_small.png" alt="">
						<h1>Close Voting!</h1>
						<p>Enter 2 passcodes to close voting process and view the results.</p>
					</div>
					<div class="form-group">
						<div class="input-group input-group-lg">
							<span class="input-group-addon"><i class="fa fa-unlock"></i></span>
							<input type="password" class="form-control" data-ng-model="item.passcode1" placeholder="Pass Code 1" required>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group input-group-lg">
							<span class="input-group-addon"><i class="fa fa-unlock"></i></span>
							<input type="password" class="form-control" data-ng-model="item.passcode2" placeholder="Pass Code 2" required>
						</div>
					</div>
					<div class="form-group text-right">
						<button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-fw fa-check"></i> Close Voting &amp; View Results</button>
					</div>
				</form>
			</div>
		</div>

		<?php echo HTML::script('assets/js/jquery-2.0.3.min.js') ?>
		<?php echo HTML::script('assets/js/angular-1.2.12/angular.js') ?>
		<?php echo HTML::script('ang/closevoting.js') ?>
	</body>
</html>
