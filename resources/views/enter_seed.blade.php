@extends('layouts.app')
@section('content')

	<p>Enter the seed:</p>
	<input id='seed' type='text'><br><br>
	<input type='button' value='Generate' onclick="generateGame()">

	<script>	
		function generateGame(){
			console.log('Hello');
			var seed = jQuery('#seed').val();

			window.location = '/seed?seed='+seed;
		}

	</script>

@endsection