<header class="header">
		<div class="header__top">
			<a class="header__branding" href="{{ route("{$lang}.frontpage") }}">
				@include('logo.long', ['lang' => $lang])
				@include('logo.short')
			</a>
			@if (($options->fields['maintenance'] ?? false) != true || auth()->guard('twill_users')->check() == true)
				<button class="header__toggle">
					@include('icons.menu-desktop')
					@include('icons.menu-mobile')
				</button>
			@endif
		</div>
		<div class="header__navs">
			<ul class="header__langs">
				@foreach (config('translatable.locales') as $language)
					<li class="header__lang{{ $language == app()->getLocale() ? ' header__lang--active' : ' header__lang--inactive' }}">
						@if ($language == app()->getLocale())
							<span class="header__lang-text">{{ $language }}</span>
						@else
							<a href="{{ $language == config('translatable.locale') ? url('/') : route($language . '.frontpage') }}" class="header__lang-text">{{ $language }}</a>
						@endif
					</li>
				@endforeach
			</ul>
			@include('partials.primary')
			<button class="header__search">@include('icons.search')</button>
			<div class="header__social">
				<a href="{{ $options->fields['instagram'] }}" class="header__social-item" target="_blank">{{ __('Instagram') }}</a>
				<a href="{{ $options->fields['facebook'] }}" class="header__social-item" target="_blank">{{ __('Facebook') }}</a>
				<a href="{{ $options->fields['twitter'] }}" class="header__social-item" target="_blank">{{ __('Twitter') }}</a>
				<a href="{{ $options->fields['youtube'] }}" class="header__social-item" target="_blank">{{ __('YouTube') }}</a>
			</div>
		</div>
		@include('partials.search')
</header>
