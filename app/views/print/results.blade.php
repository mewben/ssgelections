@extends('layouts.print')

@section('title')
	<h2>Election Returns</h2>
	<h5>S.Y. {{ $session['sem']['sy'] }}-{{ $session['sem']['sy'] + 1 }} Sem: {{ $session['sem']['sem'] }}</h5>
@stop

@section('content')
	<div class="app" ng-app ng-controller="ResultCtrl">
		<div data-ng-repeat="positions in data">
			<h3>@{{positions.name}}</h3>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="5%">Rank</th>
						<th width="40%">Full Name</th>
						<th width="40%">Party</th>
						<th width="10%">No. of Votes</th>
						<th width="5%">Percentage</th>
					</tr>
				</thead>
				<tbody>
					<tr data-ng-repeat="candidates in positions.candidates | orderBy: '-results'">
						<td>@{{$index + 1}}.</td>
						<td>@{{candidates.name}}</td>
						<td>@{{candidates.party.code}}</td>
						<td align="right">@{{candidates.results}}</td>
						<td align="right">@{{candidates.results/session.count.total*100 | number:2}}%</td>
					</tr>
				</tbody>
			</table>
			<br>
		</div>
		<h3>*** NOTHING FOLLOWS ***</h3>
		<div>
			<em>
				Printed: {{$session['date']}} <br>
				Total number of voters: {{$session['count']['total']}} <br>
				Ballots cast: {{$session['count']['voted']}} <br>
			</em>
		</div>
	</div>
	<script>
		window.data = <?php echo json_encode($data) ?>;
		window.session = <?php echo json_encode($session) ?>;
	</script>
	<?php echo HTML::script('assets/js/jquery-2.0.3.min.js') ?>
	<?php echo HTML::script('assets/js/angular-1.2.12/angular.js') ?>
	<?php echo HTML::script('ang/results.js') ?>
@stop