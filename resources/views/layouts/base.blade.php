<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width" name="viewport">
		<title>{{ $meta['title'] ?? config('meta.title') }} - {{ config('app.name') }}</title>
		<meta name="description" content="{{ $meta['description'] ?? config('meta.description') }}">
		<link rel="canonical" href="{{ request()->getSchemeAndHttpHost() . request()->getRequestUri() }}">
		<meta name="robots" content="{{ config('app.env') != 'production' ? 'noindex,nofollow' : 'index,follow' }}">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<meta property="og:title" content="{{ $meta['title'] ?? config('meta.title') }} - {{ config('app.name') }}" />
		<meta property="og:description" content="{{ $meta['description'] ?? config('meta.description') }}" />
		<meta property="og:type" content="{{ !empty($meta['type']) ? $meta['type'] : 'article' }}" />
		<meta property="og:url" content="{{ request()->getSchemeAndHttpHost() . request()->getRequestUri() }}" />
		@if (!empty($meta['image']))
			<meta property="og:image" content="{{ $meta['image'] }}" />
		@endif

		@include('partials.favicon')

		<link rel="stylesheet" href="{{ asset('css/style.css') . (config('app.env') != 'production' ? '?' . 'now'|date('c') : '?' . config('app.version')) }}" type="text/css" media="screen" />
	</head>
	<body id="body" class="{{ !$cookies['accepted'] ? 'noscroll' : '' }}">
		@yield('page')
		@includeWhen(!$cookies['accepted'], 'partials.cookie')
		{{-- <script>
			window.STORE = {};
			@stack('store')
		</script> --}}
		<script src="{{ asset('js/scripts.js') . (config('app.env') != 'production' ? '?' . date('c') : '?' . config('app.version')) }}" defer></script>
	</body>
</html>
