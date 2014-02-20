<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<title>ISS &middot; Bohol Island State University</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php echo HTML::style('assets/css/print.min.css') ?>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div id="logo">
						<img src="/assets/images/logo_bisu_small.png" alt="">
					</div>
					<address>
						Republic of the Philippines<br>
						<strong>Bohol Island State University</strong><br>
						{{ $session['campus']['name'] }} <br>
						{{ $session['campus']['address']}}
					</address>
					@section('title')
					@show
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					@yield('content')
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-right">
					@section('footer')
					@show
				</div>
			</div>
		</div>
	</body>
</html>