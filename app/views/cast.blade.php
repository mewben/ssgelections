@extends('layouts.client')

@section('title')
	SSGElections &middot; Bohol Island State University
@stop

@section('content')
	<div class="container" data-ng-app="ssg" data-ng-controller="BallotCtrl">
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
			<p class="col-sm-4 text-right"><i class="fa fa-barcode fa-fw fa-1x"></i> Voter ID: {{ $session['voter_id'] }} <i class="fa fa-user fa-fw fa-1x"></i> {{ $session['lname'] }}, {{ $session['fname'] }}</p>
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
											<div><small>{{ $candidate['party']['code'] }}</small></div>
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
			</form>
		</div>

		<div id="ballotConfirm">
			<div class="heading text-center">
				<img src="assets/images/logo_bisu_small.png" alt="BISU" width="50px">
				<h3>SSG Election</h3>
				<p><strong>Bohol Island State University</strong></p>
				<small>SY: {{ $session['semester']['sy'] }}-{{ $session['semester']['sy'] + 1 }} | Semester: {{ $session['semester']['sem'] }}</small>
			</div>
			<table class="confirm">
				<tr data-ng-repeat="position in data">
					<td valign="top"><strong>@{{position.name}}</strong></td>
					<td>
						<div data-ng-repeat="option in position.options" data-ng-if="option.active">
							@{{option.name}}
						</div>
					</td>
				</tr>
			</table>
			<button type="button" class="btn btn-lg btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Change</button>
		    <button type="button" data-ng-click="confirm()" class="btn btn-lg btn-primary"><i class="fa fa-fw fa-check"></i> Confirm &amp; Log out</button>
		</div>
	</div> <!-- end main -->

	<?php echo HTML::script('assets/js/jquery-2.0.3.min.js') ?>
	<?php echo HTML::script('assets/js/angular-1.2.12/angular.js') ?>
	<?php echo HTML::script('assets/less/bootstrap-3.1.0/js/modal.js') ?>

	<script>
		window.data = <?php echo json_encode($options) ?>;

		angular.module('ssg', [])
			.config([
				'$httpProvider',
				function($httpProvider) {
					$httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
				}
			])
			.controller('BallotCtrl', [
				'$scope',
				'$http',
				'$window',
				function ($scope, $http, $window) {
					$scope.data = window.data;
					$scope.item = [];

					$scope.submit = function() {
						$scope.item = [];
						$('#ballot').find('button.active').each(function(index, elem) {
							$scope.item.push($(elem).data('cid'));
						});
						angular.forEach($scope.data, function (value, key) {
							angular.forEach(value.options, function (v2, k2) {
								v2.active = undefined;
								if ($scope.item.indexOf(v2.id) != '-1')
									v2.active = true;
							});
						});
						$('#ballotConfirm').modal();
					};

					$scope.confirm = function() {
						$http.post('/cast', $scope.item)
							.success(function(result) {
								$window.location.href = '/success';
							})
							.error(function(err) {
								alert(err.error.message);
							});
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
@stop
