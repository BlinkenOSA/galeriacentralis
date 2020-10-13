@extends('layouts.full')

@section('content')
	<section class="info">
		<h1 class="info__title">{{ __('Info') }}</h1>
		<div class="info__columns">
			<div class="info__about">
				<div class="info__row info__row--right">
					<label class="info__label">{{ __('strings.about') }}</label>
					<div class="info__value info__value--about">{!! $options->fields['about'][$lang] ?? '' !!}</div>
				</div>
			</div>
			<div class="info__placeholder"></div>
			<div class="info__impressum">
				<div class="info__row info__row--right">
					<label class="info__label">{{ __('strings.impressum') }}</label>
					<div class="info__value info__value--impressum">{!! $options->fields['impressum'][$lang] ?? '' !!}</div>
				</div>
			</div>
			<div class="info__datas">
				<div class="info__row info__row--left">
					<label class="info__label">{{ __('strings.hours') }}</label>
					<div class="info__value">{!! $options->fields['hours'][$lang] ?? '' !!}</div>
				</div>
				<div class="info__row info__row--left">
					<label class="info__label">{{ __('strings.address') }}</label>
					<div class="info__value">{!! $options->fields['address'][$lang] ?? '' !!}</div>
				</div>
				<div class="info__row info__row--left">
					<label class="info__label">{{ __('strings.phone') }}</label>
					<span class="info__value"><a href="tel:{{ $options->fields['phone'] }}">{{ $options->fields['phone'] }}</a></span>
				</div>
				<div class="info__row info__row--left">
					<label class="info__label">{{ __('strings.fax') }}</label>
					<span class="info__value"><a href="fax:{{ $options->fields['fax'] }}">{{ $options->fields['phone'] }}</a></span>
				</div>
				<div class="info__row info__row--left">
					<label class="info__label">{{ __('strings.email') }}</label>
					<span class="info__value"><a href="mailto:{{ $options->fields['email'] }}">{{ $options->fields['email'] }}</a></span>
				</div>
				<div class="info__row info__row--left">
					<label class="info__label">{{ __('strings.programs') }}</label>
					<div class="info__value">{!! $options->fields['programs'][$lang] ?? '' !!}</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('footer')
	@include('partials.footer')
@endsection