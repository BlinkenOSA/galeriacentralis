@extends('layouts.full')

@section('content')
	<div class="results">
		<h1 class="results__term">&#8216;{{ $title }}
		&#8217;</h1>
		@foreach ($results as $event)
			<article class="results__event"{{ isset($event->color) ? "style=background-color:{$event->color};" : '' }}>
				<a href="{{ route("{$lang}.events.show", [
					'slug' => $event->slug,
					'category' => $event->categories->first()->slug
				]) }}" class="results__link">
					<h3 class="results__title">{{ $event->title }}</h3>
					@if (isset($event->subtitle))
						<h4 class="results__subtitle">{{ $event->subtitle }}</h4>
					@endif
				</a>
			</article>
		@endforeach

@endsection

@section('footer')
	@include('partials.footer')
@endsection