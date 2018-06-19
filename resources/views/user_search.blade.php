@extends('layouts.app')
@section('content')

	<p>@lang('find-user.Enter'):</p>
	<p class="error"></p>
	<input id="username" type="text"><br><br>
	<input type="button" value="@lang('find-user.Search')" onclick="searchUser()">

	<script>	
		function searchUser(){
			var username = jQuery('#username').val();
			jQuery.get('users/search?username='+username, (data) => {
				if(data != 0){
					window.location = '/users/'+data;
				}
				else{
					jQuery('.error').text('User not found');
				}
			});
		}

	</script>

@endsection