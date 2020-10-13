@extends('layouts.full')

@section('content')
	<section class="page">
		{!! $page->renderBlocks(false) !!}
	</section>
@endsection