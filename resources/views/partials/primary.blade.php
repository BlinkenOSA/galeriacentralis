<nav class="header__primary primary">
	@foreach ($categories as $cat)
		<div class="primary__column">
			<h3 class="primary__title">
				{{ $cat->title }}
				<button class="primary__button">@include('icons.down')</button>
				<a href="{{ route("{$lang}.events.index", ['category' => $cat->slug]) }}" class="primary__link"></a>
			</h3>
			<div class="primary__subitems">
				<a href="{{ route("{$lang}.events.index", ['category' => $cat->slug, 'filter' => __('strings.future_slug')]) }}" class="primary__item primary__item--sub">{{ __('strings.future') }}</a>
				<a href="{{ route("{$lang}.events.index", ['category' => $cat->slug, 'filter' => __('strings.present_slug')]) }}" class="primary__item primary__item--sub">{{ __('strings.present') }}</a>
				<a href="{{ route("{$lang}.events.index", ['category' => $cat->slug, 'filter' => __('strings.past_slug')]) }}" class="primary__item primary__item--sub">{{ __('strings.past') }}</a>
				<a href="{{ route("{$lang}.events.index", ['category' => $cat->slug, 'filter' => __('strings.virtual_slug')]) }}" class="primary__item primary__item--sub">{{ __('strings.virtual') }}</a>
			</div>
		</div>
	@endforeach
	<div class="primary__items">
		<a href="{{ route("{$lang}.press") }}" class="primary__item primary__item--main">{{ __('strings.press') }}</a>
		<a href="{{ route("{$lang}.info") }}" class="primary__item primary__item--main">{{ __('strings.info') }}</a>
	</div>
</nav>