@extends('layouts.print')

@section('title')
	<h2>Initialization Report</h2>
	<h5>S.Y. {{ $session['sem']['sy'] }}-{{ $session['sem']['sy'] + 1 }} Sem: {{ $session['sem']['sem'] }}</h5>
@stop

@section('content')
	<table class="table table-bordered table-condensed">
		<tbody>
			@foreach($data as $key => $value)
			<tr>
				<td colspan="2"><h4>{{$value['name']}}</h4></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<ol>
					@foreach($value['candidates'] as $k => $c)
						<li><h5>{{$c['name']}} - {{count($c['results'])}}</h5></li>
					@endforeach
					</ol>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@stop