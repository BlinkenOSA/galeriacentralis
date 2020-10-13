@extends('layouts.base')

@section('page')
	<div class="wrapper wrapper--sidebar">
		@include('partials.header')
		<div class="container">
			<main class="main">
				@yield('content')
			</main>
			<aside class="sidebar">
				@yield('sidebar')
			</aside>
		</div>
		<div style="flex-grow:1;"></div>
		@include('partials.footer')
	</div>
@endsection