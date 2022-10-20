<div class="data">
	<div class="data__datas">
		@if (!empty($event->categories))
			<div class="data__row data__row--left">
				<label class="data__label">{{ __('strings.type') }}</label>
				<span class="data__value">{{ $event->categories->first()->title }}</span>
			</div>
		@endif
		@if (!empty($event->genre))
			<div class="data__row data__row--left">
				<label class="data__label">{{ __('strings.genre') }}</label>
				<span class="data__value">{{ $event->genre }}</span>
			</div>
		@endif
		@if ($series->count() > 0)
			<div class="data__row data__row--left">
				<label class="data__label">{{ __('strings.series') }}</label>
				<div class="data__value">
					@foreach ($series as $seriesEvent)
						<a href="{{ route("{$lang}.events.show", [
							'slug' => $seriesEvent->slug,
							'category' => 'series',
						]) }}">{{ $seriesEvent->title }}</a>
					@endforeach
				</div>
			</div>
		@endif
		@if (isset($event->curator))
			<div class="data__row data__row--left">
				<label class="data__label">{{ __('strings.curator') }}</label>
				<span class="data__value">{{ $event->curator }}</span>
			</div>
		@endif
		@if (isset($event->artists))
			<div class="data__row data__row--left">
				<label class="data__label">{{ __('strings.artists') }}</label>
				<div class="data__value">{!! $event->artists !!}</div>
			</div>
		@endif
		@if (isset($event->coop))
			<div class="data__row data__row--left">
				<label class="data__label">{{ __('strings.coop') }}</label>
				<div class="data__value">{!! $event->coop !!}</div>
			</div>
		@endif
		@if (isset($event->partners))
			<div class="data__row data__row--left">
				<label class="data__label">{{ __('strings.partners') }}</label>
				<div class="data__value">{!! $event->partners !!}</div>
			</div>
		@endif
	</div>
	<div class="data__related">
		@if (isset($event->press))
			<div class="data__row data__row--left">
				<label class="data__label">{{ __('strings.press') }}</label>
				<div class="data__value">{!! $event->press !!}</div>
			</div>
		@endif

		@if (!empty($related['exhibitions']))
			<div class="data__row data__row--left">
				<label class="data__label">{{ __('strings.related_exhibitions') }}</label>
				<div class="data__value">
					@foreach ($related['exhibitions'] as $relatedEvent)
						<a class="row_link" href="{{ route("{$lang}.events.show", [
							'slug' => $relatedEvent->slug,
							'category' => 'exhibitions',
						]) }}">{{ $relatedEvent->title }}</a>
					@endforeach
				</div>
			</div>
		@endif
		@if (!empty($related['kiallitas']))
            <div class="data__row data__row--left">
                <label class="data__label">{{ __('strings.related_exhibitions') }}</label>
                <div class="data__value">
                    @foreach ($related['kiallitas'] as $relatedEvent)
                        <a class="row_link" href="{{ route("{$lang}.events.show", [
                            'slug' => $relatedEvent->slug,
                            'category' => 'kiallitas',
                        ]) }}">{{ $relatedEvent->title }}</a>
                    @endforeach
                </div>
            </div>
        @endif

		@if (!empty($related['events']))
			<div class="data__row data__row--left">
				<label class="data__label">{{ __('strings.related_events') }}</label>
				<div class="data__value">
					@foreach ($related['events'] as $relatedEvent)
						<a class="row_link" href="{{ route("{$lang}.events.show", [
							'slug' => $relatedEvent->slug,
							'category' => 'events',
						]) }}">{{ $relatedEvent->title }}</a>
					@endforeach
				</div>
			</div>
		@endif
        @if (!empty($related['esemeny']))
            <div class="data__row data__row--left">
                <label class="data__label">{{ __('strings.related_events') }}</label>
                <div class="data__value">
                    @foreach ($related['esemeny'] as $relatedEvent)
                        <a class="row_link" href="{{ route("{$lang}.events.show", [
                            'slug' => $relatedEvent->slug,
                            'category' => 'esemeny',
                        ]) }}">{{ $relatedEvent->title }}</a>
                    @endforeach
                </div>
            </div>
        @endif

		@if (!empty($related['education']))
			<div class="data__row data__row--left">
				<label class="data__label">{{ __('strings.related_edu') }}</label>
				<div class="data__value">
					@foreach ($related['education'] as $relatedEvent)
						<a class="row_link" href="{{ route("{$lang}.events.show", [
							'slug' => $relatedEvent->slug,
							'category' => 'education',
						]) }}">{{ $relatedEvent->title }}</a>
					@endforeach
				</div>
			</div>
		@endif
        @if (!empty($related['oktatas']))
            <div class="data__row data__row--left">
                <label class="data__label">{{ __('strings.related_edu') }}</label>
                <div class="data__value">
                    @foreach ($related['oktatas'] as $relatedEvent)
                        <a class="row_link" href="{{ route("{$lang}.events.show", [
                            'slug' => $relatedEvent->slug,
                            'category' => 'oktatas',
                        ]) }}">{{ $relatedEvent->title }}</a>
                    @endforeach
                </div>
            </div>
        @endif

	</div>
	<div class="data__summary">
		<div class="data__row data__row--right">
			<label class="data__label">{{ __('strings.summary') }}</label>
			<div class="data__value data__value--description">
				<div class="data__description">{!! $event->description !!}</div>
			</div>
			<!--
			<figure class="data__figure">
				{!! $event->renderImage('data__image', 'medium', 'images') !!}
				<figcaption class="data__caption"><strong>{{ $event->imageCaption('images') }}</strong>{!! !empty($event->imageObject('images')->credit) ? "<br/>- {$event->imageObject('images')->credit}" : '' !!}</figcaption>
			</figure>
			-->
			<div class="data__placeholder"></div>
			<div class="data__value">
				{!! $event->summary !!}
			</div>
		</div>
	</div>
</div>
