@extends('layouts.app')
@section('content')

	<div class='user-content' style='margin-right: 200px;'>
		<table class='score-list'>
			<tr>
				<th>Time played</th>
				<th>Score</th>
				<th>Daily</th>
			</tr>
			@foreach($scores as $score)
				<tr>
					<td>{{ $score->created_at }}</td>
					<td>{{ $score->score }}</td>
					<td>{{ $score->is_daily ? 'yes' : 'no' }}</td>
				</tr>
			@endforeach
		</table>
	</div>
	<div class='user-content'>
		<table class='score-list'>
			<tr>
				<th>Player name</th>
				<th>Time played</th>
				<th>Score</th>
				<th>Daily</th>
			</tr>
			@foreach($friendScores as $score)
				<tr>
					<td>{{ $score->user->name }}</td>
					<td>{{ $score->created_at }}</td>
					<td>{{ $score->score }}</td>
					<td>{{ $score->is_daily ? 'yes' : 'no' }}</td>
				</tr>
			@endforeach
		</table>
	</div>

@endsection