<div class="search">
	<form action="{{ route("{$lang}.search") }}" class="search__form" method="GET">
		<input class="search__input" type="text" name="s" id="s" placeholder="{{ __('strings.search_placeholder') }}">
		<button class="search__button" type="submit">{{ __('strings.search') }}</button>
	</form>
</div>