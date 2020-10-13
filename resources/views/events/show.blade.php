@extends('layouts.full')

@section('content')
	@if ($event->monoscope && auth()->guard('twill_users')->check() == false)
		<header class="eventhead eventhead--empty">
			<h1 class="eventhead__title">{{ $event->title }}</h1>
			<span class="eventhead__construction">
				{{ __('strings.construction') }}
			</span>
		</header>
		<div class="scope">
			@include('scope.empty-mobile')
			@include('scope.empty-left')
			@include('scope.empty-mid')
			@include('scope.empty-right')
		</div>
	@else
		@include('events.eventhead', [
			'event' => $event,
			'template' => 'show'
		])
		<div class="container">
			@include('events.gallery', [
				'event' => $event,
				'template' => 'show'
			])
			@include('events.description', [
				'event' => $event,
				'template' => 'show'
			])
		</div>
		@include('events.data', [
			'event' => $event,
			'related' => $related,
			'series' => $series,
		])
	@endif

@endsection

@section('footer')
	@include('partials.footer')
@endsection