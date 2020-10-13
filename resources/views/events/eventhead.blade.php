@php
	$template = $template ?? null;
@endphp

<header class="eventhead{{ isset($template) ? " eventhead--{$template}" : '' }}" {{ isset($event->color) ? "style=background-color:{$event->color};" : '' }}>
	<div class="eventhead__container">
		<div class="eventhead__column eventhead__column--title">
			<h1 class="eventhead__title">
				@if ($template == 'frontpage')
					<a href="{{ route("$lang.events.show", [
						'slug' => $event->slug,
						'category' => $event->categories->first()->slug
					]) }}" class="eventhead__title-text">{{ $event->title }}</a>
				@else
					<div class="eventhead__title-text">{{ $event->title }}</div>
				@endif
			</h1>
			@if (isset($event->subtitle))
				<h2 class="eventhead__subtitle">{{ $event->subtitle }}</h2>
			@endif
		</div>
		<div class="eventhead__column eventhead__column--dates">
			@if ($template == 'frontpage')
				<ul class="eventhead__langs">
					@foreach (config('translatable.locales') as $language)
						<li class="eventhead__lang{{ $language == app()->getLocale() ? ' eventhead__lang--active' : ' eventhead__lang--inactive' }}">
							@if ($language == app()->getLocale())
								<span class="eventhead__lang-text">{{ $language }}</span>
							@else
								<a href="{{ $language == config('translatable.locale') ? url('/') : route($language . '.frontpage') }}" class="eventhead__lang-text">{{ $language }}</a>
							@endif
						</li>
					@endforeach
				</ul>
			@endif
			@if (!empty($event->period))
				@if ($event->period->contains(now()))
					<span class="eventhead__onshow">{{ __('strings.on_show') }}</span>
				@else
					<span class="eventhead__placeholder"></span>
				@endif
				<div class="eventhead__dates">
					<date class="eventhead__date eventhead__date--start">{{ $event->period->getStartDate()->isoFormat('LL') }} {{ $event->formatted_start_time ?? '' }}</date>
					&#8211;<br/>
					<date class="eventhead__date eventhead__date--end">{{ $event->period->getEndDate()->isoFormat('LL') }} {{ $event->formatted_end_time ?? '' }}</date>
				</div>
			@endif
		</div>
	</div>
</header>