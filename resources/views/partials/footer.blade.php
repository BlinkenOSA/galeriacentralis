<footer class="footer">
	<div class="footer__inner">
		<div class="footer__logo">@include('logo.short')</div>
		<div class="footer__column">
			<div class="footer__item">
				<span class="footer__label">{{ __('strings.hours') }}</span>
				<div class="footer__value">{!! $options->fields['hours'][$lang] !!}</div>
			</div>
			<div class="footer__item">
				<span class="footer__label">{{ __('strings.address') }}</span>
				<div class="footer__value">{!! $options->fields['address'][$lang] !!}</div>
			</div>
			<a href="https://www.osaarchivum.org/" class="footer__logolink" target="_blank">@include('logo.osa')</a>
		</div>
		<div class="footer__column">
			<div class="footer__item">
				<span class="footer__label">{{ __('strings.phone') }}</span>
				<div class="footer__value"><a href="tel:{{ $options->fields['phone'] }}">{{ $options->fields['phone'] }}</a></div>
			</div>
			<div class="footer__item">
				<span class="footer__label">{{ __('strings.fax') }}</span>
				<div class="footer__value"><a href="fax:{{ $options->fields['fax'] }}">{{ $options->fields['fax'] }}</a></div>
			</div>
			<div class="footer__item">
				<span class="footer__label">{{ __('strings.email') }}</span>
				<div class="footer__value"><a href="mailto:{{ $options->fields['email'] }}">{{ $options->fields['email'] }}</a></div>
			</div>
			<div class="footer__item">
				<span class="footer__label">{{ __('strings.programs') }}</span>
				<div class="footer__value">{!! $options->fields['programs'][$lang] !!}</div>
			</div>
		</div>
	</div>
</footer>
