@extends('layouts.print')

@section('title')
	<h2>Initialization Report</h2>
	<h5>S.Y. {{ $session['sem']['sy'] }}-{{ $session['sem']['sy'] + 1 }} Sem: {{ $session['sem']['sem'] }}</h5>
@stop

@section('content')

	@foreach($data as $positions)
		<div>
			<h3>{{$positions['name']}}</h3>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="10%">Candidate #</th>
						<th width="50%">Full Name</th>
						<th width="30%">Party</th>
						<th width="10%">No. of Votes</th>
					</tr>
				</thead>
				<tbody>
					@foreach($positions['candidates'] as $kc => $candidates)
					<tr>
						<td>{{$kc + 1}}</td>
						<td>{{$candidates['name']}}</td>
						<td>{{$candidates['party']['code']}}</td>
						<td align="right">{{$candidates['results']}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endforeach
	<h3>*** NOTHING FOLLOWS ***</h3>
	<div>
		<em>
			Printed: {{$session['date']}} <br>
			Total number of voters: {{$session['count']['total']}} <br>
			Ballots cast: {{$session['count']['voted']}} <br>
		</em>
	</div>


	<hr>
	<table class="table table-bordered" style="margin-top: 150px; width:50%;">
		<tbody>
			<tr>
				<td colspan="2">
					<h1>For Close Voting... Important!</h1>
				</td>
			</tr>
			<tr>
				<td>URL:</td>
				<td>http://server-ip-address/close-voting?cid=<?php echo Session::get('user.campus.id') ?>&sid=<?php echo Session::get('user.sem.id') ?></td>
			</tr>
			<tr>
				<td>Pass Code 1:</td>
				<td>{{$passcode1['value']}}</td>
			</tr>
			<tr>
				<td>Pass Code 2:</td>
				<td>{{$passcode2['value']}}</td>
			</tr>
		</tbody>
	</table>
@stop