<!DOCTYPE html>
<html lang="en" ng-app="app" data-ng-controller="BallotCtrl">
	<head>
		<meta charset="utf-8">
		<title>SSGElections &middot; Bohol Island State University</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php echo HTML::style('assets/css/font-awesome.css') ?>
		<?php echo HTML::style('assets/css/client.min.css') ?>
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
					'name' => 'Soldia, Melvin',
					'party' => 'LP'
				],
				[
					'id' => '2',
					'name' => 'Libay, Phillip Glenn',
					'party' => 'UNA'
				],
				[
					'id' => '3',
					'name' => 'Libay, Phillip Glenn',
					'party' => 'UNA'
				],
				[
					'id' => '4',
					'name' => 'Libay, Phillip Glenn',
					'party' => 'UNA'
				],
				[
					'id' => '5',
					'name' => 'Libay, Phillip Glenn',
					'party' => 'UNA'
				]
			]; ?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<br>
					<h1>SSG Elections <small>2013-2014 | 2</small></h1>
					
					<br>
					<br>
					<form id="ballot" data-ng-submit="submit()">
						<div class="position" radio>
							<h1>President</h1>
							<div class="row">
								<?php foreach($candidates as $k => $v): ?>
									<div class="col-sm-4">
										<button type="button" data-cid="<?php echo $v['id'] ?>" class="btn btn-primary btn-lg btn-block">
											<?php echo $v['name'] ?>
										</button>
									</div>
								<?php endforeach ?>
							</div>
						</div>

						<div class="position" check="3">
							<h1>Senator</h1>
							<div class="row">
								<?php foreach($candidates as $k => $v): ?>
									<div class="col-sm-4">
										<button type="button" data-cid="<?php echo $v['id'] ?>" class="btn btn-primary btn-lg btn-block">
											<?php echo $v['name'] ?>
										</button>
									</div>
								<?php endforeach ?>
							</div>
						</div>
						<button type="submit" class="btn btn-large btn-primary">Cast Ballot</button>
					</form>
				</div>
			</div>
		</div>
		<!-- Navbar -->
		<!-- <div class="navbar navbar-inverse navbar-static-top" role="navigation">
		 	<div class="container">
		 		<div class="navheader">
		 			<p class="logo"><i class="fa fa-archive fa-2x"></i> SSG Elections</p>
		 		</div>	
		 		<ul class="nav navbar-nav navbar-right">
		 			<li>
		 				<a href="#">
		 					<i class="fa fa-bookmark fa-fw fa-1x"></i> Main Campus| SY: No-Year Sem: 0
		 				</a>
		 			</li>
		 			<li>
		 				<a href="#">
		 					<i class="fa fa-barcode fa-fw fa-1x"></i> ID: 012345
		 				</a>
		 			</li>
		 			<li>
		 				<a href="#">
		 					<i class="fa fa-user fa-fw fa-1x"></i> Libay, Phillip Glenn Libay
		 				</a>
		 			</li>
		 		</ul>
		 	</div>
		 </div> --> <!-- end navbar -->

		<!-- Main -->
		<div class="main container">
			

			

			
			<?php echo Form::open(['url' => '', 'method' => 'post', 'role' => 'form', 'class' => '']) ?>


				<div class="position col-md-12">
					<h3><i class="fa fa-user fa-fw"></i> President</h3>
					<div class="option">
						<ul>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">1</span>
									<p class="candidate-name"><strong>Melvin Soldia</strong></p>
									<small class="candidate-party">Party-People</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">2</span>
									<p class="candidate-name"><strong>Phillip Glenn Libay</strong></p>
									<small class="candidate-party">Party-Pilipinas</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">3</span>
									<p class="candidate-name"><strong>Christian Dave Bunales</strong></p>
									<small class="candidate-party">Party-Club</small>
								</button>
							</li>
						</ul>
					</div>
				</div>
				<div class="position col-md-12">
					<h3><i class="fa fa-user fa-fw"></i> Vice-President</h3>
					<div class="option">
						<ul>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">1</span>
									<p class="candidate-name"><strong>Melvin Soldia</strong></p>
									<small class="candidate-party">Party-People</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">2</span>
									<p class="candidate-name"><strong>Phillip Glenn Libay</strong></p>
									<small class="candidate-party">Party-Pilipinas</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">3</span>
									<p class="candidate-name"><strong>Christian Dave Bunales</strong></p>
									<small class="candidate-party">Party-Club</small>
								</button>
							</li>
						</ul>
					</div>
				</div>
				<div class="position col-md-12">
					<h3><i class="fa fa-users fa-fw"></i> Senators</h3>
					<div class="option">
						<ul>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">1</span>
									<p class="candidate-name"><strong>Melvin Soldia</strong></p>
									<small class="candidate-party">Party-People</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">2</span>
									<p class="candidate-name"><strong>Phillip Glenn Libay</strong></p>
									<small class="candidate-party">Party-Pilipinas</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">3</span>
									<p class="candidate-name"><strong>Christian Dave Bunales</strong></p>
									<small class="candidate-party">Party-Club</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">4</span>
									<p class="candidate-name"><strong>Melvin Soldia</strong></p>
									<small class="candidate-party">Party-People</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">5</span>
									<p class="candidate-name"><strong>Phillip Glenn Libay</strong></p>
									<small class="candidate-party">Party-Pilipinas</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">6</span>
									<p class="candidate-name"><strong>Christian Dave Bunales</strong></p>
									<small class="candidate-party">Party-Club</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">7</span>
									<p class="candidate-name"><strong>Melvin Soldia</strong></p>
									<small class="candidate-party">Party-People</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">8</span>
									<p class="candidate-name"><strong>Phillip Glenn Libay</strong></p>
									<small class="candidate-party">Party-Pilipinas</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">9</span>
									<p class="candidate-name"><strong>John Fernie Boron</strong></p>
									<small class="candidate-party">Party-Club</small>
								</button>
							</li>
						</ul>
					</div>
				</div>
				<div class="position col-md-12">
					<h3><i class="fa fa-user fa-fw"></i> Governor (College of Engineering)</h3>
					<div class="option">
						<ul>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">1</span>
									<p class="candidate-name"><strong>John Fernie Boron</strong></p>
									<small class="candidate-party">Party-People</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">2</span>
									<p class="candidate-name"><strong>Phillip Glenn Libay</strong></p>
									<small class="candidate-party">Party-Pilipinas</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">3</span>
									<p class="candidate-name"><strong>Christian Dave Bunales</strong></p>
									<small class="candidate-party">Party-Club</small>
								</button>
							</li>
						</ul>
					</div>
				</div>
				<div class="position col-md-12">
					<h3><i class="fa fa-user fa-fw"></i> Representative (College of Engineering - 5th Year)</h3>
					<div class="option">
						<ul>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">1</span>
									<p class="candidate-name"><strong>Melvin Soldia</strong></p>
									<small class="candidate-party">Party-People</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">2</span>
									<p class="candidate-name"><strong>Phillip Glenn Libay</strong></p>
									<small class="candidate-party">Party-Pilipinas</small>
								</button>
							</li>
							<li>
								<button type="button" class="btn btn-primary">
									<span class="candidate-num">3</span>
									<p class="candidate-name"><strong>Christian Dave Bunales</strong></p>
									<small class="candidate-party">Party-Club</small>
								</button>
							</li>
						</ul>
					</div>
				</div>


				<div class="controls pull-right">
					<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-times"></i> Clear</button>
					<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ballotConfirm"><i class="fa fa-fw fa-check"></i> Cast</button>
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
			<?php echo Form::close() ?>
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
			/*$(document).ready(function() {
				$('.radio button').on('click',function() {
					$(this).parents('.radio').find('button').removeClass('active');
					$(this).addClass('active');
					//$(this).parent().parentsiblings().attr('disabled');
				});
			});*/

angular.module('app', [])
	.controller('BallotCtrl', [
		'$scope',
		function ($scope) {
			$scope.item = [];

			$scope.submit = function() {
				$scope.item = [];
				$('#ballot').find('button.active').each(function(index, elem) {
					$scope.item.push($(elem).data('cid'));
				});
				console.log($scope.item);
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