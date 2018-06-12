@extends('layouts.app')
@section('content')

<div class="game-section">
	<div id="game-header">
		<div id="timer"></div>
		<div id="result"></div>
	</div>
	<div id="minesweeper">
	</div>
</div>
<script>
	jQuery(function(){
		var minesweeper = new Minesweeper();
	});
</script>
@endsection