@extends('layouts.base')

@section('page')
	<div class="wrapper wrapper--empty">
		@include('partials.header')
		<main class="main">
			@yield('content')
		</main>
	</div>
@endsection