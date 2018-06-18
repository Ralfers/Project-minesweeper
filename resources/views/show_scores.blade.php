@extends('layouts.app')
@section('content')

	@if(Auth::user()->role != 1)
		<div class="user-content" style="margin-right: 200px;">
			<table class="score-list">
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
	@endif
	<div class="user-content">
		<table class="score-list">
			<tr>
				<th>Player name</th>
				<th>Time played</th>
				<th>Score</th>
				<th>Daily</th>
			</tr>
			@foreach($userScores as $score)
				<tr>
					<td>{{ $score->user->name }}</td>
					<td>{{ $score->created_at }}</td>
					<td>{{ $score->score }}</td>
					<td>{{ $score->is_daily ? 'yes' : 'no' }}</td>
					@if(Auth::user()->role == 1)
						<td><a href="javascript:;" onclick="removeScore({{ $score->id }})">X</a></td>
					@endif
				</tr>
			@endforeach
		</table>
	</div>

	<script>
		function removeScore(scoreId){
			jQuery.ajax({
				url: '/scores/'+scoreId,
				type: 'DELETE',
				data: { '_token': jQuery('#token').val() },
				success: () => {
					location.reload();
				}
			});
		}
	</script>

@endsection