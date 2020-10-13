@extends('layouts.empty')

@section('content')
	@if (isset($event))
		<header class="eventhead eventhead--empty">
			<h1 class="eventhead__title">{{ $event->title }}</h1>
			<span class="eventhead__construction">
				{{ __('strings.construction') }}
			</span>
		</header>
	@endif
	<div class="scope">
		@include('scope.empty-mobile')
		@include('scope.empty-left')
		@include('scope.empty-mid')
		@include('scope.empty-right')
	</div>
@endsection