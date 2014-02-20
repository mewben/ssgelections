<!DOCTYPE html>
<html lang="en" data-ng-app="ssg" data-ng-controller="ballotCtrl">
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
		<?php $candidates = [
				[
					'id' => '1',
					'post' => 'President',
					'name' => 'Soldia, Melvin',
					'part' => 'Una'
				],
				[
					'id' => '2',
					'post' => 'Vice-President',
					'name' => 'Libay, Phillip Glenn',
					'part' => 'Segundo'
				],
				[
					'id' => '3',
					'post' => "Senator",
					'name' => 'Bunales, Christian Dave',
					'part' => 'Tulo'
				],
				[
					'id' => '4',
					'post' => 'Governor',
					'name' => 'Paas, Hermes',
					'part' => 'Upat'
				],
				[
					'id' => '5',
					'post' => 'Representative',
					'name' => 'Boron, John Fernie',
					'part' => 'Five'
				]
			]; ?>

		<!-- Main -->
		<div class="container">
			<div class="row ballot-header">
				<br>
				<br>
				<div class="col-sm-8 logo">
					<div class="col-md-2">
						<img class="pull-left" width="75px" src="assets/images/logo_bisu_small.png" alt="Bohol Island State University">
					</div>
					<div class="col-md-10">
						<h1>SSG Elections <small>{{ $session['semester']['sy'] }}-{{ $session['semester']['sy'] + 1 }} | {{ $session['semester']['sem'] }}</small></h1>
					</div>
				</div>
				<p class="col-sm-4 text-right"><i class="fa fa-barcode fa-fw fa-1x"></i> Voter ID: {{ $session['id'] }} <i class="fa fa-user fa-fw fa-1x"></i> {{ $session['lname'] }}, {{ $session['fname'] }}</p>
				<br>
				<br>
			</div>

			<div class="row ballot-body">
				<form id="ballot" data-ng-submit="submit()">
					@foreach($options as $key => $option)
						<div class="postOptions col-md-12">
							<h3><i class="fa fa-sitemap fa-fw"></i> {{ $option['name'] }}</h3>
							<div class="postOption">
								@foreach($option['options'] as $k => $candidate)
									<div class="col-md-3">
										<button type="button" class="btn btn-block btn-primary">
											<span>{{ $k + 1 }}</span>
											<p>{{ $candidate['name'] }}</p>
											<small>{{ $candidate['party']['name'] }}</small>
										</button>
									</div>
								@endforeach
							</div>
						</div>
					@endforeach


					<div class="controls pull-right">
						<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-times"></i> Clear</button>
						<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ballotConfirm"><i class="fa fa-fw fa-check"></i> Cast</button>
					</div>
				</div>

				<div class="modal fade" id="ballotConfirm" tabindex="-1" role="dialog" aria-labelledby="ballotConfirmLabel" aria-hidden="true">
					<div class="modal-dialog">
				    	<div class="modal-content">
				    		<div class="modal-header">
				    			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				    			<h4 class="modal-title"><strong>Ballot Confirmation</strong></h4>
				    		</div>
				    		<div class="modal-body">
				    			<div class="heading text-center">
				    				<img src="assets/images/logo_bisu_small.png" alt="BISU" width=50px>
				    				<h3>SSG Election</h3>
				    				<p><strong>Bohol Island State University</strong></p>
				    				<small>SY: {{ $session['semester']['sy'] }}-{{ $session['semester']['sy'] + 1 }} | Semester: {{ $session['semester']['sem'] }}</small>
				    			</div>
				        		<table class="confirm">
				        			@foreach($candidates as $k => $v)
				        			<tr>
				        				<td><strong>{{$v['post']}}</strong>:</td>
				        				<td>{{$v['name']}}</td>
				        			</tr>
				        			@endforeach
				        		</table>
				      		</div>
				      		<div class="modal-footer">
				        		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Change</button>
				        		<button type="button" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Confirm</button>
				      		</div>
				    	</div><!-- /.modal-content -->
				  	</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
			</form>
		</div> <!-- end main -->

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