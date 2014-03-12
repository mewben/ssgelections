@extends('layouts.print')

@section('title')
	<h2>Official List of Voters</h2>
	<h5>S.Y. {{ $session['sem']['sy'] }}-{{ $session['sem']['sy'] + 1 }} Sem: {{ $session['sem']['sem'] }}</h5>
@stop

@section('content')
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>Voters ID</th>
				<th>Full Name</th>
				<th>College Code</th>
				<th>Year Level</th>
				<th>Signature</th>
				<th colspan="4">PassCode</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $key => $value)
			<?php $fullName = $value['lname'] . ', ' . $value['fname'] . ', ' . $value['mname'][0] . '.'; ?>
			<tr>
				<td>{{$key + 1}}.</td>
				<td>{{$value['voter_id']}}</td>
				<td>{{$fullName}}</td>
				<td>{{$value['college']['code']}}</td>
				<td>{{$value['year']}}</td>
				<td>&nbsp;</td>
				<td><small><small>{{$key+1}}. VOTER ID:</small></small></td>
				<td>{{$value['voter_id']}}</td>
				<td><small><small>PASSCODE:</small></small></td>
				<td>{{$value['passcode']}}</td>
			</tr>
			@endforeach
			<tr><td colspan="10">*** NOTHING FOLLOWS ***</td></tr>
		</tbody>
	</table>
@stop