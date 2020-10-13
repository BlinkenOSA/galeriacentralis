@extends('layouts.full')

@section('content')
	<section class="press">
		<h1 class="press__title">{{ __('Press') }}</h1>
		@foreach ($events as $event)
			<article class="press__event">
				<a href="{{ route("{$lang}.events.show", [
					'slug' => $event->slug,
					'category' => $event->categories->first()->slug
				]) }}" class="press__titles">
					<h3 class="press__subtitle">{{ $event->title }}</h3>
					@if (!empty($event->subtitle))
						<h4 class="press__description">{{ $event->subtitle }}</h4>
					@endif
				</a>
				<div class="press__dates">
					@if (!empty($event->start))
						<date class="press__date press__date--start">{{ $event->period->getStartDate()->isoFormat('LL') }}</date>
					@endif
					@if (!empty($event->end))
						&#8211;<br/>
						<date class="press__date press__date--end">{{ $event->period->getStartDate()->isoFormat('LL') }}</date>
					@endif
				</div>
				<div class="press__items">
					@foreach ($event->pressItems as $item)
						@include('partials.press_item')
					@endforeach
				</div>
			</article>
		@endforeach

	</section>
@endsection