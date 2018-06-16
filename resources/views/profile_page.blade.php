@extends('layouts.app')
@section('content')
	

	<div class='user-content' style='margin-right: 550px;'>
		<p>
			Games played: {{ $count }}
		</p>
		<p>
			Most recent games: 
		</p>
		<table class='score-list'>
			<tr>
				<th>Time played</th>
				<th>Score</th>
				<th>Daily</th>
			</tr>
			@foreach($games as $game)
				<tr>
					<td>{{ $game->created_at }}</td>
					<td>{{ $game->score }}</td>
					<td>{{ $game->is_daily ? 'yes' : 'no' }}</td>
				</tr>
			@endforeach
		</table>
	</div>
	<div class='user-content'>
		@if($add)
			<input type='button' value='Add friend' onclick='addFriend()'>
		@endif
	</div>

	<script>
		function addFriend(){
			jQuery.post('/users/add', {'friend_id' : {{ $user_id }}, "_token": jQuery('#token').val()});
		}
	</script>

@endsection