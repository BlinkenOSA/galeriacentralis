@extends('layouts.base')

@section('page')
	<div class="wrapper wrapper--contained">
		@include('partials.header')
		<main class="main">
			@yield('content')
		</main>
		<div style="flex-grow:1;"></div>
		@include('partials.footer')
	</div>
@endsection