@extends('layouts.app')
@section('content')

	@if(Auth::user()->role != 1)
		<div class="user-content" style="margin-right: 200px;">
			<table class="score-list">
				<tr>
					<th>@lang('scores.TP')</th>
					<th>@lang('scores.S')</th>
					<th>@lang('scores.D')</th>
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
				<th>@lang('scores.Name')</th>
				<th>@lang('scores.TP')</th>
				<th>@lang('scores.S')</th>
				<th>@lang('scores.D')</th>
			</tr>
			@foreach($userScores as $score)
				<tr>
					<td>{{ $score->user->name }}</td>
					<td>{{ $score->created_at }}</td>
					<td>{{ $score->score }}</td>
					<td>{{ $score->is_daily ? __('scores.Yes') : __('scores.No') }}</td>
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