@extends('layouts.client')

@section('title')
	SSG Elections Results
@stop

@section('content')
	<div id="wrap">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="text-center">
						<img src="assets/images/logo_bisu_small.png" alt="">
						<h1>SSG Elections Results</h1>
						<p>SY: {{$session['sem']['sy']}} - {{$session['sem']['sy'] + 1}} SEM: {{$session['sem']['sem']}}</p>
						<h3>{{$session['campus']['name']}}</h3>

						<div style="margin-top: 100px">
							<a href="/results?w=print" target="_blank" class="btn btn-primary btn-lg">
								<i class="fa fa-print fa-2x"></i>
								<div>Print Election Returns</div>
							</a>
							<br><br><br>
							<a href="/admin/logout" class="btn btn-lg btn-default">
								<i class="fa fa-sign-out"></i>
								<div>Log Out</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop