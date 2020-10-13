@extends('layouts.frontpage')

@section('content')
	@include('events.eventhead', [
		'event' => $event,
		'template' => 'frontpage'
	])
	<div class="container">
		@include('events.gallery', [
			'event' => $event,
			'template' => 'frontpage'
		])
		@include('events.description', [
			'event' => $event,
			'template' => 'frontpage'
		])
	</div>
@endsection