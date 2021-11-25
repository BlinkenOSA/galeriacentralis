@php
	$format = $lang == 'hu' ? 'Y.MM.D.' : 'M.DD.Y';
@endphp

@extends('layouts.full')

@section('content')
	<div class="events">
		@foreach ($events as $year => $group)
			@php
				$current = now()->format('Y');
				$filter = request()->query('filter');

				switch ($filter) {
					case __('strings.future_slug'):
						$isVisible = $current < $year;
						break;
					case __('strings.past_slug'):
						$isVisible = $current > $year;
						break;
					case __('strings.present_slug'):
						$isVisible = $current == $year;
						break;
					case __('strings.virtual_slug'):
						$isVisible = true;
						break;
					default:
						$isVisible = false;	
						break;
				}

			@endphp
			<div class="events__year{{ $isVisible ? ' events__year--visible' : '' }}">
				<button class="events__toggle">{{ $year }}@include('icons.down')</button>
				<div class="events__events">
					<ul class="events__list">
						@foreach ($group as $event)
							<li class="events__event"{{ isset($event->color) ? "style=background-color:{$event->color};" : '' }}>
								<a href="{{ route("{$lang}.events.show", [
									'slug' => $event->slug,
									'category' => $event->categories->first()->slug
								]) }}" class="events__link">
									<h3 class="events__title">{{ $event->title }}</h3>
									@if (isset($event->subtitle))
										<h4 class="events__subtitle">{{ $event->subtitle }}</h4>
									@endif
								</a>
								@if (!empty($event->period))
									<div class="events__dates">
										<date class="events__date evenths_date--start">{{ $event->period->getStartDate()->isoFormat($format) }}</date> 
										&#8211;<br/>
										<date class="events__date events__date--end">{{ $event->period->getEndDate()->isoFormat($format) }}</date><br/>
										@if ($event->period->contains(now()))
											<div class="events__onshow">{{ __('strings.on_show') }}</div>
										@elseif ($event->start > now())
											<div class="events__onshow">{{ __('strings.coming_up') }}</div>
										@endif
									</div>
								@endif
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		@endforeach
	</div>
@endsection

@section('footer')
	@include('partials.footer')
@endsection