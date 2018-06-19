@extends('layouts.app')
@section('content')
	

	<div class="user-content" style="margin-right: 200px;">
		<p>
			@lang('profile-page.GP'): {{ $count }}
		</p>
		<p>
			@lang('profile-page.Recent'): 
		</p>
		<table class='score-list'>
			<tr>
				<th>@lang('scores.TP')</th>
				<th>@lang('scores.S')</th>
				<th>@lang('scores.D')</th>
			</tr>
			@foreach($games as $game)
				<tr>
					<td>{{ $game->created_at }}</td>
					<td>{{ $game->score }}</td>
					<td>{{ $game->is_daily ? __('scores.Yes') : __('scores.No') }}</td>
				</tr>
			@endforeach
		</table>
	</div>
	<div class="user-content" style="margin-right: 100px;">
		<p>@lang('profile-page.F'):</p>
		@foreach($friends as $friend)
			<p><a href="/users/{{ $friend->id }}">{{ $friend->name }}</a></p>
		@endforeach

	</div>
	<div class='user-content'>
		@if($add)
			<input type='button' value='@lang('profile-page.Add')' onclick='addFriend()'>
		@endif
	</div>
	<div class='user-content'>
		<img src="{{ $link }}" style="max-height: 100px; max-width: 100px;"><br>
		@if($editable)
			@lang('profile-page.Change'):<br>
			<input type="text" id="avatar-link">
			<input type="button" value="@lang('profile-page.Submit')" onclick="changeAvatar()"><br><br>
			@lang('profile-page.Select'):<br>
			<select id="home-select">
				<option value="0">@lang('layout.Random')</option>
				<option value="1">@lang('layout.Daily')</option>
				<option value="2">@lang('layout.Scores')</option>
				<option value="3">@lang('layout.Profile')</option>
			</select> 
			<input type="button" value="@lang('profile-page.Save')" onclick="changeHome()">
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