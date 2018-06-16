@extends('layouts.app')
@section('content')

	<div id="game-header">
		<div id="timer"></div>
		<div id="result"></div>
	</div>
	<div id="minesweeper">
	</div>
	<script>
		jQuery(function(){
			var minesweeper = new Minesweeper();
		});
	</script>

@endsection