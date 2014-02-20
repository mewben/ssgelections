<!DOCTYPE html>
<html lang="en" data-ng-app="ssg" data-ng-controller="BallotCtrl">
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
		<!-- Main -->
		<div class="container">
			<div class="row ballot-header">
				<br>
				<br>
				<div class="col-sm-8 logo">
					<div class="col-sm-2">
						<img class="pull-left" width="75px" src="assets/images/logo_bisu_small.png" alt="Bohol Island State University">
					</div>
					<div class="col-sm-10">
						<h1>SSG Elections <small>{{ $session['semester']['sy'] }}-{{ $session['semester']['sy'] + 1 }} | {{ $session['semester']['sem'] }}</small></h1>
					</div>
				</div>
				<p class="col-sm-4 text-right"><i class="fa fa-barcode fa-fw fa-1x"></i> Voter ID: {{ $session['id'] }} <i class="fa fa-user fa-fw fa-1x"></i> {{ $session['lname'] }}, {{ $session['fname'] }}</p>
				<br>
				<br>
			</div>

			<div class="row ballot-body">
				<form id="ballot" data-ng-submit="submit()">
					@foreach($options as $positions)
						<div class="postOptions col-sm-12" <?php echo $positions['num_winner'] == 1 ? 'radio' : 'check="'. $positions['num_winner'] . '"' ?>>
							<h3><i class="fa fa-sitemap fa-fw"></i> {{ $positions['name'] }}</h3>
							<div class="postOption">
								@foreach($positions['options'] as $k => $candidate)
									<div class="col-lg-4">
										<button type="button" data-cid="<?php echo $candidate['id'] ?>" class="btn btn-lg btn-block btn-primary">
											<span>{{ $k + 1 }}</span>
											<p>
												<strong>{{ $candidate['name'] }}</strong>
												<div><small>{{ $candidate['party']['name'] }}</small></div>
											</p>
											<i class="fa fa-check fa-2x checkmark"></i>
										</button>
									</div>
								@endforeach
							</div>
						</div>
					@endforeach


					<div class="col-lg-4 col-lg-offset-4 col-sm-12">
						<div class="controls text-center">
							<button type="submit" class="btn btn-warning btn-lg btn-block">
								<i class="fa fa-arrow-down fa-3x"></i>
								<div>Cast Ballot</div>
							</button>
						</div>
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
				        		<table class='table table-striped'>
				        			<tr>
				        				<td>President:</td>
				        				<td>Melvin Soldia</td>				        				
				        			</tr>
				        			<tr>
				        				<td>Vice-President:</td>
				        				<td>Phillip Glenn Libay</td>				        				
				        			</tr>
				        			<tr>
				        				<td>Senators:</td>
				        				<td>
				        					<ol>
				        						<li>Melvin Soldia</li>
				        						<li>Phillip Glenn Libay</li>
				        						<li>Christian Dave Bunales</li>
				        						<li>John Fernie Boron</li>
				        					</ol>
				        				</td>
				        			</tr>
				        			<tr>
				        				<td>Governor:</td>
				        				<td>John Fernie Boron</td>
				        			</tr>
				        			<tr>
				        				<td>Representative:</td>
				        				<td>Christian Dave Bunales</td>
				        			</tr>
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

		<script>
angular.module('ssg', [])
	.controller('BallotCtrl', [
		'$scope',
		function ($scope) {
			$scope.item = [];

			$scope.submit = function() {
				$scope.item = [];
				$('#ballot').find('button.active').each(function(index, elem) {
					$scope.item.push($(elem).data('cid'));
				});
				$('#ballotConfirm').modal();
			};
		}
	])

	.directive('radio', [
		function() {
			return {
				restrict: 'A',
				link: function (scope, elem, attrs) {
					elem.find('button').bind('click', function() {
						var on = $(this).hasClass('active');

						elem.find('button').removeClass('active');

						if (!on) { // select
							$(this).addClass('active');
						}

					});
				}
			};
		}
	])

	.directive('check', [
		function() {
			return {
				restrict: 'A',
				link: function (scope, elem, attrs) {
					elem.find('button').bind('click', function() {
						var on = $(this).hasClass('active');

						if (!on) // select
							$(this).addClass('active');
						else
							$(this).removeClass('active');

						// check if maximum is reached
						if (elem.find('button.active').length == attrs.check) // disable the rest buttons
							elem.find('button').not('.active').attr('disabled', 'disabled');
						else
							elem.find('button').not('.active').removeAttr('disabled');


					});
				}
			};
		}
	]);
		</script>
	</body>
</html>