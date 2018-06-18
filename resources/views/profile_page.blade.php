@extends('layouts.app')
@section('content')
	

	<div class="user-content" style="margin-right: 200px;">
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
	<div class="user-content" style="margin-right: 150px;">
		<p>Friends:</p>
		@foreach($friends as $friend)
			<p><a href="/users/{{ $friend->id }}">{{ $friend->name }}</a></p>
		@endforeach

	</div>
	<div class='user-content'>
		@if($add)
			<input type='button' value='Add friend' onclick='addFriend()'>
		@endif
	</div>
	<div class='user-content'>
		<img src="{{ $link }}" style="max-height: 100px; max-width: 100px;"><br>
		@if($editable)
			Change profile picture:<br>
			<input type="text" id="avatar-link">
			<input type="button" value="Submit" onclick="changeAvatar()"><br><br>
			Select what is shown as the homepage:<br>
			<select id="home-select">
				<option value="0">Random game</option>
				<option value="1">Daily game</option>
				<option value="2">View scores</option>
				<option value="3">Profile page</option>
			</select> 
			<input type="button" value="save" onclick="changeHome()">
		@endif
	</div>

	<script>
		function addFriend(){
			jQuery.post('/users/add', {'friend_id' : {{ $user_id }}, "_token": jQuery('#token').val()});
		}

		function changeAvatar(){
			var link = jQuery('#avatar-link').val();
			jQuery.post('/users/change-avatar', {'link': link, "_token": jQuery('#token').val()}, () => {
				location.reload();
			});

		}

		function changeHome(){
			var home = jQuery('#home-select').val();
			jQuery.post('/users/change-home', {'home': home, "_token": jQuery('#token').val()})
		}
	</script>

@endsection