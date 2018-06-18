@extends('layouts.app')
@section('content')

	<div id="game-header">
		<div id="timer"></div>
		<div id="result"></div>
	</div>
	<div id="minesweeper">
	</div>
	<div id="seed" style="margin-top: 28px;">
		@if($seed)
			<p>Seed: {{ $seed }}</p>
		@endif
	</div>
	<script>
		jQuery(function(){
			var minesweeper = new Minesweeper('{{ $seed }}', '{{ $store }}', '{{ $daily }}');
		});
	</script>

@endsection