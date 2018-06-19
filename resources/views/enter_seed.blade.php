@extends('layouts.app')
@section('content')

	<p>@lang('enter-seed.Enter_seed')</p>
	<input id='seed' type='text'><br><br>
	<input type='button' value='Generate' onclick="generateGame()">

	<script>	
		function generateGame(){
			var seed = jQuery('#seed').val();

			window.location = '/seed?seed='+seed;
		}

	</script>

@endsection