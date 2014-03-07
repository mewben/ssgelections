@extends('layouts.print')

@section('title')
	<h2>List of Voters (Voted)</h2>
	<h5>S.Y. {{ $session['sem']['sy'] }}-{{ $session['sem']['sy'] + 1 }} Sem: {{ $session['sem']['sem'] }}</h5>
@stop

@section('content')

	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="10%">#</th>
				<th width="10%">Voter ID#</th>
				<th width="50%">Full Name</th>
			</tr>
		</thead>
		<tbody>
		@foreach($data as $k => $voter)
			<tr>
				<td>{{$k + 1}}</td>
				<td>{{ $voter['voter_id'] }}</td>
				<td>{{ $voter['lname'] . ', ' . $voter['fname'] . ', ' . $voter['mname']}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@stop