@extends('layouts.client')

@section('title')
	Voting Successful
@stop

@section('meta')
	<meta http-equiv="refresh" content="3; url=/login">
@stop

@section('content')
	<div id="wrap">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="ongoing text-center">
						<div class="body">
							<img src="assets/images/logo_bisu_small.png" alt="">
							<h1><strong>Voting Successful!</strong></h1>
							<p>Your vote has been successfully submitted. Thank you!</p>
						</div>

						<div class="footer">
							<p>Bohol Island State University</p>
							<p>Automated SSG Elections</p>
							<p>Copyright &copy; 2014</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop