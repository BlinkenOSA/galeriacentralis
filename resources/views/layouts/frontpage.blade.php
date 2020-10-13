@extends('layouts.base')

@section('page')
	<div class="wrapper wrapper--frontpage">
		@include('partials.header')
		<main class="main">
			@yield('content')
		</main>
		{{-- <div style="flex-grow:1;"></div> --}}
		@yield('footer')
	</div>
@endsection